<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Device;
use Illuminate\Support\Facades\Auth;
use App\Http\Libs\Rules;

class DeviceController extends Controller
{
    private $rules;

    function __construct() {
        $this->rules = new Rules();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function devices()
    {
        if(Auth::check()) {
            $devices = Device::where('user_id', Auth::user()->id)->get();
            return response()->json($devices);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate($this->rules->deviceCreateRule());

        $device = new Device();
        $device->fill($request->all());
        $device->user_id = Auth::user()->id;
        $device->save();

        return response()->json($device);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $device
     * @return \Illuminate\Http\Response
     */
    public function show(Device $device)
    {
        return response()->json($device);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $device
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Device $device)
    {
        $request->validate($this->rules->deviceUpdateRule());

        $device->fill($request->all());
        $device->save();

        return response()->json($device);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $device
     * @return \Illuminate\Http\Response
     */
    public function destroy(Device $device)
    {
        $device->delete();
        return response()->json($device);
    }
}
