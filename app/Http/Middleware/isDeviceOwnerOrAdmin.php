<?php

namespace App\Http\Middleware;

use Closure;
use App\Device;

class isDeviceOwnerOrAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        //return response()->json($request->route('device'));
        //$user_id = Device::findOrFail($request->route('id'))->user_id;
        if($request->user()->isAdmin || $request->user()->id === $request->route('device')->user_id) return $next($request);

        return response()->json(['Error' => 'Unauthorized']);
    }
}
