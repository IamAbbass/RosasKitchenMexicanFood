<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Carbon\Carbon;

class ReportController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function profit_loss()
    {
        return view('reports.profit_loss');
    }
    
    public function active_users()
    {
        if (Gate::allows('isShow')) {
            $location = explode(",",auth()->user()->business->location);
            $lat = $location[0];
            $lon = $location[1];

            $users = User::get();
            $map_data = array();
            foreach($users as $index => $user){
                $last_activity = json_decode($user->last_activity,true);
                if($last_activity != null && $last_activity['lat'] != 0 && $last_activity['lon'] != 0){

                    if($user->orders->count() > 0){
                        $map_data[$index]['total_orders'] = $user->orders->count();
                        $map_data[$index]['name'] = $user->last_order->name;
                        $map_data[$index]['phone'] = $user->last_order->phone;
                        $map_data[$index]['address'] = $user->last_order->address;                    
                    }else{
                        $map_data[$index]['total_orders'] = 0;
                        $map_data[$index]['name'] = $user->customer ? $user->customer->name : '';
                        $map_data[$index]['phone'] = $user->customer ? $user->customer->phone : '';
                        $map_data[$index]['address'] = $user->customer ? $user->customer->address : '';                     
                    }

                    
                    $map_data[$index]['lat'] = $last_activity['lat'];     
                    $map_data[$index]['lon'] = $last_activity['lon'];
                    $map_data[$index]['last_access'] = Carbon::now()->diffInHours(Carbon::parse($last_activity['created_at']));
                    $map_data[$index]['date_time'] = Carbon::parse($last_activity['created_at'])->toDateTimeString();
                    
                    // $day = $today->subDays(1)->format('d/m/Y');

                    $map_data[$index]['api_count'] = $user->activity->count();     

                }

                
            }
            // return $map_data;
            return view('reports.active_users', compact('map_data','lat','lon'));
        }
        else {
            session()->flash('error','This action is unauthorized.');
            return redirect()->back();
        }
    }


    
}
