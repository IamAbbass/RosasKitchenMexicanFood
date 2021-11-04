<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Carbon\Carbon;

use App\Models\User;
use App\Models\Customer;
use App\Models\Category;
use App\Models\Product;
use App\Models\Delivery;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Business;
use App\Models\Message;

class ApiController extends Controller
{
    function __construct(Request $request){
        //$this->middleware('auth:api');
        //$this->middleware('auth:api')->only(['index','store']);
        $this->middleware('auth:api')->except(['welcome','order_tracking','notify']);
    }

    // On Board (Create Token)
    public function welcome(Request $request)
    {
        if($request->device_token){
            $cusomter = Customer::where('business_id','=',$request->business_id)->where('device_token',$request->device_token)->count();
            if($cusomter == 0){
                $cusomter_new = Customer::create([
                    'business_id'   => $request->business_id,
                    'device_token'  => $request->device_token,
                    'brand'         => $request->brand,
                    'manufacturer'  => $request->manufacturer,
                    'android_id'    => $request->android_id,
                    'model'         => $request->model,
                    'os'            => $request->os
                ]);
                $user = User::create([
                    'business_id'   => $cusomter_new->business_id,
                    'customer_id'   => $cusomter_new->id,
                    'api_token'     => hash('sha256', Str::random(60)),
                ]);
                return [
                    'success'   => true,
                    'title'     => 'Welcome!',
                    'message'   => '',
                    'api_token' => $user->api_token,
                ];
            }
            else
            {
                $cusomter_exist = Customer::where('business_id','=',$request->business_id)->where('device_token',$request->device_token)->first();
                return [
                    'success'   => true,
                    'title'     => 'Welcome Back!',
                    'message'   => '',
                    'api_token' => $cusomter_exist->user->api_token,
                ];
            }
        }
        else
        {
            return [
                'success'   => false,
                'title'     => 'Invalid Device Token!',
                'message'   => 'Please try later ',
            ];
        }
    }

    // Authentication
    public function auth(Request $request)
    {
        $user = $request->user();
        $customer = $user->customer;

        $user->update([
            'name' => ucwords($request->name),
            'email' => strtolower($request->email),
        ]);

        if($request->phone){
            $customer->update([
                'phone' => $request->phone,
                // 'image' => $request->image,
                // 'uuid'  => $request->uuid,
                // 'is_verified' => true,
            ]);
        }

        return['success'   => true];
    }

    // Update FCM Token
    public function fcm(Request $request)
    {
        if($request->fcm_token){
            $customer = $request->user()->customer;
            $customer->update(['fcm_token' => $request->fcm_token,]);
            return ['success' => true];
        }
        else
        {
            return ['success' => false];
        }
    }

    // Fetch All Categories
    public function category(Request $request)
    {
        $result = [];
        $categories = Category::where('business_id','=',$request->business_id)->where('is_available',true)->orderBy('name', 'ASC')->get();
        foreach($categories as $key => $category) {
            $result[$key]['id']    = $category->id;
            $result[$key]['name']  = $category->name;
            $result[$key]['image'] = $category->image;
        }

        return $result;
    }

    // Fetch All Products
    public function product(Request $request)
    {
        $result = [];
        $products = Product::where('business_id','=',$request->business_id)->where('is_available',true)->orderBy('is_highlight', 'DESC')->get();
        foreach($products as $key => $product) {
            $result[$key]['id']            = $product->id;
            $result[$key]['sku']           = $product->sku;
            $result[$key]['badge']         = $product->badge == null ? null : $product->badge->name;
            $result[$key]['image']         = $product->image;
            $result[$key]['name']          = $product->name;
            $result[$key]['name_ur']       = $product->name_ur;
            $result[$key]['name_ru']       = $product->name_ru;
            $result[$key]['type']          = $product->type == null ? null : $product->type;
            $result[$key]['category_id']   = $product->category->id;
            $result[$key]['category']      = $product->category->name;
            $result[$key]['unit']          = $product->unit->name;
            $result[$key]['sale']          = $product->sale;
            $result[$key]['discount']      = $product->discount;
            $result[$key]['description']   = $product->description  == null ? null : $product->description;
            $result[$key]['dated']         = Carbon::parse(date("Y-m-d h:i:sa",$product->dated))->diffForHumans();
        }

        return $result;
    }

    // Fetch All Products By Category ID
    public function category_products(Request $request, $id)
    {
        $result = [];
        $category = Category::where('id',$id)->where('business_id','=',$request->business_id)->where('is_available',true)->first();
        $products = Product::where('business_id','=',$request->business_id)->where('category_id',$category->id)->where('is_available',true)->orderBy('is_highlight', 'DESC')->get();
        foreach($products as $key => $product) {
            $result[$key]['id']            = $product->id;
            $result[$key]['sku']           = $product->sku;
            $result[$key]['badge']         = $product->badge == null ? null : $product->badge->name;
            $result[$key]['image']         = $product->image;
            $result[$key]['name']          = $product->name;
            $result[$key]['name_ur']       = $product->name_ur;
            $result[$key]['name_ru']       = $product->name_ru;
            $result[$key]['type']          = $product->type == null ? null : $product->type;
            $result[$key]['category_id']   = $product->category->id;
            $result[$key]['category']      = $product->category->name;
            $result[$key]['unit']          = $product->unit->name;
            $result[$key]['sale']          = $product->sale;
            $result[$key]['discount']      = $product->discount;
            $result[$key]['description']   = $product->description  == null ? null : $product->description;
            $result[$key]['dated']         = Carbon::parse(date("Y-m-d h:i:sa",$product->dated))->diffForHumans();
        }

        return $result;
    }

    // Fetch Products By ID
    public function product_view(Request $request, $id)
    {
        $result = [];
        $products = Product::where('id',$id)->where('business_id','=',$request->business_id)->where('is_available',true)->get();
        foreach($products as $key => $product) {
            $result[$key]['id']            = $product->id;
            $result[$key]['sku']           = $product->sku;
            $result[$key]['badge']         = $product->badge == null ? null : $product->badge;
            $result[$key]['image']         = $product->image;
            $result[$key]['name']          = $product->name;
            $result[$key]['name_ur']       = $product->name_ur;
            $result[$key]['name_ru']       = $product->name_ru;
            $result[$key]['type']          = $product->type == null ? null : $product->type;
            $result[$key]['category_id']   = $product->category->id;
            $result[$key]['category']      = $product->category->name;
            $result[$key]['unit']          = $product->unit->name;
            $result[$key]['sale']          = $product->sale;
            $result[$key]['discount']      = $product->discount;
            $result[$key]['description']   = $product->description  == null ? null : $product->description;
            $result[$key]['dated']         = Carbon::parse(date("Y-m-d h:i:sa",$product->dated))->diffForHumans();
        }

        return $result;
    }

    // Fetch All Delivery
    public function delivery(Request $request)
    {
        $delivery = Delivery::where('business_id','=',$request->business_id)->where('is_available','=',true)->first();
        return $delivery;
    }

    // Order Timings
    public function order_timings(Request $request)
    {
        $user       = $request->user();
        $customer   = $user->customer;
        $H          = date("H.is",time());
        $D          = date("D",time());

        $business = Business::where('id','=',$request->business_id)->first();
        $location1 = str_replace(' ', '', explode(",",$business->location));
        $lat1 = $location1[0] == null ? 0 : $location1[0];
        $lon1 = $location1[1] == null ? 0 : $location1[1];

        $location2 = str_replace(' ', '', explode(",",$request->location));
        $lat2 = $location2[0] == null ? 0 : $location2[0];
        $lon2 = $location2[1] == null ? 0 : $location2[1];

        $delivery = Delivery::where('business_id','=',$request->business_id)->where('is_available','=',true)->first();
        $distance = Order::distance($lat1, $lon1, $lat2, $lon2, "K");
        if($business->is_available == false) {
            return [
                'distance' => number_format($distance,2)." Km",
                'is_available' => $business->is_available == null ? false : true,
                'note'  => $business->off_note,
                'expected_delivery' => "We'll resume taking orders soon",
                'min_order' => $business->min_order,
                'delivery_fee' => $delivery->amount,
                'free_delivery_after' => $delivery->free_delivery_after,
                // 'is_gift'  => $business->is_gift == null ? false : true,
                'is_gift' => $business->is_gift == 1 ? ($customer->orders->count() <= 0 ? true : false) : false,
            ];
        }

        // Same Day Delivery
        else {
            // 12:00 am - 10:30 am (Off Hours - Pending Orders For Today)
            if ($H > 0 && $H <= 10.30) {
                return [
                    'distance' => number_format($distance,2)." Km",
                    'is_available' => $business->is_available == null ? false : true,
                    'note'  => "Order placed after 7pm will be delivered next day after 11am",
                    'expected_delivery' => "Today, ".date("jS M,",time())." after 11am",
                    'min_order' => $business->min_order,
                    'delivery_fee' => $delivery->amount,
                    'free_delivery_after' => $delivery->free_delivery_after,
                    // 'is_gift'  => $business->is_gift == null ? false : true,
                    'is_gift' => $business->is_gift == 1 ? ($customer->orders->count() <= 0 ? true : false) : false,
                ];
            }
            // 10:30 am - 7:00 pm (Working Hours)
            // You will receive your order approx 30-45 mins
            if ($H > 10.30 && $H <= 19.00) {
                // Friday Break: 12:45 PM to 02:30 PM
                if ($D == "Fri" && $H > 12.45 && $H <= 14.30) {
                    return [
                        'distance' => number_format($distance,2)." Km",
                        'is_available' => $business->is_available == null ? false : true,
                        'note'  => "Friday break 12:45 PM - 02:30 PM",
                        'expected_delivery' => "Order will be delivered after friday prayer",
                        'min_order' => $business->min_order,
                        'delivery_fee' => $delivery->amount,
                        'free_delivery_after' => $delivery->free_delivery_after,
                        // 'is_gift'  => $business->is_gift == null ? false : true,
                        'is_gift' => $business->is_gift == 1 ? ($customer->orders->count() <= 0 ? true : false) : false,
                    ];
                }
                else {
                  return [
                      'distance' => number_format($distance,2)." Km",
                      'is_available' => $business->is_available == null ? false : true,
                      'note'  => "Fast delivery in your area",
                      'expected_delivery' => "30-45 mins",
                      'min_order' => $business->min_order,
                      'delivery_fee' => $delivery->amount,
                      'free_delivery_after' => $delivery->free_delivery_after,
                      // 'is_gift'  => $business->is_gift == null ? false : true,
                      'is_gift' => $business->is_gift == 1 ? ($customer->orders->count() <= 0 ? true : false) : false,
                  ];
                }
                // // Except Friday
                // if ($D != "Fri" && $H > 10.30 && $H <= 19.00) {
                //     return [
                //         'distance' => number_format($distance,2)." Km",
                //         'is_available' => $business->is_available == null ? false : true,
                //         'note'  => "Fast delivery in your area",
                //         'expected_delivery' => "30-45 mins",
                //         'min_order' => $business->min_order,
                //         'delivery_fee' => $delivery->amount,
                //         'free_delivery_after' => $delivery->free_delivery_after,
                //         // 'is_gift'  => $business->is_gift == null ? false : true,
                //         'is_gift' => $business->is_gift == 1 ? ($customer->orders->count() <= 0 ? true : false) : false,
                //     ];
                // }
            }
            // 7:00 pm - 11:59 pm (Off Hours - Pending Orders For Tomorrow)
            if ($H > 19.00 && $H <= 23.5959){
                return [
                    'distance' => number_format($distance,2)." Km",
                    'is_available' => $business->is_available == null ? false : true,
                    'note'  => "Order placed after 7pm will be delivered next day after 11am",
                    'expected_delivery' => "Tomorrow, ".date("jS M,", strtotime("+1 day", time()))." after 11am",
                    'min_order' => $business->min_order,
                    'delivery_fee' => $delivery->amount,
                    'free_delivery_after' => $delivery->free_delivery_after,
                    // 'is_gift'  => $business->is_gift == null ? false : true,
                    'is_gift' => $business->is_gift == 1 ? ($customer->orders->count() <= 0 ? true : false) : false,
                ];
            }
        }

        // Next Day Delivery
        // else {
        //   return [
        //       'distance' => number_format($distance,2)." Km",
        //       'is_available' => $business->is_available == null ? false : true,
        //       'note'  => "Delivery in Gulistan-e-Johar only",
        //       'expected_delivery' => "Tomorrow, ".date("jS M Y", strtotime("+1 day", time())),
        //       'min_order' => $business->min_order,
        //       'delivery_fee' => $delivery->amount,
        //       'free_delivery_after' => $delivery->free_delivery_after,
        //       'is_gift'  => $business->is_gift == null ? false : true,
        //   ];
        // }
    }

    // Place An Order
    public function order(Request $request)
    {
        $sms        = false;
        $email      = false;
        $user       = $request->user();
        $customer   = $user->customer;

        $business = Business::where('id','=',$request->business_id)->first();
        $location1 = str_replace(' ', '', explode(",",$business->location));
        $lat1 = $location1[0] == null ? 0 : $location1[0];
        $lon1 = $location1[1] == null ? 0 : $location1[1];

        $location2 = str_replace(' ', '', explode(",",$request->location));
        $lat2 = $location2[0] == null ? 0 : $location2[0];
        $lon2 = $location2[1] == null ? 0 : $location2[1];
        $acc2 = $location2[2] == null ? 0 : $location2[2];

        $distance = Order::distance($lat1, $lon1, $lat2, $lon2, "K");
        $delivery = Delivery::where('business_id','=',$request->business_id)->where('is_available','=',true)->first();

        $user->update([
            'name'        => ucwords($request->name),
            'phone'       => $request->phone,
            'email'       => strtolower($request->email),
            'address'     => ucwords($request->address),
            'is_verified' => true,
        ]);

        $order = Order::create([
            'business_id'     => $request->business_id,
            'customer_id'     => $customer->id,
            'order_no'        => strtoupper("RKMF-".substr(md5(uniqid().mt_rand().time()), 9, 9)),
            'name'            => ucwords($request->name),
            'phone'           => $request->phone,
            'email'           => strtolower($request->email),
            'address'         => ucwords($request->address),
            'location'        => $lat2.", ".$lon2,
            'delivery_id'     => $delivery->id,
            'coupon'          => $request->coupon,
            'payment_method'  => $request->payment_method, // Default COD
            'is_gift'         => $business->is_gift == 1 ? ($customer->orders->count() <= 0 ? true : false) : false,
            'note'            => $request->note,
            'dated'           => time(),
            'order_status_id' => 1,
            'record_by'       => 0,
        ]);

        $products_arr = explode(",",$request->products);
        $qty_arr      = explode(",",$request->qty);

        $grand_total = 0;

        foreach($products_arr as $index => $product){
            $product_db         = Product::where('id',$product)->where('business_id','=',$request->business_id)->first(['sale','unit_id','discount','purchase']);

            $purchase           = $product_db->purchase;
            $sale               = $product_db->sale;
            $unit               = $product_db->unit->name;
            $discount           = $product_db->discount;
            $quantity           = $qty_arr[$index];
            // $discouned_price    = $sale-$discount;
            $total              = $sale*$quantity;
            $grand_total        += $total;

            OrderDetail::create([
                'order_id'      => $order->id,
                'product_id'    => $product,
                'purchase'      => $purchase,
                'sale'          => $sale,
                'quantity'      => $quantity,
                'unit'          => $unit,
                'discount'      => $discount*$quantity,
                'total'         => $total,
            ]);
        }

        // Apply Logic (Delivery Free After)
        if($delivery){
            $grand_total += $delivery->amount;
        }


        //################################ Send SMS ################################
        // Order Confirmed
        if(config('app.sabzify_sms',false) == true && $order->status_message->status == "Confirmed") {
            // Preparing Message & Send SMS
            $messages = Message::where('business_id','=',$order->business_id)->where('type','=',"SMS")->where('status','=',"Confirmed")->first();
            $message  = str_replace("ORDER_NO",$order->order_no,$messages->message);
            $message  = str_replace("SABZIFY_SUPPORT",$order->business->email,$message);
            $message  = str_replace("SABZIFY_PHONE",$order->business->phone,$message);

            $sender = "SABZIFY";
            $post = "sender=".urlencode($sender)."&mobile=".urlencode($order->phone)."&message=".urlencode($message)."";
            $url = "https://sendpk.com/api/sms.php?api_key=".config('app.sms_api_key',false);
            $ch = curl_init();
            $timeout = 30; // set to zero for no timeout
            curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; SV1)');
            curl_setopt($ch, CURLOPT_URL,$url);
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS,$post);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
            $sms = curl_exec($ch);
        }

        //################################ Send Email ################################
        // Order Confirmed
        if(config('app.sabzify_email',false) == true && $order->status_message->status == "Confirmed") {
            $bcc = "info@sabzify.pk";
            \Mail::to($order->email)->bcc($bcc)->send(new \App\Mail\OrderConfirmed($order));
            $email = true;
        }

        // Preparing Message
        $messages = Message::where('business_id','=',$order->business_id)->where('type','=',"Notification")->where('status','=',"Confirmed")->first();
        $message  = str_replace("ORDER_NO",$order->order_no,$messages->message);
        $message  = str_replace("SABZIFY_SUPPORT",$order->business->email,$message);
        $message  = str_replace("SABZIFY_PHONE",$order->business->phone,$message);

        //################################ Admin Notification ################################
        // Order Confirmed
        if (config('app.sabzify_notification',false) == true) {
            Order::AdminPushNotification($order->status_message->title,$message);
        }

        return [
            'success'   => true,
            'distance'  => number_format($distance,2)." Km",
            'title'     => $order->status_message->title,
            'msg'       => $message,
            'sms'       => $sms,
            'email'     => $email,
        ];
    }

    // Fetch All Orders
    public function myorders(Request $request)
    {
        $data_to_display = [];
        $user       = $request->user();
        $customer   = $user->customer;
        // $orders  = $customer->orders;
        $orders     = Order::where('customer_id',$customer->id)->where('business_id','=',$request->business_id)->orderBy('id', 'DESC')->get();

        foreach($orders as $key => $order){
            $message  = str_replace("ORDER_NO",$order->order_no,$order->status_message->message);
            $message  = str_replace("SABZIFY_SUPPORT",$order->business->email,$message);
            $message  = str_replace("SABZIFY_PHONE",$order->business->phone,$message);

            // Is Delivery Charges Logic!
            $delivery = Delivery::where('id','=',$order->delivery_id)->where('business_id','=',$order->business_id)->first();
            if($order->details->sum('total') >= $delivery->free_delivery_after) {
                $order_amount = $order->details->sum('total') - ($order->payment_status == "Unpaid" ?  $order->customer->user->wallet : $order->wallet_debit);
            }
            else {
                $order_amount = ($order->details->sum('total') >= $delivery->free_delivery_after ?  $order->details->sum('total') + 0 : $order->details->sum('total') + $delivery->amount) - ($order->payment_status == "Unpaid" ?  $order->customer->user->wallet : $order->wallet_debit);
            }

            $message  = str_replace("ORDER_AMOUNT",round($order_amount),$message);
            $message  = str_replace("PAYMENT_METHOD",$order->payment_method,$message);

            $data_to_display[$key]['order_no']          = $order->order_no;
            $data_to_display[$key]['order_status']      = $order->status_message->status;
            $data_to_display[$key]['order_message']     = $message;
            $data_to_display[$key]['payment_status']    = $order->payment_status;
            $data_to_display[$key]['rider_name']        = $order->rider == null ?  "Not Assigned" : $order->rider->name;
            $data_to_display[$key]['rider_phone']       = $order->rider == null ?  "Not Assigned" : $order->rider->phone;
            $data_to_display[$key]['note']              = $order->note;

            $data_to_display[$key]['coupon']            = $order->coupon;
            $data_to_display[$key]['payment_method']    = $order->payment_method;
            $data_to_display[$key]['discount']       = $order->details->sum('discount');
            $data_to_display[$key]['gross_amount']   = $order->details->sum('total');
            $data_to_display[$key]['delivery']       = $order->details->sum('total') >= $delivery->free_delivery_after ?  0 : $delivery->amount;
            $data_to_display[$key]['wallet_debit']   = $order->payment_status == "Unpaid" ?  $order->customer->user->wallet : $order->wallet_debit;
            $data_to_display[$key]['total']          = $order->details->sum('total') >= $delivery->free_delivery_after ?  $order->details->sum('total') - ($order->payment_status == "Unpaid" ?  $order->customer->user->wallet : $order->wallet_debit) : $order->details->sum('total') + $delivery->amount - ($order->payment_status == "Unpaid" ?  $order->customer->user->wallet : $order->wallet_debit);
            $data_to_display[$key]['date']           = date("D jS \\of M Y h:i:s A",$order->dated);
        }

        return $data_to_display;
    }

    // Order Details
    public function myorders_details(Request $request)
    {
      $order_arr   = [];
      $details_arr = [];
      $user        = $request->user();
      $customer    = $user->customer;
    //   return $request->business_id;

      $order_row  = Order::where('business_id','=',$request->business_id)->where('customer_id',$customer->id)->where('order_no',$request->order_no)->first();

      if($order_row){
        $details     = $order_row->details;
        foreach($details as $key => $detail){
            $details_arr[$key]['product']   = $detail->product->only(['id','sku','image','name','name_ur','name_ru']);
            $details_arr[$key]['sale']      = $detail->sale;
            $details_arr[$key]['quantity']  = $detail->quantity;
            $details_arr[$key]['unit']      = $detail->unit;
            $details_arr[$key]['discount']  = $detail->discount;
            $details_arr[$key]['total']     = $detail->total;
        }

        $message  = str_replace("ORDER_NO",$order_row->order_no,$order_row->status_message->message);
        $message  = str_replace("SABZIFY_SUPPORT",$order_row->business->email,$message);
        $message  = str_replace("SABZIFY_PHONE",$order_row->business->phone,$message);

        // Is Delivery Charges Logic!
        $delivery = Delivery::where('id','=',$order_row->delivery_id)->where('business_id','=',$order_row->business_id)->first();
        if($order_row->details->sum('total') >= $delivery->free_delivery_after) {
            $order_amount = $order_row->details->sum('total') - ($order_row->payment_status == "Unpaid" ?  $order_row->customer->user->wallet : $order_row->wallet_debit);
        }
        else {
            $order_amount = ($order_row->details->sum('total') >= $delivery->free_delivery_after ?  $order_row->details->sum('total') + 0 : $order_row->details->sum('total') + $delivery->amount) - ($order_row->payment_status == "Unpaid" ?  $order_row->customer->user->wallet : $order_row->wallet_debit);
        }

        $message  = str_replace("ORDER_AMOUNT",round($order_amount),$message);
        $message  = str_replace("PAYMENT_METHOD",$order_row->payment_method,$message);

        $order_arr['order_no']       = $order_row->order_no;
        $order_arr['order_status']   = $order_row->status_message->status;
        $order_arr['order_message']  = $message;
        $order_arr['payment_status'] = $order_row->payment_status;
        $order_arr['rider_name']     = $order_row->rider == null ?  "Not Assigned" : $order_row->rider->name;
        $order_arr['rider_phone']    = $order_row->rider == null ?  "Not Assigned" : $order_row->rider->phone;
        $order_arr['note']           = $order_row->note;

        $order_arr['coupon']         = $order_row->coupon;
        $order_arr['payment_method'] = $order_row->payment_method;
        $order_arr['discount']       = $order_row->details->sum('discount');
        $order_arr['gross_amount']   = $order_row->details->sum('total');
        $order_arr['delivery']       = $order_row->details->sum('total') >= $delivery->free_delivery_after ?  0 : $delivery->amount;
        $order_arr['wallet_debit']   = $order_row->payment_status == "Unpaid" ?  $order_row->customer->user->wallet : $order_row->wallet_debit;
        $order_arr['total']          = $order_row->details->sum('total') >= $delivery->free_delivery_after ?  $order_row->details->sum('total') - ($order_row->payment_status == "Unpaid" ?  $order_row->customer->user->wallet : $order_row->wallet_debit) : $order_row->details->sum('total') + $delivery->amount - ($order_row->payment_status == "Unpaid" ?  $order_row->customer->user->wallet : $order_row->wallet_debit);
        $order_arr['date']           = date("D jS \\of M Y h:i:s A",$order_row->dated);

        return [
            'success'   => true,
            'message'   => "Valid Order ".$request->order_no,
            'order'     => $order_arr,
            'details'   => $details_arr,
            'delivery'  => $delivery->amount,
        ];
      }
      else {
        return [
            'success'   => false,
            'message'   => "Invalid Order ".$request->order_no,
            'order'     => $order_arr,
            'details'   => $details_arr,
            'delivery'  => null,
        ];
      }
    }

    // Order Tracking
    public function order_tracking(Request $request)
    {
        $order_arr   = [];
        $details_arr = [];
        $order_row   = Order::where('business_id','=',$request->business_id)->where('order_no',$request->order_no)->first();

        if($order_row){
          $details     = $order_row->details;
          foreach($details as $key => $detail){
              $details_arr[$key]['product']   = $detail->product->only(['id','sku','image','name','name_ur','name_ru']);
              $details_arr[$key]['sale']      = $detail->sale;
              $details_arr[$key]['quantity']  = $detail->quantity;
              $details_arr[$key]['unit']      = $detail->unit;
              $details_arr[$key]['discount']  = $detail->discount;
              $details_arr[$key]['total']     = $detail->total;
            }

            $message  = str_replace("ORDER_NO",$order_row->order_no,$order_row->status_message->message);
            $message  = str_replace("SABZIFY_SUPPORT",$order_row->business->email,$message);
            $message  = str_replace("SABZIFY_PHONE",$order_row->business->phone,$message);

            // Is Delivery Charges Logic!
            $delivery = Delivery::where('id','=',$order_row->delivery_id)->where('business_id','=',$order_row->business_id)->first();
            if($order_row->details->sum('total') >= $delivery->free_delivery_after) {
                $order_amount = $order_row->details->sum('total') - ($order_row->payment_status == "Unpaid" ?  $order_row->customer->user->wallet : $order_row->wallet_debit);
            }
            else {
                $order_amount = ($order_row->details->sum('total') >= $delivery->free_delivery_after ?  $order_row->details->sum('total') + 0 : $order_row->details->sum('total') + $delivery->amount) - ($order_row->payment_status == "Unpaid" ?  $order_row->customer->user->wallet : $order_row->wallet_debit);
            }

            $message  = str_replace("ORDER_AMOUNT",round($order_amount),$message);
            $message  = str_replace("PAYMENT_METHOD",$order_row->payment_method,$message);

            $order_arr['order_no']       = $order_row->order_no;
            $order_arr['order_status']   = $order_row->status_message->status;
            $order_arr['order_message']  = $message;
            $order_arr['payment_status'] = $order_row->payment_status;
            $order_arr['rider_name']     = $order_row->rider == null ?  "Not Assigned" : $order_row->rider->name;
            $order_arr['rider_phone']    = $order_row->rider == null ?  "Not Assigned" : $order_row->rider->phone;
            $order_arr['note']           = $order_row->note;

            $order_arr['coupon']         = $order_row->coupon;
            $order_arr['payment_method'] = $order_row->payment_method;
            $order_arr['discount']       = $order_row->details->sum('discount');
            $order_arr['gross_amount']   = $order_row->details->sum('total');
            $order_arr['delivery']       = $order_row->details->sum('total') >= $delivery->free_delivery_after ?  0 : $delivery->amount;
            $order_arr['wallet_debit']   = $order_row->payment_status == "Unpaid" ?  $order_row->customer->user->wallet : $order_row->wallet_debit;
            $order_arr['total']          = $order_row->details->sum('total') >= $delivery->free_delivery_after ?  $order_row->details->sum('total') - ($order_row->payment_status == "Unpaid" ?  $order_row->customer->user->wallet : $order_row->wallet_debit) : $order_row->details->sum('total') + $delivery->amount - ($order_row->payment_status == "Unpaid" ?  $order_row->customer->user->wallet : $order_row->wallet_debit);
            $order_arr['date']           = date("D jS \\of M Y h:i:s A",$order_row->dated);

            return [
                'success'   => true,
                'message'   => "Valid Order ".$order_row->order_no,
                'order'     => $order_arr,
                'details'   => $details_arr,
                'delivery'  => $delivery->amount,
            ];
        }
        else {
            return [
                'success'   => false,
                'message'   => "Invalid Order ".$request->order_no,
                'order'     => $order_arr,
                'details'   => $details_arr,
                'delivery'  => [],
            ];
        }
    }

    // User Profile
    public function profile(Request $request)
    {
        $user = User::where('business_id','=',$request->business_id)->where('api_token',$request->api_token)->first();
        if($user){
            return [
                'image'       => $user->image,
                'name'        => $user->name,
                'phone'       => $user->phone,
                'email'       => $user->email,
                'address'     => $user->address,
                'wallet'      => strval($user->wallet),
                'is_verified' => $user->is_verified == 1 ? true : false,
            ];
        }
        else {
            return [
                'error'       => "User not found!",
            ];
        }
    }

    // User Profile Update
    public function profile_update(Request $request)
    {
        $user = User::where('business_id','=',$request->business_id)->where('api_token',$request->api_token)->first();
        if($user){
            if ($request->name) {
                $user->update([
                    // 'image'    => $request->image,
                    'name'        => ucwords($request->name),
                ]);
            }
            if ($request->phone) {
                if (strlen($user->phone) <= 0) {
                    $user->update([
                        'wallet'  => $user->wallet + 30,
                    ]);

                    if (config('app.sabzify_notification',false) == true) {
                        $title   = "Sabzify Wallet";
                        $message = "Dear customer, PKR 30.00 added in your wallet.";

                        // Push Notification Admin
                        Order::AdminPushNotification($title,$message);
                        // Push Notification Customer
                        Order::CustomerPushNotification($user->customer->fcm_token,$title,$message);
                    }
                }
                $user->update([
                    'phone'       => $request->phone,
                ]);
            }
            if ($request->email) {
                $user->update([
                    'email'       => strtolower($request->email),
                ]);
            }
            if ($request->address) {
                $user->update([
                    'address'     => ucwords($request->address),
                ]);
            }

            return [
                'id'          => $user->id,
                'image'       => $user->image,
                'name'        => $user->name,
                'phone'       => $user->phone,
                'email'       => $user->email,
                'address'     => $user->address,
                'wallet'      => strval($user->wallet),
                'is_verified' => $user->is_verified,
            ];
        }
        else {
            return [
                'error'       => "User not found!",
            ];
        }
    }

}
