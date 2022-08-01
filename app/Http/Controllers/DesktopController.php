<?php

namespace App\Http\Controllers;

use App\Models\Asset;
use App\Models\Desktop;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Validator;

class DesktopController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $desktops = Desktop::all()
        ->where('allocated','Yes');
        return view('desktops.desktops', compact('desktops'));
    }

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

        return view('desktops.add-desktop', compact('latestId', 'users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
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
                'has_monitor'                  => 'boolean',
                'monitor_name'                  => 'required_if:has_monitor,1',
                'monitor_serial'                  => 'required_if:has_monitor,1',
                'has_keyboard'                  => 'boolean',
                'keyboard_name'                  => 'required_if:has_keyboard,1',
                'keyboard_serial'                  => 'required_if:has_keyboard,1',
                'has_mouse'                  => 'boolean',
                'mouse_name'                  => 'required_if:has_mouse,1',
                'mouse_serial'                  => 'required_if:has_mouse,1',
            ],
            [
                'assettag.unique'         => 'This asset tag is already in the system. Please try again later',
                'assettag.required'       => 'This is not supposed to happen.',
                'ram.required'       => 'What is the RAM capacity of the desktop?',
                'hdd.required' => 'What is the Hard drive on the desktop?',
                'antivirus.required'  => 'What is the anti virus installed on the computer?',
                'os.required'      => 'We need to know the current operating system?',
                'office.required'         => 'What is the installed Office version?',
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

        if( $request->has('has_monitor') ){
            $monitor = true;
        } else{
            $monitor = false;
        }

        if( $request->has('has_keyboard') ){
            $keyboard = true;
        } else {
            $keyboard = false;
        }

        if( $request->has('has_mouse') ){
            $mouse = true;
        } else {
            $mouse = false;
        }

        $asset = Asset::create([
            'username' => $request->input('username'),
            'model' => $request->input('model'),
            'type' => 'Desktop',
            'assettag' => $request->input('assettag'),
            'serial' => $request->input('serial'),
            'age' => 0.0,
            'purchased' => $request->input('purchased'),
            'notes' => $request->input('notes'),
            'warranty' => $request->input('warranty'),
        ]);
        $asset->save();

        if($asset->save()) {
            $desktop = Desktop::create([
                'assettag'             => strip_tags($request->input('assettag')),
                'ram'             => $request->input('ram'),
                'hdd'       => $request->input('hdd'),
                'antivirus'        => $request->input('antivirus'),
                'os'            => $request->input('os'),
                'office'            => $request->input('office'),
                'has_monitor'            => $monitor,
                'monitor_name'            => $request->input('monitor_name'),
                'monitor_serial'         => $request->input('monitor_serial'),
                'has_keyboard'            => $keyboard,
                'keyboard_name' => $request->input('keyboard_name'),
                'keyboard_serial'        => $request->input('keyboard_serial'),
                'has_mouse'        => $mouse,
                'mouse_name'        => $request->input('mouse_name'),
                'mouse_serial'        => $request->input('mouse_serial'),
            ]);
            $desktop->save();
        }

        return redirect('desktops')->with('success', 'Desktop for '.$request->input('username').' has been added successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Desktop  $desktop
     * @return \Illuminate\Http\Response
     */
    public function show(Desktop $desktop)
    {
        $asset = \App\Models\Asset::all()->where('assettag', $desktop->assettag)->first();
        $yuser = \App\Models\User::all()->where('paynumber', $asset->username )->first();

        return view('desktops.desktop-info', compact('desktop', 'asset', 'yuser'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Desktop  $desktop
     * @return \Illuminate\Http\Response
     */
    public function edit(Desktop $desktop)
    {
        $users = User::all();
        $asset = \App\Models\Asset::all()->where('assettag', $desktop->assettag)->first();
        $yuser = \App\Models\User::all()->where('paynumber', $asset->username )->first();

        return view('desktops.edit-desktop', compact('desktop', 'asset','users','yuser'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Desktop  $desktop
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Desktop $desktop)
    {
        $asset = \App\Models\Asset::all()->where('assettag', $desktop->assettag)->first();

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
                'has_monitor'                  => 'boolean',
                'monitor_name'                  => 'required_if:has_monitor,1',
                'monitor_serial'                  => 'required_if:has_monitor,1',
                'has_keyboard'                  => 'boolean',
                'keyboard_name'                  => 'required_if:has_keyboard,1',
                'keyboard_serial'                  => 'required_if:has_keyboard,1',
                'has_mouse'                  => 'boolean',
                'mouse_name'                  => 'required_if:has_mouse,1',
                'mouse_serial'                  => 'required_if:has_mouse,1',
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

        if( $request->has('has_monitor') ){
            $monitor = true;
        } else{
            $monitor = false;
        }

        if( $request->has('has_keyboard') ){
            $keyboard = true;
        } else {
            $keyboard = false;
        }

        if( $request->has('has_mouse') ){
            $mouse = true;
        } else {
            $mouse = false;
        }

        $asset->username =  $request->input('username');
        $asset->model =  $request->input('model');
        $asset->serial =  $request->input('serial');
        $asset->purchased =  $request->input('purchased');
        $asset->notes =  $request->input('notes');
        $asset->warranty =  $request->input('warranty');

        $asset->save();

        if($asset->save()) {
            $desktop->ram = $request->input('ram');
            $desktop->hdd = $request->input('hdd');
            $desktop->antivirus = $request->input('antivirus');
            $desktop->os = $request->input('os');
            $desktop->office = $request->input('office');
            $desktop->allocated = $request->input('allocated');
            $desktop->has_monitor = $monitor;
            $desktop->monitor_name = $request->input('monitor_name');
            $desktop->monitor_serial = $request->input('monitor_serial');
            $desktop->has_keyboard = $keyboard;
            $desktop->keyboard_name = $request->input('keyboard_name');
            $desktop->keyboard_serial = $request->input('keyboard_serial');
            $desktop->has_mouse = $mouse;
            $desktop->mouse_name = $request->input('mouse_name');
            $desktop->mouse_serial = $request->input('mouse_serial');

            $desktop->save();
        }

        return redirect()->back()->with('success', 'Desktop '.$asset->assettag.' has been updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Desktop  $desktop
     * @return \Illuminate\Http\Response
     */
    public function destroy(Desktop $desktop) {
        //$desktop->delete();
        DB::table("assets")->where("assettag", $desktop->assettag)->update(['deleted_at'=>now()]);
        DB::table("desktops")->where("assettag", $desktop->assettag)->update(['deleted_at'=>now()]);

        return redirect('desktops')->with('success', $desktop->assettag.' has been deleted successfully.');

    }
}
