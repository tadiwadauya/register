<?php

namespace App\Http\Controllers;

use App\Models\Sgvpn;
use Illuminate\Http\Request;

class SoftDeleteSgvpnController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Get Soft Deleted User.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public static function getDeletedSgvpnAccount($id)
    {
        $sgvpn = Sgvpn::onlyTrashed()->where('id', $id)->get();
        if (count($sgvpn) !== 1) {
            return redirect('/sgvpns/deleted/')->with('error', 'Nothing found');
        }

        return $sgvpn[0];
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sgvpns = Sgvpn::onlyTrashed()->get();

        return view('sgvpns.show-deleted-sgvpns', compact('sgvpns'));
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //$sgvpn = self::getDeletedSgvpnAccount($id);

        //return view('sgvpns.show-deleted-sgvpn', compact('sgvpn'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int                      $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $sgvpn = self::getDeletedSgvpnAccount($id);
        $sgvpn->restore();

        return redirect('/sgvpns/')->with('success', 'Account restored successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $sgvpn = self::getDeletedSgvpnAccount($id);
        $sgvpn->forceDelete();

        return redirect('/sgvpns/deleted/')->with('success', 'Account completely destroyed.');
    }
}
