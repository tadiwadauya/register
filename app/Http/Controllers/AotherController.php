<?php

namespace App\Http\Controllers;

use App\Models\Aother;
use App\Models\Asset;
use App\Models\Brand;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class AotherController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $aothers = Aother::all();
        return view('aothers.aothers', compact('aothers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::all();
        $brands = Brand::all();
        $last = DB::table('assets')->latest('id')->first();
        if ($last == null){
            $latestId = 1;
        } else{
            $latestId = $last->id+1;
        }

        return view('aothers.add-other', compact('users', 'brands', 'latestId'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),
            [
                'assettag'                  => 'required|max:10|unique:assets',
                'brand'           => 'required|max:255',
                'model'           => 'required|max:255',
                'type'           => 'required|max:255',
                'username'                 => 'required',
                'serial'              => 'required|unique:assets',
                'purchased'             => 'required|date',
                'notes'                  => 'required',
                'warranty'                  => 'required',
            ],
            [
                'assettag.unique'         => 'This asset tag is already in the system. Please try again later',
                'assettag.required'       => 'This is not supposed to happen.',
                'brand.required'     => 'We need a brand name.',
                'type.required'     => 'What is the device type?.',
                'username.required'         => 'Who is going to be using this computer?',
                'model.required'         => 'What is the asset model name?',
                'serial.unique'         => 'The serial number has to be unique. This one is already in the system',
                'serial.required'         => 'What is the harddrive serial number?',
                'purchased.required'         => 'When was this harddrive purchased?',
                'notes.required'         => 'You can at least state why the printer was bought on this part or where its being used.',
                'warranty.required'         => 'You can at least put 12 months.',
            ]
        );

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $asset = Asset::create([
            'username' => $request->input('username'),
            'model' => $request->input('brand'),
            'type' => 'Other',
            'assettag' => $request->input('assettag'),
            'serial' => $request->input('serial'),
            'age' => 0.0,
            'purchased' => $request->input('purchased'),
            'notes' => $request->input('notes'),
            'warranty' => $request->input('warranty'),
        ]);
        $asset->save();

        if($asset->save()) {
            $aother = Aother::create([
                'assettag' => $request->input('assettag'),
                'type' => $request->input('type'),
                'brand' => $request->input('brand'),
                'model' => $request->input('model'),
            ]);

            $aother->save();
        }

        return redirect('aothers')->with('success', 'Successfully added the asset.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Aother  $aother
     * @return \Illuminate\Http\Response
     */
    public function show(Aother $aother)
    {
        $asset = \App\Models\Asset::all()->where('assettag', $aother->assettag)->first();
        $yuser = \App\Models\User::all()->where('paynumber', $asset->username )->first();

        return view('aothers.asset-info', compact('aother', 'asset','yuser'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Aother  $aother
     * @return \Illuminate\Http\Response
     */
    public function edit(Aother $aother)
    {
        $users = User::all();
        $brands = Brand::all();
        $asset = \App\Models\Asset::all()->where('assettag', $aother->assettag)->first();
        $yuser = \App\Models\User::all()->where('paynumber', $asset->username )->first();

        return view('aothers.edit-asset', compact('aother', 'users','brands', 'asset', 'yuser'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Aother  $aother
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Aother $aother)
    {
        $asset = \App\Models\Asset::all()->where('assettag', $aother->assettag)->first();

        $validator = Validator::make($request->all(),
            [
                'brand'           => 'required|max:255',
                'model'           => 'required|max:255',
                'type'           => 'required|max:255',
                'username'                 => 'required',
                'serial'              => 'required|unique:assets,serial,'.$asset->id,
                'purchased'             => 'required|date',
                'notes'                  => 'required',
                'warranty'                  => 'required',
            ],
            [
                'brand.required'     => 'We need a brand name.',
                'type.required'     => 'What is the device type?.',
                'username.required'         => 'Who is going to be using this computer?',
                'model.required'         => 'What is the computer brand & model?',
                'serial.unique'         => 'The serial number has to be unique. This one is already in the system',
                'serial.required'         => 'What is the harddrive serial number?',
                'purchased.required'         => 'When was this harddrive purchased?',
                'notes.required'         => 'You can at least state why the harddrive was bought on this part.',
                'warranty.required'         => 'You can at least put 12 months.',
            ]
        );

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $asset->username =  $request->input('username');
        $asset->model =  $request->input('brand');
        $asset->serial =  $request->input('serial');
        $asset->purchased =  $request->input('purchased');
        $asset->notes =  $request->input('notes');
        $asset->warranty =  $request->input('warranty');

        $asset->save();

        if ($asset->save()) {
            $aother->type =  $request->input('type');
            $aother->brand =  $request->input('brand');
            $aother->model =  $request->input('model');

            $aother->save();
        }

        return redirect()->back()->with('success', $asset->assettag.' has been updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Aother  $aother
     * @return \Illuminate\Http\Response
     */
    public function destroy(Aother $aother)
    {
        DB::table("assets")->where("assettag", $aother->assettag)->update(['deleted_at'=>now()]);
        DB::table("aothers")->where("assettag", $aother->assettag)->update(['deleted_at'=>now()]);

        return redirect('aothers')->with('success', $aother->assettag.' has been deleted successfully.');
    }
}
