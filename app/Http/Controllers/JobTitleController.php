<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\JobTitle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class JobTitleController extends Controller
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
        $jobtitles = JobTitle::all();

        return View('jobtitles.job-titles', compact('jobtitles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $departments = Department::all();

        return view('jobtitles.create-job-title', compact('departments'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {$validator = Validator::make($request->all(),
        [
            'department'           => 'required|max:255',
            'jobtitle'             => 'required|max:255',
        ],
        [
            'department.required'       => 'We obviously need a name for a department.',
            'jobtitle.required'         => 'We need a Job Title.',

        ]
    );

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $jobtitle = JobTitle::create([
            'department'             => $request->input('department'),
            'jobtitle'             => $request->input('jobtitle'),
        ]);

        $jobtitle->save();

        return redirect('jobtitles')->with('success', 'Successfully added Job Title.');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\JobTitle  $jobTitle
     * @return \Illuminate\Http\Response
     */
    public function show(JobTitle $jobTitle)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\JobTitle  $jobTitle
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $jobTitle = JobTitle::findOrFail($id);
        $departments = Department::all();

        return view('jobtitles.edit-job-title', compact('jobTitle','departments'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\JobTitle  $jobTitle
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {

        $jobTitle = JobTitle::findOrFail($id);
        $validator = Validator::make($request->all(),
            [
                'department'           => 'required|max:255',
                'jobtitle'             => 'required|max:255',
            ],
            [
                'department.required'       => 'We obviously need a name for a department.',
                'jobtitle.required'         => 'We need a Job Title.',

            ]
        );

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $jobTitle->department = $request->input('department');
        $jobTitle->jobtitle = $request->input('jobtitle');

        $jobTitle->save();

        return back()->with('success', 'Successfully updated job title.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\JobTitle  $jobTitle
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $jobTitle = JobTitle::findOrFail($id);
        $jobTitle->delete();

        return redirect('jobtitles')->with('success', 'Successfully deleted job title.');

    }

    public function getTitles($department)
    {
        $jobtitles = DB::table("job_titles")
            ->where("department",$department)
            ->pluck("jobtitle");

        return response()->json($jobtitles);
    }
}
