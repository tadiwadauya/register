<?php

namespace App\Http\Controllers;

use App\Models\Asset;
use App\Models\Brand;
use App\Models\Printer;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class PrinterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $printers = Printer::all();
        return view('printers.printers', compact('printers'));
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

        return view('printers.add-printer', compact('users', 'brands', 'latestId'));
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
                'model.required'         => 'What is the printer model?',
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
            'type' => 'Printer',
            'assettag' => $request->input('assettag'),
            'serial' => $request->input('serial'),
            'age' => 0.0,
            'purchased' => $request->input('purchased'),
            'notes' => $request->input('notes'),
            'warranty' => $request->input('warranty'),
        ]);
        $asset->save();

        if($asset->save()) {
            $printer = Printer::create([
                'assettag' => $request->input('assettag'),
                'type' => $request->input('type'),
                'brand' => $request->input('brand'),
                'model' => $request->input('model'),
            ]);

            $printer->save();
        }

        return redirect('printers')->with('success', 'Successfully added the '.$request->input('brand'). ' printer.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Printer  $printer
     * @return \Illuminate\Http\Response
     */
    public function show(Printer $printer)
    {
        $asset = \App\Models\Asset::all()->where('assettag', $printer->assettag)->first();
        $yuser = \App\Models\User::all()->where('paynumber', $asset->username )->first();

        return view('printers.printer-info', compact('printer', 'asset', 'yuser'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Printer  $printer
     * @return \Illuminate\Http\Response
     */
    public function edit(Printer $printer)
    {
        $users = User::all();
        $brands = Brand::all();
        $asset = \App\Models\Asset::all()->where('assettag', $printer->assettag)->first();
        $yuser = \App\Models\User::all()->where('paynumber', $asset->username )->first();

        return view('printers.edit-printer', compact('printer', 'users','brands', 'asset', 'yuser'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Printer  $printer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Printer $printer)
    {
        $asset = \App\Models\Asset::all()->where('assettag', $printer->assettag)->first();

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
            $printer->type =  $request->input('type');
            $printer->brand =  $request->input('brand');
            $printer->model =  $request->input('model');

            $printer->save();
        }

        return redirect()->back()->with('success', 'Printer '.$asset->assettag.' has been updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Printer  $printer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Printer $printer)
    {
        DB::table("assets")->where("assettag", $printer->assettag)->update(['deleted_at'=>now()]);
        DB::table("printers")->where("assettag", $printer->assettag)->update(['deleted_at'=>now()]);

        return redirect('printers')->with('success', $printer->assettag.' has been deleted successfully.');
    }
}
