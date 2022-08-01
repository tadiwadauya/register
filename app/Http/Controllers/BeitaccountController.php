<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Beitaccount;
use Illuminate\Http\Request;
use Validator;

class BeitaccountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $beitaccounts = Beitaccount::all();
        return view('beitaccounts.beitaccounts', compact('beitaccounts'));
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::all();
        return view('beitaccounts.add-account', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $validator = Validator::make(
            $request->all(),
            [
                'user'                  => 'required',
                'email'            => 'required|unique:beitaccounts|regex:/(.*)beitbridge.whelson\.co\.zw$/i',
                'password'             => 'required',
                'prev_password'                 => 'required',
                'last_agent'              => 'required',
            ],
            [
                'user.required'       => 'We need to know who will be using this account',
                'email.required'       => 'What is the email account?',
                'email.unique'       => 'This email was already added in the system.',
                'email.regex'       => 'IT Reggy appreciates your effort on typing this, however IT Reggy will save this account if its from the GDC Beitbridge domain!',
                'password.required'          => 'What is the password for the account?',
                'prev_password.required'  => 'What is the previous password for the account?',
                'last_agent.required'         => 'Please make sure that you are logged in.',
            ]
        );

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $beitaccount = beitaccount::create([
            'user' => $request->input('user'),
            'email' => $request->input('email'),
            'password' => $request->input('password'),
            'prev_password' => $request->input('prev_password'),
            'last_agent' => $request->input('last_agent'),
        ]);
        $beitaccount->save();

        return redirect('beitaccounts')->with('success', 'O365 account for '.$request->input('user').' has been added successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Beitaccount  $beitaccount
     * @return \Illuminate\Http\Response
     */
    public function show(Beitaccount $beitaccount)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Beitaccount  $beitaccount
     * @return \Illuminate\Http\Response
     */
    public function edit(Beitaccount $beitaccount)
    {
        $users = User::all();
        return view('beitaccounts.edit-account', compact('beitaccount','users'));
    }


    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Beitaccount  $beitaccount
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Beitaccount $beitaccount)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'user'                  => 'required',
                'email'            => 'required|regex:/(.*)beitbridge.whelson\.co\.zw$/i|unique:beitaccounts,email,'.$beitaccount->id,
                'password'             => 'required',
                'prev_password'                 => 'required',
                'last_agent'              => 'required',
            ], 
            [
                'user.required'       => 'We need to know who will be using this account',
                'email.required'       => 'What is the email account?',
                'email.unique'       => 'This email was already added in the system.',
                'email.regex'       => 'IT Reggy appreciates your effort on typing this, however IT Reggy will save this account if its from the GDC Harare domain!',
                'password.required'          => 'What is the password for the account?',
                'prev_password.required'  => 'What is the previous password for the account?',
                'last_agent.required'         => 'Please make sure that you are logged in.',
            ]
        );

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $beitaccount->user = $request->input('user');
        $beitaccount->email = $request->input('email');
        $beitaccount->password = $request->input('password');
        $beitaccount->prev_password = $request->input('prev_password');
        $beitaccount->last_agent = $request->input('last_agent');

        $beitaccount->save();

        return redirect('beitaccounts/'.$beitaccount->id.'/edit')->with('success', 'O365 account for '.$request->input('user').' has been updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Beitaccount  $beitaccount
     * @return \Illuminate\Http\Response
     */
    public function destroy(Beitaccount $beitaccount)
    {
        $beitaccount->delete();
        return redirect('beitaccounts')->with('success', 'Account has been deleted');
    }
}
