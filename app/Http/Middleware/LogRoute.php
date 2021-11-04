<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Activity;
use Illuminate\Http\Request;

class LogRoute
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $response     = $next($request);
        $request_body = json_encode($request->all());
        $json         = json_decode($request_body,true);

        if(config('app.ROZA_log',false) == true) {
            if(array_key_exists('location', $json)) {
                $location = str_replace(' ', '', explode(",",$json['location']));
                $lat = $location[0] == null ? 0 : $location[0];
                $lon = $location[1] == null ? 0 : $location[1];
                $acc = $location[2] == null ? 0 : $location[2];
            }
            else {
                $lat = "0";
                $lon = "0";
                $acc = "0";
            }
    
            $activity = Activity::create([
                'business_id'   => $request->business_id == null ? 0 : $request->business_id,
                'api_token'     => $request->api_token == null ? 0 : $request->api_token,
                'uri'           => $request->getUri(),
                'method'        => $request->getMethod(),
                'request_body'  => $request_body,
                // 'response'   => $response->getContent(),
                'lat'           => $lat,
                'lon'           => $lon,
                'acc'           => $acc,
            ]);
        }
        
        // return $activity;
        return $response;
    }
}
