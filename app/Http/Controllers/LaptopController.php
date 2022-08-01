<?php

namespace App\Http\Controllers;

use App\Models\Asset;
use App\Models\Laptop;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Validator;

class LaptopController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $laptops = Laptop::all()
        ->where('allocated','Yes');
        return view('laptops.laptops', compact('laptops'));
    }

    // public function nonallocatedlap()
    // {
    //     $laptops =Laptop::all()
    //     ->where('allocated','=','No');
    //     return view('laptops.nonlaptops', compact('laptops'));
    // }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::all();
        $last = DB::table('assets')->latest('id')->first();
//dd($last);
        if ($last == null){
            $latestId = 1;
        } else{
            $latestId = $last->id+1;
        }

        return view('laptops.add-laptop', compact('users', 'latestId'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
        $validator = Validator::make(
            $request->all(),
            [
                'assettag'                  => 'required|max:10|unique:assets',
                'ram'                  => 'required|max:10',
                'hdd'            => 'required',
                'antivirus'             => 'required',
                'os'                 => 'required',
                'office'                 => 'required',
                'username'                 => 'required',
                'model'                 => 'required',
                'serial'              => 'required|unique:assets',
                'purchased'             => 'required|date',
                'notes'                  => 'required',
                'warranty'                  => 'required',
            ],
            [
                'assettag.unique'         => 'This asset tag is already in the system. Please try again later',
                'assettag.required'       => 'This is not supposed to happen.',
                'ram.required'       => 'What is the RAM capacity of the laptop?',
                'hdd.required'          => 'What is the Hard drive on the laptop?',
                'antivirus.required'  => 'What is the anti virus installed on the computer?',
                'os.required'      => 'We need to know the current operating system?',
                'office.required'         => 'What is the installed Office version?',
                'username.required'         => 'Who is going to be using this computer?',
                'model.required'         => 'What is the computer brand & model?',
                'serial.unique'         => 'The serial number has to be unique. This one is already in the system',
                'serial.required'         => 'What is the computer serial number?',
                'purchased.required'         => 'When was this computer purchased?',
                'notes.required'         => 'You can at least put the processor information on this part.',
                'warranty.required'         => 'You can at least put 12 months.',
            ]
        );

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $asset = Asset::create([
            'username' => $request->input('username'),
            'model' => $request->input('model'),
            'type' => 'Laptop',
            'assettag' => $request->input('assettag'),
            'serial' => $request->input('serial'),
            'age' => 0.0,
            'purchased' => $request->input('purchased'),
            'notes' => $request->input('notes'),
            'warranty' => $request->input('warranty'),
        ]);
        $asset->save();

        if($asset->save()) {
            $laptop = Laptop::create([
                'assettag'             => strip_tags($request->input('assettag')),
                'ram'             => $request->input('ram'),
                'hdd'       => $request->input('hdd'),
                'antivirus'        => $request->input('antivirus'),
                'os'            => $request->input('os'),
                'office'            => $request->input('office'),
            ]);
            $laptop->save();
        }

        return redirect('laptops')->with('success', 'Laptop has been added successfully.');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Laptop  $laptop
     * @return \Illuminate\Http\Response
     */
    public function show(Laptop $laptop)
    {
        $asset = \App\Models\Asset::all()->where('assettag', $laptop->assettag)->first();
        $yuser = \App\Models\User::all()->where('paynumber', $asset->username )->first();

        return view('laptops.laptop-info', compact('laptop','asset', 'yuser'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Laptop  $laptop
     * @return \Illuminate\Http\Response
     */
    public function edit(Laptop $laptop)
    {
        $users = User::all();
        $asset = \App\Models\Asset::all()->where('assettag', $laptop->assettag)->first();
        $yuser = \App\Models\User::all()->where('paynumber', $asset->username )->first();

        return view('laptops.edit-laptop', compact('laptop', 'asset','users', 'yuser'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Laptop  $laptop
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Laptop $laptop)
    {
        $asset = \App\Models\Asset::all()->where('assettag', $laptop->assettag)->first();

        $validator = Validator::make(
            $request->all(),
            [
                'ram'                  => 'required|max:10',
                'hdd'            => 'required',
                'antivirus'             => 'required',
                'os'                 => 'required',
                'office'                 => 'required',
                'allocated'        =>   'required',
                'username'                 => 'required',
                'model'                 => 'required',
                'serial'              => 'required|unique:assets,serial,'.$asset->id,
                'purchased'             => 'required|date',
                'notes'                  => 'required',
                'warranty'                  => 'required',

            ],
            [
                'ram.required'       => 'What is the RAM capacity of the desktop?',
                'hdd.required' => 'What is the Hard drive on the desktop?',
                'antivirus.required'  => 'What is the anti virus installed on the computer?',
                'os.required'      => 'We need to know the current operating system?',
                'office.required'         => 'What is the installed Office version?',
                'allocated.required'        =>   'Was it alloacted to someone',
                'position.required'         => 'What is the job title for this employee?',
                'username.unique'         => 'Who is going to be using this computer?',
                'model.required'         => 'What is the computer brand & model?',
                'serial.unique'         => 'The serial number has to be unique. This one is already in the system',
                'serial.required'         => 'What is the computer serial number?',
                'purchased.required'         => 'When was this computer purchased?',
                'notes.required'         => 'You can at least put the processor information on this part.',
                'warranty.required'         => 'You can at least put 12 months.',
            ]
        );

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $asset->username =  $request->input('username');
        $asset->model =  $request->input('model');
        $asset->serial =  $request->input('serial');
        $asset->purchased =  $request->input('purchased');
        $asset->notes =  $request->input('notes');
        $asset->warranty =  $request->input('warranty');

        $asset->save();

        if($asset->save()) {
            $laptop->ram = $request->input('ram');
            $laptop->hdd = $request->input('hdd');
            $laptop->antivirus = $request->input('antivirus');
            $laptop->os = $request->input('os');
            $laptop->office = $request->input('office');
            $laptop->allocated = $request->input('allocated');

            $laptop->save();
        }

        return redirect()->back()->with('success', 'Laptop '.$asset->assettag.' has been updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Laptop  $laptop
     * @return \Illuminate\Http\Response
     */
    public function destroy(Laptop $laptop)
    {
        DB::table("assets")->where("assettag", $laptop->assettag)->update(['deleted_at'=>now()]);
        DB::table("laptops")->where("assettag", $laptop->assettag)->update(['deleted_at'=>now()]);

        return redirect('laptops')->with('success', $laptop->assettag.' has been deleted successfully.');
    }
}
