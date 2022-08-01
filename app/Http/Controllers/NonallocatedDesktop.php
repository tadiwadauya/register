<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Asset;
use App\Models\Desktop;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Validator;

class NonallocatedDesktop extends Controller
{

    public function index()
    {
        $desktops = Desktop::all()
        ->where('allocated','No');
        return view('desktops.desktops', compact('desktops'));
    }
}
