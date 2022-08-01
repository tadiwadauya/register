<?php

namespace App\Http\Controllers;

use App\Models\Licence;
use Illuminate\Http\Request;
use Validator;

class LicenceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $licences = Licence::all();
        return view('licences.licences', compact('licences'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('licences.add-licence');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'licname'                  => 'required',
                'lickey'            => 'required|unique:licences',
                'software'             => 'required',
                'expirydate'                 => 'required',
                'date_bought'              => 'required',
                'lic_users'              => 'required',
            ],
            [
                'licname.required'       => 'What is the name of the licence software purchased?',
                'lickey.required'       => 'What is the licence key?',
                'lickey.unique'       => 'This licence is already added in the IT Reggy.',
                'software.required'          => 'What is the name of the software?',
                'expirydate.required'  => 'When will the licence expire?',
                'date_bought.required'         => 'When was the licence purchased?',
                'lic_users.required'         => 'How many users/computers will the licence accommodate?',
            ]
        );

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $licence = Licence::create([
            'licname' => $request->input('licname'),
            'lickey' => $request->input('lickey'),
            'software' => $request->input('software'),
            'expirydate' => $request->input('expirydate'),
            'date_bought' => $request->input('date_bought'),
            'lic_users' => $request->input('lic_users'),
        ]);
        $licence->save();

        return redirect('licences')->with('success', 'Licence has been added successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Licence  $licence
     * @return \Illuminate\Http\Response
     */
    public function show(Licence $licence)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Licence  $licence
     * @return \Illuminate\Http\Response
     */
    public function edit(Licence $licence)
    {
        return view('licences.edit-licence', compact('licence'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Licence  $licence
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Licence $licence)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'licname'                  => 'required',
                'lickey'            => 'required|unique:licences,lickey,'.$licence->id,
                'software'             => 'required',
                'expirydate'                 => 'required',
                'date_bought'              => 'required',
                'lic_users'              => 'required',
            ],
            [
                'licname.required'       => 'What is the name of the licence software purchased?',
                'lickey.required'       => 'What is the licence key?',
                'lickey.unique'       => 'This licence is already added in the IT Reggy.',
                'software.required'          => 'What is the name of the software?',
                'expirydate.required'  => 'When will the licence expire?',
                'date_bought.required'         => 'When was the licence purchased?',
                'lic_users.required'         => 'How many users/computers will the licence accommodate?',
            ]
        );

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $licence->licname = $request->input('licname');
        $licence->lickey = $request->input('lickey');
        $licence->software = $request->input('software');
        $licence->expirydate = $request->input('expirydate');
        $licence->date_bought = $request->input('date_bought');
        $licence->lic_users = $request->input('lic_users');

        $licence->save();

        return redirect('licences/'.$licence->id.'/edit')->with('success', $request->input('licname').' has been updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Licence  $licence
     * @return \Illuminate\Http\Response
     */
    public function destroy(Licence $licence)
    {
        $licence->delete();
        return redirect('licences')->with('success', 'Licence has been deleted successfully.');
    }
}
