<?php

namespace App\Http\Controllers;

use App\Models\Asset;
use App\Models\Brand;
use App\Models\Harddrive;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class HarddriveController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $harddrives = Harddrive::all();

        return view('harddrives.harddrives', compact('harddrives'));
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

        return view('harddrives.add-harddrive', compact('users','brands', 'latestId'));
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
                'capacity'           => 'required|max:255',
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
                'capacity.required'     => 'What is the hard drive capacity?',
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

        $asset = Asset::create([
            'username' => $request->input('username'),
            'model' => $request->input('brand'),
            'type' => 'Harddrive',
            'assettag' => $request->input('assettag'),
            'serial' => $request->input('serial'),
            'age' => 0.0,
            'purchased' => $request->input('purchased'),
            'notes' => $request->input('notes'),
            'warranty' => $request->input('warranty'),
        ]);
        $asset->save();

        if($asset->save()) {
            $harddrive = Harddrive::create([
                'assettag' => $request->input('assettag'),
                'brand' => $request->input('brand'),
                'model' => $request->input('model'),
                'capacity' => $request->input('capacity'),
            ]);

            $harddrive->save();
        }

        return redirect('harddrives')->with('success', 'Successfully added the '.$request->input('brand'). ' hard drive.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Harddrive  $harddrive
     * @return \Illuminate\Http\Response
     */
    public function show(Harddrive $harddrive)
    {
        $asset = \App\Models\Asset::all()->where('assettag', $harddrive->assettag)->first();
        $yuser = \App\Models\User::all()->where('paynumber', $asset->username )->first();

        return view('harddrives.show-hdd', compact('harddrive', 'asset','yuser'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Harddrive  $harddrive
     * @return \Illuminate\Http\Response
     */
    public function edit(Harddrive $harddrive)
    {
        $users = User::all();
        $brands = Brand::all();
        $asset = \App\Models\Asset::all()->where('assettag', $harddrive->assettag)->first();
        $yuser = \App\Models\User::all()->where('paynumber', $asset->username )->first();

        return view('harddrives.edit-harddrive', compact('harddrive', 'users','brands', 'asset', 'yuser'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Harddrive  $harddrive
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Harddrive $harddrive)
    {
        $asset = \App\Models\Asset::all()->where('assettag', $harddrive->assettag)->first();

        $validator = Validator::make($request->all(),
            [
                'brand'           => 'required|max:255',
                'model'           => 'required|max:255',
                'capacity'           => 'required|max:255',
                'username'                 => 'required',
                'serial'              => 'required|unique:assets,serial,'.$asset->id,
                'purchased'             => 'required|date',
                'notes'                  => 'required',
                'warranty'                  => 'required',
            ],
            [
                'brand.required'     => 'We need a brand name.',
                'capacity.required'     => 'What is the hard drive capacity?',
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
            $harddrive->brand =  $request->input('brand');
            $harddrive->model =  $request->input('model');
            $harddrive->capacity =  $request->input('capacity');

            $harddrive->save();
        }

        return redirect()->back()->with('success', 'Hard drive '.$asset->assettag.' has been updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Harddrive  $harddrive
     * @return \Illuminate\Http\Response
     */
    public function destroy(Harddrive $harddrive)
    {
        DB::table("assets")->where("assettag", $harddrive->assettag)->update(['deleted_at'=>now()]);
        DB::table("harddrives")->where("assettag", $harddrive->assettag)->update(['deleted_at'=>now()]);

        return redirect('harddrives')->with('success', $harddrive->assettag.' has been deleted successfully.');
    }
}
