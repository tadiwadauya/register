<?php

namespace App\Http\Controllers;

use App\Models\Asset;
use App\Models\User;
use Illuminate\Http\Request;

class SearchController extends Controller
{

    /**
     * SearchController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function find(Request $request)
    {
        return Asset::search($request->get('q'))
            ->leftJoin('users', 'assets.username', '=', 'users.paynumber')
            ->get();
    }
}
