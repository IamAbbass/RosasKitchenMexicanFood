<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function business() {
        return $this->hasOne('\App\Models\Business','id','business_id');
    }

    public function user(){
        return $this->hasOne('\App\Models\User','id','record_by');
    }

    public function customer(){
        return $this->hasOne('\App\Models\Customer','id','customer_id');
    }

    public function details(){
        return $this->hasMany('\App\Models\OrderDetail','order_id','id');
    }
    
    public function product(){
        return $this->hasOne('\App\Models\Product','id','product_id');
    }

    public function status_message(){
        return $this->hasOne('\App\Models\Message','id','order_status_id');
    }

    public function delivery(){
        return $this->hasOne('\App\Models\Delivery','id','delivery_id');
    }

    public function rider(){
        return $this->hasOne('\App\Models\Rider','id','rider_id');
    }


    /*::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::*/
    /*::                                                                         :*/
    /*::  This routine calculates the distance between two points (given the     :*/
    /*::  latitude/longitude of those points). It is being used to calculate     :*/
    /*::  the distance between two locations using GeoDataSource(TM) Products    :*/
    /*::                                                                         :*/
    /*::  Definitions:                                                           :*/
    /*::    South latitudes are negative, east longitudes are positive           :*/
    /*::                                                                         :*/
    /*::  Passed to function:                                                    :*/
    /*::    lat1, lon1 = Latitude and Longitude of point 1 (in decimal degrees)  :*/
    /*::    lat2, lon2 = Latitude and Longitude of point 2 (in decimal degrees)  :*/
    /*::    unit = the unit you desire for results                               :*/
    /*::           where: 'M' is statute miles (default)                         :*/
    /*::                  'K' is kilometers                                      :*/
    /*::                  'N' is nautical miles                                  :*/
    /*::  Worldwide cities and other features databases with latitude longitude  :*/
    /*::  are available at https://www.geodatasource.com                          :*/
    /*::                                                                         :*/
    /*::  For enquiries, please contact sales@geodatasource.com                  :*/
    /*::                                                                         :*/
    /*::  Official Web site: https://www.geodatasource.com                        :*/
    /*::                                                                         :*/
    /*::         GeoDataSource.com (C) All Rights Reserved 2018                  :*/
    /*::                                                                         :*/
    /*::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::*/

    // Latitude: 24.9158484, Longitude: 67.125173, Accuracy: 99.9
    // https://www.codegrepper.com/code-examples/php/laravel+calculate+distance+between+two+coordinates
    
    public static function distance($lat1, $lon1, $lat2, $lon2, $unit) {
        if (($lat1 == $lat2) && ($lon1 == $lon2)) {
            return 0;
        }
        else {
            $theta = $lon1 - $lon2;
            $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
            $dist = acos($dist);
            $dist = rad2deg($dist);
            $miles = $dist * 60 * 1.1515;
            $unit = strtoupper($unit);

            if ($unit == "K") {
                return ($miles * 1.609344);
            } else if ($unit == "N") {
                return ($miles * 0.8684);
            } else {
                return $miles;
            }
        }
        // echo distance(32.9697, -96.80322, 29.46786, -98.53506, "M") . " Miles<br>";
        // echo distance(32.9697, -96.80322, 29.46786, -98.53506, "K") . " Kilometers<br>";
        // echo distance(32.9697, -96.80322, 29.46786, -98.53506, "N") . " Nautical Miles<br>";
    }

    //Admin Notification
    public static function AdminPushNotification($title,$body) {
        // CID 141  => Abbass, CID 259  => Zuhair
        $customers = Customer::whereIn('id',[141,259])->get();
        foreach($customers as $index => $customer) {
            $data = array(
                "to" => $customer->fcm_token,
                "notification" => array(
                    'title' => 'Sabazify Alert - '.$title,
                    'body' => $body,
                    'color' => '#604266',
                    'icon' => asset('assets/attachment/business/'.$customer->business->fcm_icon),
                    'image' => asset('assets/attachment/business/'.$customer->business->fcm_image),
                    'click_action' => $customer->business->website,
                ));
                $data_string = json_encode($data);
                //return "The Json Data : ".$data_string;
                $headers = array ( 'Authorization: key='.config('app.firebase_server_key',false), 'Content-Type: application/json' );
                $ch = curl_init(); curl_setopt( $ch,CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send' );

                curl_setopt( $ch,CURLOPT_POST, true );
                curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
                curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
                curl_setopt( $ch,CURLOPT_POSTFIELDS, $data_string);
                $notification = curl_exec($ch);
                curl_close ($ch);
                // return $notification;
        }
    }


    //Customer Push Notification
    public static function CustomerPushNotification($fcm_token,$title,$body) {
        $customer = Customer::where('fcm_token',$fcm_token)->first();
        $data = array(
            "to" => $fcm_token,
            "notification" => array(
            'title' => $title,
            'body' => $body,
            'color' => '#99e265',
            'icon' => asset('assets/attachment/business/'.$customer->business->fcm_icon),
            'image' => asset('assets/attachment/business/'.$customer->business->fcm_image),
            'click_action' => $customer->business->website,
            ));
            $data_string = json_encode($data);
            //return "The Json Data : ".$data_string;
            $headers = array ( 'Authorization: key='.config('app.firebase_server_key',false), 'Content-Type: application/json' );
            $ch = curl_init(); curl_setopt( $ch,CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send' );

            curl_setopt( $ch,CURLOPT_POST, true );
            curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
            curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
            curl_setopt( $ch,CURLOPT_POSTFIELDS, $data_string);
            $notification = curl_exec($ch);
            curl_close ($ch);
            // return $notification;
    }
}
