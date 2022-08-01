<?php

namespace App\Http\Controllers;

use App\Models\Sgvpn;
use App\Models\User;
use Illuminate\Http\Request;
use Validator;

class SgvpnController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sgvpns = Sgvpn::all();
        return view('sgvpns.sgvpns', compact('sgvpns'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        $users = User::all();
        $sgvpns = Sgvpn::all()->unique('username');
        return view('sgvpns.add-sgvpn', compact('users', 'sgvpns'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        if( $request->has('new_account') ){
            $request->merge(array('username' => $request->input('pusername')));
            $request->merge(array('password' => $request->input('ppassword')));
            $request->merge(array('prev_password' => 'New Account'));
        } else{
            $request->merge(array('new_account' => false));
        }

        $validator = Validator::make(
            $request->all(),
            [
                'employee'                  => 'required',
                'username'            => 'required',
                'password'             => 'required',
                'prev_password'                 => 'required',
                'status'                 => 'required',
                'location'                 => 'required',
                'last_agent'              => 'required',
                'comments'             => 'nullable',
            ],
            [
                'employee.required'       => 'We need to know who will be using this account',
                'password.required'          => 'What is the password for the account?',
                'prev_password.required'  => 'What is the previous password for the account?',
                'status.required'      => 'What state is the account in?',
                'location.required'         => 'Where will this user be based?',
                'last_agent.required'         => 'Please make sure that you are logged in.',
                'comments.nullable'         => 'Any additional info, if present.',
            ]
        );

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $sgvpn = Sgvpn::create([
            'owner' => $request->input('new_account'),
            'employee' => $request->input('employee'),
            'username' => $request->input('username'),
            'password' => $request->input('password'),
            'prev_password' => $request->input('prev_password'),
            'status' => $request->input('status'),
            'location' => $request->input('location'),
            'why_change' => $request->input('why_change'),
            'last_agent' => $request->input('last_agent'),
            'comments' => $request->input('comments'),
        ]);
        $sgvpn->save();

        return redirect('sgvpns')->with('success', 'SG VPN account for '.$request->input('employee').' has been added successfully.');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Sgvpn  $sgvpn
     * @return \Illuminate\Http\Response
     */
    public function show(Sgvpn $sgvpn)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Sgvpn  $sgvpn
     * @return \Illuminate\Http\Response
     */
    public function edit(Sgvpn $sgvpn)
    {
        $users = User::all();
        $sgvpns = Sgvpn::all()->unique('username');
        $owner = Sgvpn::where('owner', true)->where('username', $sgvpn->username)->first();
        return view('sgvpns.edit-sgvpn', compact('sgvpn','users', 'sgvpns', 'owner'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Sgvpn  $sgvpn
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Sgvpn $sgvpn) {

        $validator = Validator::make(
            $request->all(),
            [
                'employee'                  => 'required',
                'username'            => 'required',
                'password'             => 'required',
                'prev_password'                 => 'required',
                'status'                 => 'required',
                'location'                 => 'required',
                'last_agent'              => 'required',
                'why_change'              => 'required',
                'comments'             => 'nullable',
            ],
            [
                'employee.required'       => 'We need to know who will be using this account',
                'password.required'          => 'What is the password for the account?',
                'prev_password.required'  => 'What is the previous password for the account?',
                'status.required'      => 'What state is the account in?',
                'location.required'         => 'Where will this user be based?',
                'last_agent.required'         => 'Please make sure that you are logged in.',
                'why_change.required'         => 'Why are you modifying this account?',
                'comments.nullable'         => 'Any additional info, if present.',
            ]
        );

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        if($sgvpn->owner){
            Sgvpn::where('username', '=', $sgvpn->username)
                ->where('owner','=',false)
                ->update([
                    'password' => $request->input('password'),
                    'prev_password' => $request->input('prev_password'),
                    'last_agent' => 'itreggy'
                ]);
        }

        $sgvpn->employee = $request->input('employee');
        $sgvpn->username = $request->input('username');
        $sgvpn->password = $request->input('password');
        $sgvpn->prev_password = $request->input('prev_password');
        $sgvpn->status = $request->input('status');
        $sgvpn->location = $request->input('location');
        $sgvpn->why_change = $request->input('why_change');
        $sgvpn->last_agent = $request->input('last_agent');
        $sgvpn->comments = $request->input('comments');

        $sgvpn->save();

        return redirect('sgvpns/'.$sgvpn->id.'/edit')->with('success', 'SG VPN account for '.$request->input('employee').' has been updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Sgvpn  $sgvpn
     * @return \Illuminate\Http\Response
     */
    public function destroy(Sgvpn $sgvpn)
    {
        $sgvpn->delete();

        return redirect('/sgvpns')->with('success', 'SG VPN account deleted successfully.');
    }
}
