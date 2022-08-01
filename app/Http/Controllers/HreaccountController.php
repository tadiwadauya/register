<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Hreaccount;
use Illuminate\Http\Request;
use Validator;

class HreaccountController extends Controller
{
  /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $hreaccounts = Hreaccount::all();
        return view('hreaccounts.hreaccounts', compact('hreaccounts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::all();
        return view('hreaccounts.add-account', compact('users'));
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
                'email'            => 'required|unique:hreaccounts|regex:/(.*)whelson\.co\.zw$/i',
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

        $hreaccount = hreaccount::create([
            'user' => $request->input('user'),
            'email' => $request->input('email'),
            'password' => $request->input('password'),
            'prev_password' => $request->input('prev_password'),
            'last_agent' => $request->input('last_agent'),
        ]);
        $hreaccount->save();

        return redirect('hreaccounts')->with('success', 'O365 account for '.$request->input('user').' has been added successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Hreaccount  $hreaccount
     * @return \Illuminate\Http\Response
     */
    public function show(Hreaccount $hreaccount)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Hreaccount  $hreaccount
     * @return \Illuminate\Http\Response
     */
    public function edit(Hreaccount $hreaccount)
    {
        $users = User::all();
        return view('hreaccounts.edit-account', compact('hreaccount','users'));
    }


    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Hreaccount  $hreaccount
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Hreaccount $hreaccount)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'user'                  => 'required',
                'email'            => 'required|regex:/(.*)whelson\.co\.zw$/i|unique:hreaccounts,email,'.$hreaccount->id,
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

        $hreaccount->user = $request->input('user');
        $hreaccount->email = $request->input('email');
        $hreaccount->password = $request->input('password');
        $hreaccount->prev_password = $request->input('prev_password');
        $hreaccount->last_agent = $request->input('last_agent');

        $hreaccount->save();

        return redirect('hreaccounts/'.$hreaccount->id.'/edit')->with('success', 'O365 account for '.$request->input('user').' has been updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Hreaccount  $hreaccount
     * @return \Illuminate\Http\Response
     */
    public function destroy(Hreaccount $hreaccount)
    {
        $hreaccount->delete();
        return redirect('hreaccounts')->with('success', 'Account has been deleted');
    }
}
