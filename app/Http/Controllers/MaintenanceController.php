<?php

namespace App\Http\Controllers;

use App\Models\Maintenance;
use App\Models\Noncompliant;
use App\Models\User;
use App\Notifications\NonCompliedUser;
use App\Traits\CaptureIpTrait;
use Illuminate\Http\Request;
use Input;
use Validator;
use function React\Promise\reduce;

class MaintenanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $logs = Maintenance::all();
        return view('maintenances.maintenances', compact('logs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::all();
        $ipAddress = new CaptureIpTrait();
        $ipAddress->getClientIp();


        return view('maintenances.add-log', compact('users', 'ipAddress'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'agent'                  => 'required',
                'ip_address'            => 'required|ipv4',
                'username'             => 'required',
                'department'                 => 'required',
            ],
            [
                'agent.required'       => 'Please make sure you\'re logged in.',
                'ip_address.required'       => 'What is the IP Address of the computer being checked?',
                'ip_address.ipv4'         => 'The IP address should be of IPv4 format.',
                'username.required'          => 'Who is the employee being inspected?',
                'department.required'  => 'What is the employee department?',
            ]
        );

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        if ($request->input('monitor') == '1'){
            $monitor = true;
        } else {
            $monitor = false;
        }

        if ($request->input('cpu') == 1){
            $cpu = true;
        } else {
            $cpu = false;
        }

        if ($request->input('keyboard') == 1){
            $keyboard = true;
        } else {
            $keyboard = false;
        }

        if ($request->input('mouse') == 1){
            $mouse = true;
        } else {
            $mouse = false;
        }

        if ($request->input('desk') == 1){
            $desk = true;
        } else {
            $desk = false;
        }

        $all_five = $monitor + $cpu + $keyboard + $mouse + $desk;

        if ($all_five == 5) {
            $all = true;
        } else {
            $all = false;
        }

        $log = Maintenance::create([
            'agent' => $request->input('agent'),
            'ip_address' => $request->input('ip_address'),
            'username' => $request->input('username'),
            'department' => $request->input('department'),
            'all_five' => $all,
            'monitor' => $monitor,
            'cpu' => $cpu,
            'keyboard' => $keyboard,
            'mouse' => $mouse,
            'desk' => $desk,
        ]);
        $log->save();

        return redirect('maintenances')->with('success', 'Maintenance log for '.$request->input('username'). ' has been added successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Maintenance  $maintenance
     * @return \Illuminate\Http\Response
     */
    public function show(Maintenance $maintenance)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Maintenance  $maintenance
     * @return \Illuminate\Http\Response
     */
    public function edit(Maintenance $maintenance)
    {
        $users = User::all();

        return view('maintenances.edit-log', compact('maintenance','users'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Maintenance  $maintenance
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Maintenance $maintenance)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'ip_address'            => 'required',
                'username'             => 'required',
                'department'                 => 'required',
            ],
            [
                'ip_address.required'       => 'What is the IP Address of the computer being checked?',
                'username.required'          => 'Who is the employee being inspected?',
                'department.required'  => 'What is the employee department?',
            ]
        );

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        if ($request->input('monitor') == '1'){
            $monitor = true;
        } else {
            $monitor = false;
        }

        if ($request->input('cpu') == 1){
            $cpu = true;
        } else {
            $cpu = false;
        }

        if ($request->input('keyboard') == 1){
            $keyboard = true;
        } else {
            $keyboard = false;
        }

        if ($request->input('mouse') == 1){
            $mouse = true;
        } else {
            $mouse = false;
        }

        if ($request->input('desk') == 1){
            $desk = true;
        } else {
            $desk = false;
        }

        $all_five = $monitor + $cpu + $keyboard + $mouse + $desk;

        if ($all_five == 5) {
            $all = true;
        } else {
            $all = false;
        }

        $maintenance->ip_address = $request->input('ip_address');
        $maintenance->username = $request->input('username');
        $maintenance->department = $request->input('department');
        $maintenance->all_five = $all;
        $maintenance->monitor = $monitor;
        $maintenance->cpu = $cpu;
        $maintenance->keyboard = $keyboard;
        $maintenance->mouse = $mouse;
        $maintenance->desk = $desk;

        $maintenance->save();

        return redirect()->back()->with('success', 'Maintenance log for '.$request->input('username'). ' has been updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Maintenance  $maintenance
     * @return \Illuminate\Http\Response
     */
    public function destroy(Maintenance $maintenance)
    {
        $maintenance->delete();

        return redirect('maintenances')->with('success', 'Entry deleted successfully.');
    }

    public function getUserAramba(){
    $admins = User::where('department', 'I.T')->get();

        $ipAddress = new CaptureIpTrait();
        //$ipAddress = '192.168.1.23';
        $user = \App\Models\User::where('ip_address', $ipAddress->ipAddress)->first();
        $agent = $user->name;
        $dept = $user->department;

    foreach($admins as $admin){
        $details = [
            'greeting' => 'Good day I.T , ',
            'body' => 'The user on IP Address '.$ipAddress->ipAddress . ' registered as ' . $agent . ' (' . $user->first_name .' '. $user->last_name . ') has refused to comply with Whelson IT, Maintenance Policy.',
        ];

        //echo $admin;
        $admin->notify(new NonCompliedUser($details));
    }

    $regAramba = Noncompliant::create([
        'agent' => $agent,
        'ip_address' => $ipAddress->ipAddress,
        'username' => $user->first_name .' '. $user->last_name,
        'department' => $dept,
    ]);

    $regAramba->save();

        return view('maintenances.non-compliant-user');
    }

    public function getMaintenanceLog(){
        return view('maintenances.self-log');
    }

    public function saveMaintenanceLog(Request $request){
        $validator = Validator::make(
            $request->all(),
            [
                'agent'                  => 'required',
                'ip_address'            => 'required|ipv4',
                'username'             => 'required',
                'department'                 => 'required',
            ],
            [
                'agent.required'       => 'Please make sure you\'re logged in.',
                'ip_address.required'       => 'What is the IP Address of the computer being checked?',
                'ip_address.ipv4'         => 'The IP address should be of IPv4 format.',
                'username.required'          => 'Who is the employee being inspected?',
                'department.required'  => 'What is the employee department?',
            ]
        );

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        if ($request->input('monitor') == '1'){
            $monitor = true;
        } else {
            $monitor = false;
        }

        if ($request->input('cpu') == 1){
            $cpu = true;
        } else {
            $cpu = false;
        }

        if ($request->input('keyboard') == 1){
            $keyboard = true;
        } else {
            $keyboard = false;
        }

        if ($request->input('mouse') == 1){
            $mouse = true;
        } else {
            $mouse = false;
        }

        if ($request->input('desk') == 1){
            $desk = true;
        } else {
            $desk = false;
        }

        $all_five = $monitor + $cpu + $keyboard + $mouse + $desk;

        if ($all_five == 5) {
            $all = true;
        } else {
            $all = false;
        }

        $log = Maintenance::create([
            'agent' => $request->input('agent'),
            'ip_address' => $request->input('ip_address'),
            'username' => $request->input('username'),
            'department' => $request->input('department'),
            'all_five' => $all,
            'monitor' => $monitor,
            'cpu' => $cpu,
            'keyboard' => $keyboard,
            'mouse' => $mouse,
            'desk' => $desk,
        ]);
        $log->save();

        return redirect('/')->with('success', 'Maintenance log record has been added successfully.');
    }

    public function getNonCompliantUsers(){
        $users = Noncompliant::all();
        return view('maintenances.noncompliant-users', compact('users'));
    }
}
