<?php

namespace App\Http\Controllers;

use App\Models\Asset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SoftDeleteAssetController extends Controller
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
    public static function getDeletedAsset($id)
    {
        $asset = Asset::onlyTrashed()->where('id', $id)->get();
        if (count($asset) !== 1) {
            return redirect('/iassets/deleted/')->with('error', 'Nothing found');
        }

        return $asset[0];
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $assets = Asset::onlyTrashed()->get();

        return View('assets.show-deleted-assets', compact('assets'));
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
        $asset = self::getDeletedAsset($id);

        return view('assets.show-deleted-asset', compact('asset'));
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
        $asset = self::getDeletedAsset($id);
        //$asset->restore();
        DB::table("assets")->where("assettag", $asset->assettag)->update(['deleted_at'=>null]);
        if ($asset->type == 'Desktop'){
            DB::table("desktops")->where("assettag", $asset->assettag)->update(['deleted_at'=>null]);
        } elseif ($asset->type == 'Laptop'){
            DB::table("laptops")->where("assettag", $asset->assettag)->update(['deleted_at'=>null]);
        }elseif ($asset->type == 'Harddrive'){
            DB::table("harddrives")->where("assettag", $asset->assettag)->update(['deleted_at'=>null]);
        }elseif ($asset->type == 'Printer'){
            DB::table("printers")->where("assettag", $asset->assettag)->update(['deleted_at'=>null]);
        }elseif ($asset->type == 'Other'){
            DB::table("aothers")->where("assettag", $asset->assettag)->update(['deleted_at'=>null]);
        }

        return redirect('/iassets/')->with('success', 'Asset restored successfully');
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
        $asset = self::getDeletedAsset($id);
        //$asset->forceDelete();
        DB::table("assets")->where("assettag", $asset->assettag)->delete();
        if ($asset->type == 'Desktop') {
            DB::table("desktops")->where("assettag", $asset->assettag)->delete();
        } elseif ($asset->type == 'Laptop') {
            DB::table("laptops")->where("assettag", $asset->assettag)->delete();
        }elseif ($asset->type == 'Harddrive') {
            DB::table("harddrives")->where("assettag", $asset->assettag)->delete();
        }elseif ($asset->type == 'Printer') {
            DB::table("printers")->where("assettag", $asset->assettag)->delete();
        }elseif ($asset->type == 'Other') {
            DB::table("aothers")->where("assettag", $asset->assettag)->delete();
        }

        return redirect('/iassets/deleted/')->with('success', 'Asset completely destroyed.');
    }
}
