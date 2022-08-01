<?php

namespace App\Http\Controllers;

class WelcomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function welcome()
    {
        return view('welcome');
    }

    public function unauthorized (){
        return view('unauthorized');
    }

    public function changepassword (){
        return view('change-password');
    }
}
