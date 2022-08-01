<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DepartmentController extends Controller
{
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
        $departments = Department::all();

        return View('departments.departments', compact('departments'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::all();
        return view('departments.add-department', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $validator = Validator::make($request->all(),
            [
                'department'                  => 'required|max:255|unique:departments',
                'manager'             => 'required|max:255|unique:departments',
                'asst_manager'            => 'max:255',
            ],
            [
                'department.unique'         => 'Department already exists',
                'manager.unique'         => 'A user can only manage one department at a time.',
                'asst_manager.unique'         => 'A user can only manage one department at a time.',
                'department.required'       => 'We obviously need a name for a department.',
                'manager.required' => 'We need a Manager name, or someone who will approve requests.',

            ]
        );

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $department = Department::create([
            'department'             => $request->input('department'),
            'manager'             => $request->input('manager'),
            'asst_manager'       => $request->input('asst_manager'),
        ]);

        $department->save();

        return redirect('departments')->with('success', 'Successfully created department.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function show(Department $department)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function edit(Department $department)
    {
        $users = User::all();
        return view('departments.edit-department', compact('department', 'users'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {

        $department = Department::find($id);

        $validator = Validator::make($request->all(),
            [
                'department'                  => 'required|max:255',
                'manager'             => 'required|max:255',
                'asst_manager'            => 'max:255',
            ],
            [
                'department.unique'         => 'Department already exists',
                'manager.unique'         => 'A user can only manage one department at a time.',
                'asst_manager.unique'         => 'A user can only manage one department at a time.',
                'department.required'       => 'We obviously need a name for a department.',
                'manager.required' => 'We need a Manager name, or someone who will approve requests.',

            ]
        );

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $department->department = $request->input('department');
        $department->manager = $request->input('manager');
        $department->asst_manager = $request->input('asst_manager');

        $department->save();

        return back()->with('success', 'Successfully updated department.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function destroy(Department $department)
    {
        $department->delete();

        return redirect('departments')->with('success', 'Successfully deleted department');
    }

    public function fetch(Request $request) {
        $select = $request->get('select');
        $value = $request->get('value');
        $dependent = $request->get('dependent');
        $data = DB::table('departments')
            ->where($select, $value)
            ->groupBy($dependent)
            ->get();
        $output = '<option value="">Select '.ucfirst($dependent).'</option>';
        foreach($data as $row)
        {
            $output .= '<option value="'.$row->$dependent.'">'.$row->$dependent.'</option>';
        }
        echo $output;
    }
}
