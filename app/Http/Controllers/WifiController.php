<?php

namespace App\Http\Controllers;

use App\Models\Wifi;
use Illuminate\Http\Request;
use Validator;

class WifiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $wifis = Wifi::all();
        return view('wifis.wifis', compact('wifis'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('wifis.add-wifi');
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
                'wifi'                  => 'required',
                'location'            => 'required',
                'password'             => 'required',
                'username'                 => 'required',
                'router_pwd'              => 'required',
                'comments'              => 'nullable',
                'router_ip'              => 'required|ipv4|unique:wifis',
                'ip_range'              => 'required',
            ],
            [
                'wifi.required'       => 'What is the SSID for the network?',
                'location.required'       => 'Where is the router placed?',
                'password.unique'       => 'What is the WiFi password?',
                'username.required'          => 'What is the router username?',
                'router_pwd.required'  => 'What is the router password?',
                'router_ip.required'         => 'IT Reggy needs the Router IP address',
                'router_ip.ipv4'         => 'Seems like the IP Address format you used is not a valid one...It has to be IPv4.',
                'router_ip.unique'         => 'Another Router is already using this IP Address. You might want to use another one.',
                'ip_range.required'         => 'What is the DHCP pool for this router?',
            ]
        );

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $wifi = Wifi::create([
            'wifi' => $request->input('wifi'),
            'location' => $request->input('location'),
            'password' => $request->input('password'),
            'username' => $request->input('username'),
            'router_pwd' => $request->input('router_pwd'),
            'comments' => $request->input('comments'),
            'router_ip' => $request->input('router_ip'),
            'ip_range' => $request->input('ip_range'),
        ]);
        $wifi->save();

        return redirect('wifis')->with('success', $request->input('wifi').' has been added successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Wifi  $wifi
     * @return \Illuminate\Http\Response
     */
    public function show(Wifi $wifi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Wifi  $wifi
     * @return \Illuminate\Http\Response
     */
    public function edit(Wifi $wifi)
    {
        return view('wifis.edit-wifi', compact('wifi'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Wifi  $wifi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Wifi $wifi)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'wifi'                  => 'required',
                'location'            => 'required',
                'password'             => 'required',
                'username'                 => 'required',
                'router_pwd'              => 'required',
                'comments'              => 'nullable',
                'router_ip'              => 'required|ipv4|unique:wifis,router_ip,'.$wifi->id,
                'ip_range'              => 'required',
            ],
            [
                'wifi.required'       => 'What is the SSID for the network?',
                'location.required'       => 'Where is the router placed?',
                'password.unique'       => 'What is the WiFi password?',
                'username.required'          => 'What is the router username?',
                'router_pwd.required'  => 'What is the router password?',
                'router_ip.required'         => 'IT Reggy needs the Router IP address',
                'router_ip.ipv4'         => 'Seems like the IP Address format you used is not a valid one...It has to be IPv4.',
                'router_ip.unique'         => 'Another Router is already using this IP Address. You might want to use another one.',
                'ip_range.required'         => 'What is the DHCP pool for this router?',
            ]
        );

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $wifi->wifi = $request->input('wifi');
        $wifi->location = $request->input('location');
        $wifi->password = $request->input('password');
        $wifi->username = $request->input('username');
        $wifi->router_pwd = $request->input('router_pwd');
        $wifi->comments = $request->input('comments');
        $wifi->router_ip = $request->input('router_ip');
        $wifi->ip_range = $request->input('ip_range');

        $wifi->save();

        return redirect()->back()->with('success', $request->input('wifi').' has been updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Wifi  $wifi
     * @return \Illuminate\Http\Response
     */
    public function destroy(Wifi $wifi)
    {
        $wifi->delete();
        return redirect('wifis')->with('success', 'Wifi has been deleted');
    }
}
