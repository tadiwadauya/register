<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Zamaccount;
use Illuminate\Http\Request;
use Validator;

class ZamaccountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $zamaccounts = Zamaccount::all();
        return view('zamaccounts.zamaccounts', compact('zamaccounts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::all();
        return view('zamaccounts.add-account', compact('users'));
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
                'email'            => 'required|unique:zamaccounts|regex:/(.*)gdczambia\.co\.zm$/i',
                'password'             => 'required',
                'prev_password'                 => 'required',
                'last_agent'              => 'required',
            ],
            [
                'user.required'       => 'We need to know who will be using this account',
                'email.required'       => 'What is the email account?',
                'email.unique'       => 'This email was already added in the system.',
                'email.regex'       => 'IT Reggy appreciates your effort on typing this, however IT Reggy will save this account if its from the GDC Zambia domain!',
                'password.required'          => 'What is the password for the account?',
                'prev_password.required'  => 'What is the previous password for the account?',
                'last_agent.required'         => 'Please make sure that you are logged in.',
            ]
        );

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $zamaccount = Zamaccount::create([
            'user' => $request->input('user'),
            'email' => $request->input('email'),
            'password' => $request->input('password'),
            'prev_password' => $request->input('prev_password'),
            'last_agent' => $request->input('last_agent'),
        ]);
        $zamaccount->save();

        return redirect('zamaccounts')->with('success', 'O365 account for '.$request->input('user').' has been added successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Zamaccount  $zamaccount
     * @return \Illuminate\Http\Response
     */
    public function show(Zamaccount $zamaccount)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Zamaccount  $zamaccount
     * @return \Illuminate\Http\Response
     */
    public function edit(Zamaccount $zamaccount)
    {
        $users = User::all();
        return view('zamaccounts.edit-account', compact('zamaccount','users'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Zamaccount  $zamaccount
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Zamaccount $zamaccount)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'user'                  => 'required',
                'email'            => 'required|regex:/(.*)gdczambia\.co\.zm$/i|unique:zamaccounts,email,'.$zamaccount->id,
                'password'             => 'required',
                'prev_password'                 => 'required',
                'last_agent'              => 'required',
            ],
            [
                'user.required'       => 'We need to know who will be using this account',
                'email.required'       => 'What is the email account?',
                'email.unique'       => 'This email was already added in the system.',
                'email.regex'       => 'IT Reggy appreciates your effort on typing this, however IT Reggy will save this account if its from the GDC Zambia domain!',
                'password.required'          => 'What is the password for the account?',
                'prev_password.required'  => 'What is the previous password for the account?',
                'last_agent.required'         => 'Please make sure that you are logged in.',
            ]
        );

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $zamaccount->user = $request->input('user');
        $zamaccount->email = $request->input('email');
        $zamaccount->password = $request->input('password');
        $zamaccount->prev_password = $request->input('prev_password');
        $zamaccount->last_agent = $request->input('last_agent');

        $zamaccount->save();

        return redirect('zamaccounts/'.$zamaccount->id.'/edit')->with('success', 'O365 account for '.$request->input('user').' has been updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Zamaccount  $zamaccount
     * @return \Illuminate\Http\Response
     */
    public function destroy(Zamaccount $zamaccount)
    {
        $zamaccount->delete();
        return redirect('zamaccounts')->with('success', 'Account has been deleted');
    }
}
