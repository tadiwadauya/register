<?php

namespace App\Http\Controllers;

use App\Models\Sophosvpn;
use Illuminate\Http\Request;
use Validator;

class SophosvpnController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sophosvpns = Sophosvpn::all();
        return view('sophos.sophosvpns', compact('sophosvpns'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('sophos.create-sophos');
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
                'employee'                  => 'required',
                'user'            => 'required',
                'password'             => 'required',
                'status'                 => 'required',
                'accounttype'                 => 'required',
            ],
            [
                'employee.required'       => 'We need to know who will be using this account',
                'user.required'       => 'What is the username for the account?',
                'password.required'          => 'What is the password for the account?',
                'status.required'      => 'What state is the account in?',
                'accounttype.required'         => 'What type of user account is this?',
            ]
        );

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $sophosvpn = Sophosvpn::create([
            'employee' => $request->input('employee'),
            'user' => $request->input('user'),
            'password' => $request->input('password'),
            'status' => $request->input('status'),
            'accounttype' => $request->input('accounttype'),
        ]);
        $sophosvpn->save();

        return redirect('sophosvpns')->with('success', 'Sophos VPN account for '.$request->input('employee').' has been added successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Sophosvpn  $sophosvpn
     * @return \Illuminate\Http\Response
     */
    public function show(Sophosvpn $sophosvpn)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Sophosvpn  $sophosvpn
     * @return \Illuminate\Http\Response
     */
    public function edit(Sophosvpn $sophosvpn)
    {
        return view('sophos.edit-sophos', compact('sophosvpn'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Sophosvpn  $sophosvpn
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Sophosvpn $sophosvpn)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'employee'                  => 'required',
                'user'            => 'required',
                'password'             => 'required',
                'status'                 => 'required',
                'accounttype'                 => 'required',
            ],
            [
                'employee.required'       => 'We need to know who will be using this account',
                'user.required'       => 'What is the username for the account?',
                'password.required'          => 'What is the password for the account?',
                'status.required'      => 'What state is the account in?',
                'accounttype.required'         => 'What type of user account is this?',
            ]
        );

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $sophosvpn->employee = $request->input('employee');
        $sophosvpn->user = $request->input('user');
        $sophosvpn->password = $request->input('password');
        $sophosvpn->status = $request->input('status');
        $sophosvpn->accounttype = $request->input('accounttype');

        $sophosvpn->save();

        return redirect('sophosvpns/'.$sophosvpn->id.'/edit')->with('success', 'Sophos VPN account for '.$request->input('employee').' has been updated successfully.');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Sophosvpn  $sophosvpn
     * @return \Illuminate\Http\Response
     */
    public function destroy(Sophosvpn $sophosvpn)
    {
        $sophosvpn->delete();

        return redirect('/sophosvpns')->with('success', 'Sophos VPN account deleted successfully.');
    }
}
