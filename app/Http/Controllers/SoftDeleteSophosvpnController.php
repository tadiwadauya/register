<?php

namespace App\Http\Controllers;

use App\Models\Sophosvpn;
use Illuminate\Http\Request;

class SoftDeleteSophosvpnController extends Controller
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
    public static function getDeletedSophosvpnAccount($id)
    {
        $sophosvpn = Sophosvpn::onlyTrashed()->where('id', $id)->get();
        if (count($sophosvpn) !== 1) {
            return redirect('/sophosvpns/deleted/')->with('error', 'Nothing found');
        }

        return $sophosvpn[0];
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sophosvpns = Sophosvpn::onlyTrashed()->get();

        return view('sophos.show-deleted-sophosvpns', compact('sophosvpns'));
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
        //$sophosvpn = self::getDeletedSophosvpnAccount($id);

        //return view('sophosvpns.show-deleted-sgvpn', compact('sgvpn'));
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
        $sophosvpn = self::getDeletedSophosvpnAccount($id);
        $sophosvpn->restore();

        return redirect('/sophosvpns/')->with('success', 'Account restored successfully');
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
        $sophosvpn = self::getDeletedSophosvpnAccount($id);
        $sophosvpn->forceDelete();

        return redirect('/sophosvpns/deleted/')->with('success', 'Account completely destroyed.');
    }
}
