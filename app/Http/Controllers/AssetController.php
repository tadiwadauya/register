<?php

namespace App\Http\Controllers;

use App\Models\Asset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AssetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $assets = Asset::join('users','assets.username' , '=', 'users.paynumber')
            ->get();

        return view('assets.all-assets', compact('assets'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Asset  $asset
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        $asset = \App\Models\Asset::where('assettag', $id)->first();

        //$assetInfo = DB::table("assets")->where("assettag", $asset->assettag)->first();
        if ($asset->type == 'Desktop') {
            $assetInfo = DB::table("desktops")->where("assettag", $asset->assettag)->first();
        } elseif ($asset->type == 'Laptop') {
            $assetInfo = DB::table("laptops")->where("assettag", $asset->assettag)->first();
        }elseif ($asset->type == 'Harddrive') {
            $assetInfo = DB::table("harddrives")->where("assettag", $asset->assettag)->first();
        }elseif ($asset->type == 'Printer') {
            $assetInfo = DB::table("printers")->where("assettag", $asset->assettag)->first();
        }elseif ($asset->type == 'Other') {
            $assetInfo = DB::table("aothers")->where("assettag", $asset->assettag)->first();
        }

        $yuser = \App\Models\User::all()->where('paynumber', $asset->username )->first();

        return view('assets.show-asset', compact('asset', 'assetInfo', 'yuser'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Asset  $asset
     * @return \Illuminate\Http\Response
     */
    public function edit(Asset $asset)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Asset  $asset
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Asset $asset)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Asset  $asset
     * @return \Illuminate\Http\Response
     */
    public function destroy(Asset $asset)
    {
        //
    }



    public function getAssetsReport(){

        $assets = DB::table('assets as a')
            ->join('users as u', function($join) {
                $join->on('u.paynumber', '=', 'a.username');
            })
            ->select('u.first_name','u.last_name','u.location','a.model','a.type','a.assettag','a.serial','a.age','a.allocated')
            ->get();

        return view('assets.assets-report',compact('assets'));
    }

    public function updateAssetsAge(){
        $allAssets = DB::table('assets')
            ->select('id', 'purchased')
            ->get();

        foreach ($allAssets as $asset){
            $now = time(); // or your date as well
            $your_date = strtotime($asset->purchased);
            $datediff = $now - $your_date;

            $days = round($datediff / (60 * 60 * 24));

            $age = $days/365;

            $age_formatted = number_format((float)$age, 2, '.', '');

            DB::table("assets")->where("id", $asset->id)->update(['age'=>$age_formatted,'updated_at'=>now()]);
        }

        return redirect()->back()->with('success', 'Assets age updated successfully.');

    }

}
