<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateUserPasswordRequest;
use App\Models\Department;
use App\Models\Profile;
use App\Models\User;
use App\Traits\CaptureIpTrait;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use jeremykenedy\LaravelRoles\Models\Role;
use Validator;

class UsersManagementController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        $roles = Role::all();

        return View('usersmanagement.show-users', compact('users', 'roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $departments = Department::all();
        $roles = Role::all();

        return view('usersmanagement.create-user', compact('roles', 'departments'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'name'                  => 'required|max:255|unique:users|alpha_dash',
                'paynumber'                  => 'required|max:10|unique:users|alpha_dash',
                'first_name'            => 'required|alpha_dash',
                'last_name'             => 'required|alpha_dash',
                'email'                 => 'required|email|max:255|unique:users',
                'location'                 => 'required',
                'ip_address'                 => 'required|ipv4',
                'department'                 => 'required',
                'position'                 => 'required',
                'mobile'                 => 'required|unique:users',
                'password'              => 'required|min:6|max:20|confirmed',
                'password_confirmation' => 'required|same:password',
                'role'                  => 'required',
            ],
            [
                'name.unique'         => trans('auth.userNameTaken'),
                'name.required'       => trans('auth.userNameRequired'),
                'paynumber.unique'         => 'Another employee is already using this paynumber',
                'paynumber.required'       => 'We need a paynumber to create this account.',
                'first_name.required' => trans('auth.fNameRequired'),
                'last_name.required'  => trans('auth.lNameRequired'),
                'email.required'      => trans('auth.emailRequired'),
                'email.email'         => trans('auth.emailInvalid'),
                'location.required'         => 'Where will this user be based?',
                'ip_address.required'         => 'What is the IP address for this user?',
                'ip_address.ipv4'         => 'The IP address should be of IPv4 format.',
                'department.required'         => 'This employee is from which department?',
                'position.required'         => 'What is the job title for this employee?',
                'mobile.unique'         => 'This number is already registered in the system.',
                'mobile.required'         => 'What is the mobile number for this employee?',
                'password.required'   => trans('auth.passwordRequired'),
                'password.min'        => trans('auth.PasswordMin'),
                'password.max'        => trans('auth.PasswordMax'),
                'role.required'       => trans('auth.roleRequired'),
            ]
        );

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $ipAddress = new CaptureIpTrait();
        $profile = new Profile();

        if ($request->has('backable')){
            $backable = true;
        } else {
            $backable = false;
        }

        $user = User::create([
            'name'             => strip_tags($request->input('name')),
            'paynumber'             => strip_tags($request->input('paynumber')),
            'first_name'       => strip_tags($request->input('first_name')),
            'last_name'        => strip_tags($request->input('last_name')),
            'email'            => $request->input('email'),
            'location'            => $request->input('location'),
            'ip_address'            => $request->input('ip_address'),
            'department'            => $request->input('department'),
            'position'            => $request->input('position'),
            'mobile'            => $request->input('mobile'),
            'backable'            => $backable,
            'password'         => Hash::make($request->input('password')),
            'token'            => str_random(64),
            'admin_ip_address' => $ipAddress->getClientIp(),
            'activated'        => 1,
        ]);

        $user->profile()->save($profile);
        $user->attachRole($request->input('role'));
        $user->save();

        return redirect('users')->with('success', trans('usersmanagement.createSuccess'));
    }

    /**
     * Display the specified resource.
     *
     * @param User $user
     *
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return view('usersmanagement.show-user', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param User $user
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $roles = Role::all();
        $departments = Department::all();

        foreach ($user->roles as $userRole) {
            $currentRole = $userRole;
        }

        $data = [
            'user'        => $user,
            'roles'       => $roles,
            'currentRole' => $currentRole,
            'departments' => $departments,
        ];

        return view('usersmanagement.edit-user')->with($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param User                     $user
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $emailCheck = ($request->input('email') !== '') && ($request->input('email') !== $user->email);
        $ipAddress = new CaptureIpTrait();
        
        $validator = Validator::make($request->all(), [
            'name'          => 'required|max:255|alpha_dash|unique:users,name,'.$user->id,
            'paynumber'          => 'required|max:10|alpha_dash|unique:users,paynumber,'.$user->id,
            'email'         => 'email|max:255|unique:users,email,'.$user->id,
            'location'                 => 'required',
            'ip_address'                 => 'required|ipv4',
            'first_name'    => 'required',
            'last_name'     => 'required',
            'department'                 => 'required',
            'position'                 => 'required',
            'mobile'                 => 'required|unique:users,mobile,'.$user->id,
            'password'      => 'nullable|confirmed|min:6',
        ]);
        

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $user->name = strip_tags($request->input('name'));
        $user->paynumber = strip_tags($request->input('paynumber'));
        $user->first_name = strip_tags($request->input('first_name'));
        $user->last_name = strip_tags($request->input('last_name'));
        $user->department = strip_tags($request->input('department'));
        $user->location = strip_tags($request->input('location'));
        $user->ip_address = strip_tags($request->input('ip_address'));
        $user->position = strip_tags($request->input('position'));
        $user->mobile = strip_tags($request->input('mobile'));

        if ($request->has('backable') ){
            $backable = true;
        } else {
            $backable = false;
        }

        $user->backable = $backable;

        if ($emailCheck) {
            $user->email = $request->input('email');
        }

        if ($request->input('password') !== null) {
            $user->password = Hash::make($request->input('password'));
        }

        $userRole = $request->input('role');
        if ($userRole !== null) {
            $user->detachAllRoles();
            $user->attachRole($userRole);
        }

        $user->updated_ip_address = $ipAddress->getClientIp();

        switch ($userRole) {
            case 3:
                $user->activated = 0;
                break;

            default:
                $user->activated = 1;
                break;
        }

        $user->save();

        return back()->with('success', trans('usersmanagement.updateSuccess'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param User $user
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $currentUser = Auth::user();
        $ipAddress = new CaptureIpTrait();

        if ($user->id !== $currentUser->id) {
            $user->deleted_ip_address = $ipAddress->getClientIp();
            $user->save();
            $user->delete();

            return redirect('users')->with('success', trans('usersmanagement.deleteSuccess'));
        }

        return back()->with('error', trans('usersmanagement.deleteSelfError'));
    }

    public function updateUserPassword(UpdateUserPasswordRequest $request, $id)
    {
        $currentUser = \Illuminate\Support\Facades\Auth::user();
        $user = User::findOrFail($id);
        $ipAddress = new CaptureIpTrait();

        if ($request->input('password') !== null) {
            $user->password = bcrypt($request->input('password'));
        }

        $user->updated_ip_address = $ipAddress->getClientIp();
        $user->password_changed = true;
        $user->pwd_last_changed = now();
        $user->save();

        return redirect('home')->with('success', 'Password changed successfully.');
    }
}
