<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DeviceType;
use App\Http\Libs\Rules;

class DeviceTypeController extends Controller
{
    private $rules;

    function __construct() {
        $this->middleware('isAdmin')->except('deviceTypes', 'show');
        $this->rules = new Rules();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function deviceTypes()
    {
        return response()->json(DeviceType::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate($this->rules->deviceTypeCreateRule());

        $deviceType = new DeviceType();
        $deviceType->fill($request->all());
        $deviceType->save();

        return response()->json($deviceType);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(DeviceType $deviceType)
    {
        return response()->json($deviceType);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DeviceType $deviceType)
    {
        $request->validate($this->rules->deviceTypeCreateRule());

        $deviceType->fill($request->all());
        $deviceType->save();
        
        return response()->json($deviceType);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(DeviceType $deviceType)
    {
        $deviceType->delete();

        return response()->json($deviceType);
    }
}
