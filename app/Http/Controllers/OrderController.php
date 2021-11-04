<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Message;
use App\Models\Delivery;
use App\Models\Rider;
use App\Models\Unit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // return Order::distance(32.9697, -96.80322, 29.46786, -98.53506, "K");
        if (Gate::allows('isIndex')) {
            $filter   = "All";
            $orders   = Order::where('business_id','=',auth()->user()->business_id)->orderBy('id', 'DESC')->get();
            $messages = Message::where('business_id','=',auth()->user()->business_id)->where('type','=',"Notification")->get();
            $riders   = Rider::where('business_id','=',auth()->user()->business_id)->where('is_available','=',true)->get();
            // passing data into view
            return view('orders.index', compact('orders','messages','riders','filter'));
        }
        else {
            session()->flash('error','This action is unauthorized.');
            return redirect()->back();
        }
    }

    public function filter($id)
    {
        if (Gate::allows('isIndex')) {
            if($id == 1) {
                $filter = "Confirmed";
                $orders = Order::where('business_id','=',auth()->user()->business_id)->where('order_status_id','=',1)->orderBy('id', 'DESC')->get();
                $messages = Message::where('business_id','=',auth()->user()->business_id)->where('type','=',"Notification")->get();
            }
            if($id == 2) {
                $filter = "Preparing";
                $orders = Order::where('business_id','=',auth()->user()->business_id)->where('order_status_id','=',2)->orderBy('id', 'DESC')->get();
                $messages = Message::where('business_id','=',auth()->user()->business_id)->where('type','=',"Notification")->get();
            }
            if($id == 3) {
                $filter = "Pick-Up";
                $orders = Order::where('business_id','=',auth()->user()->business_id)->where('order_status_id','=',3)->orderBy('id', 'DESC')->get();
                $messages = Message::where('business_id','=',auth()->user()->business_id)->where('type','=',"Notification")->get();
            }
            if($id == 4) {
                $filter = "Arrived";
                $orders = Order::where('business_id','=',auth()->user()->business_id)->where('order_status_id','=',4)->orderBy('id', 'DESC')->get();
                $messages = Message::where('business_id','=',auth()->user()->business_id)->where('type','=',"Notification")->get();
            }
            if($id == 5) {
                $filter = "Delivered";
                $orders = Order::where('business_id','=',auth()->user()->business_id)->where('order_status_id','=',5)->orderBy('id', 'DESC')->get();
                $messages = Message::where('business_id','=',auth()->user()->business_id)->where('type','=',"Notification")->get();
            }
            if($id == 6) {
                $filter = "Cancelled";
                $orders = Order::where('business_id','=',auth()->user()->business_id)->where('order_status_id','=',6)->orderBy('id', 'DESC')->get();
                $messages = Message::where('business_id','=',auth()->user()->business_id)->where('type','=',"Notification")->get();
            }

            $riders = Rider::where('business_id','=',auth()->user()->business_id)->where('is_available','=',true)->get();
            return view('orders.index', compact('orders','messages','riders','filter'));
        }
        else {
            session()->flash('error','This action is unauthorized.');
            return redirect()->back();
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (Gate::allows('isStore')) {
            return view('categories.store');
        }
        else {
            session()->flash('error','This action is unauthorized.');
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        // return $order->details->sum('total');
        if (Gate::allows('isShow')) {
            $messages = Message::where('business_id','=',auth()->user()->business_id)->where('type','=',"Notification")->get();
            $riders   = Rider::where('business_id','=',auth()->user()->business_id)->where('is_available','=',true)->get();
            return view('orders.show', compact('order','messages','riders'));
        }
        else {
            session()->flash('error','This action is unauthorized.');
            return redirect()->back();
        }
    }

    public function pay_bill($id)
    {
        if (Gate::allows('isShow')) {
            $order = Order::where('id','=',$id)->where('business_id','=',auth()->user()->business_id)->first();
            if ($order->status_message->status == "Delivered" && $order->payment_status == "Unpaid") {
                return view('orders.pay_bill', compact('order'));
            }
            else {
                session()->flash('warning','Order# '.$order->order_no.' is already paid or not delivered!');
                return redirect()->back();
            }
        }
        else {
            session()->flash('error','This action is unauthorized.');
            return redirect()->back();
        }
    }    

    public function location($id)
    {
        // return $order->details->sum('total');
        if (Gate::allows('isShow')) {
            $order = Order::where('business_id','=',auth()->user()->business_id)->where('id','=',$id)->get();
            $messages = Message::where('business_id','=',auth()->user()->business_id)->where('type','=',"Notification")->get();
            return view('orders.location', compact('order','messages'));
        }
        else {
            session()->flash('error','This action is unauthorized.');
            return redirect()->back();
        }
    }

    public function purchase()
    {
        // return $order->details->sum('total');
        if (Gate::allows('isShow')) {
            // For (Confirmed & Prepairing) Orders Only.
            $orders    = Order::where('business_id','=',auth()->user()->business_id)->whereIn('order_status_id',[1,2])->get();
            return view('orders.purchase', compact('orders'));
        }
        else {
            session()->flash('error','This action is unauthorized.');
            return redirect()->back();
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        if (Gate::allows('isEdit')) {
            if ($order->payment_status == "Unpaid") {
                    $units  = Unit::where('business_id','=',auth()->user()->business_id)->where('is_available','=',true)->get();
                return view('orders.edit', compact('order','units'));
            }
            else {
                session()->flash('warning','Paid orders are allowed to update!');
                return redirect()->back();
            }
        }
        else {
            session()->flash('error','This action is unauthorized.');
            return redirect()->back();
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        // return $request->all();
        if (Gate::allows('isUpdate')) {
            $request->validate([
                'purchase'   =>  'required',
                'sale'       =>  'required',
                'unit'       =>  'required',
                'quantity'   =>  'required',
            ]);

            if ($order->payment_status == "Unpaid") {
                $order->update([
                    'remarks' => $request['remarks']
                ]);

                $order_details = OrderDetail::where('order_id','=',$order->id)->get();
                foreach ($order_details as $key => $order_detail)
                {
                    $order_detail->update([
                        'purchase'  => $request['purchase'][$key],
                        'sale'      => $request['sale'][$key],
                        'unit'      => $request['unit'][$key],
                        'quantity'  => $request['quantity'][$key],
                        'discount'  => $order_details[0]->product->discount * $request['quantity'][$key],
                        'total'     => $request['sale'][$key] * $request['quantity'][$key],
                    ]);
                }

                session()->flash('success','Record update successfully.');
                return redirect()->back();
            }
            else {
                session()->flash('warning','Paid orders are allowed to update!');
                return redirect()->back();
            }
        }
        else {
            session()->flash('error','This action is unauthorized.');
            return redirect()->back();
        }
    }

    public function pay_bill_update(Request $request, Order $order)
    {
        if (Gate::allows('isUpdate')) {
            $request->validate([
                'received'      =>  'required',
                'change_return' =>  'required',
                'wallet_credit' =>  'required',
                'wallet_debit'  =>  'required',
            ]);
            if ($order->payment_status == "Unpaid") {
                $order->update([
                    'received'          => $request['received'],
                    'change_return'     => $request['change_return'],
                    'wallet_credit'     => $request['wallet_credit'],
                    'wallet_debit'      => $request['wallet_debit'],
                    'order_status_id'   => 5,
                    'payment_status'    => "Paid",
                    'rider_id'          => auth()->user()->business_id,
                    'remarks'           => $request['remarks'],
                ]);

                $order->customer->user->update([
                    'wallet'            => $order->customer->user->wallet - $order->wallet_debit + $order->wallet_credit,
                ]);

                if (config('app.sabzify_notification',false) == true && $order->wallet_credit > 0) {
                    $title   = "Sabzify Wallet";
                    $message = "Dear customer, PKR ".number_format($order->wallet_credit,2)." added in your wallet.";

                    // Push Notification Admin
                    Order::AdminPushNotification($title,$message);
                    // Push Notification Customer
                    Order::CustomerPushNotification($order->customer->fcm_token,$title,$message);
                }

                session()->flash('success','Order# '.$order->order_no.' marked as paid.');
                return redirect('orders/'.$order->id);
            }
            else {
                session()->flash('warning','Order# '.$order->order_no.' already paid!');
                return redirect()->back();
            }
        }
        else {
            session()->flash('error','This action is unauthorized.');
            return redirect()->back();
        }
    }    

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        if (Gate::allows('isDestroy')) {
            if ($order->status_message->status == "Cancelled" && $order->payment_status == "Unpaid") {
                $order_details = OrderDetail::where('order_id','=',$order->id)->get();
                foreach($order_details as $key => $order_detail) {
                    $order_detail->delete();
                }
                $order->delete();
                session()->flash('success','Record removed successfully.');
                return redirect()->route('orders.index');
            }
            else {
                session()->flash('warning','Cancelled & Unpaid orders are allowed to remove!');
                return redirect()->route('orders.index');
            }
        }
        else {
            session()->flash('error','This action is unauthorized.');
            return redirect()->back();
        }
    }
    
    public function search(Request $request)
    {
        $request->validate([
            'order_no' => 'required',
        ]);

        $order_no = "SBZ-".$request->order_no;
        if (Gate::allows('isShow')) {
            $order = Order::where('business_id','=',auth()->user()->business_id)->where('order_no','=',$order_no)->first();
            $messages = Message::where('business_id','=',auth()->user()->business_id)->where('type','=',"Notification")->get();
            if($order != null) {
                return redirect()->route('orders.show', ['order' => $order, 'messages' => $messages]);
            }
            else {
                session()->flash('error','Sorry, Invalid Order '.$order_no);
                return redirect()->back();
            }
        }
        else {
            session()->flash('error','This action is unauthorized.');
            return redirect()->back();
        }
    }

    public function order_status(Request $request)
    {
        if (Gate::allows('isUpdate')) {
            $result = Order::findOrFail($request->order_id);
            if ($result->status_message->status == "Delivered" && $result->payment_status == "Paid") {
                session()->flash('warning','Cancelled & Unpaid orders are allowed to update their status!');
                return redirect()->back();
            }

            $result->update([
                'order_status_id' => $request->order_status_id,
                'record_by' => auth()->id()
            ]);

            //################################ Send SMS ################################
            // Order Confirmed
            if(config('app.sabzify_sms',false) == true && $result->status_message->status == "Confirmed") {
                // Fetch SMS Message
                $messages = Message::where('business_id','=',$result->business_id)->where('type','=',"SMS")->where('status','=',"Confirmed")->first();
                $message  = str_replace("ORDER_NO",$result->order_no,$messages->message);
                $message  = str_replace("SABZIFY_SUPPORT",$result->business->email,$message);
                $message  = str_replace("SABZIFY_PHONE",$result->business->phone,$message);

                $sender = "SABZIFY";
                $post = "sender=".urlencode($sender)."&mobile=".urlencode($result->phone)."&message=".urlencode($message)."";
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
                curl_close ($ch);
            }

            //################################ Send Email ################################
            if (config('app.sabzify_email',false) == true) {
                // Order Confirmed
                if ($result->status_message->status == "Confirmed") {
                    \Mail::to($result->email)->send(new \App\Mail\OrderConfirmed($result));
                }

                // Order Preparing
                if ($result->status_message->status == "Preparing") {
                    //\Mail::to($result->email)->send(new \App\Mail\OrderPrepairing($result));
                }

                // Order Pick-Up
                if ($result->status_message->status == "Pick-Up") {
                    //\Mail::to($result->email)->send(new \App\Mail\OrderPickedup($result));
                }

                // Order Arrived
                if ($result->status_message->status == "Arrived") {
                    //\Mail::to($result->email)->send(new \App\Mail\OrderArrived($result));
                }
                
                // Order Delivered
                if ($result->status_message->status == "Delivered") {
                    //\Mail::to($result->email)->send(new \App\Mail\OrderDelivered($result));
                }

                // Order Cancelled
                if ($result->status_message->status == "Cancelled") {
                    //\Mail::to($result->email)->send(new \App\Mail\OrderCancelled($result));
                }
            }

            //################################ Send Notification ################################
            if (config('app.sabzify_notification',false) == true) {
                // Order Confirmed
                if ($result->status_message->status == "Confirmed") {
                    // Fetch SMS Message
                    $messages = Message::where('business_id','=',$result->business_id)->where('type','=',"Notification")->where('status','=',"Confirmed")->first();
                    $message  = str_replace("ORDER_NO",$result->order_no,$messages->message);
                    $message  = str_replace("SABZIFY_SUPPORT",$result->business->email,$message);
                    $message  = str_replace("SABZIFY_PHONE",$result->business->phone,$message);
                }

                // Order Preparing
                if ($result->status_message->status == "Preparing") {
                    // Fetch SMS Message
                    $messages = Message::where('business_id','=',$result->business_id)->where('type','=',"Notification")->where('status','=',"Preparing")->first();
                    $message  = str_replace("ORDER_NO",$result->order_no,$messages->message);
                    $message  = str_replace("SABZIFY_SUPPORT",$result->business->email,$message);
                    $message  = str_replace("SABZIFY_PHONE",$result->business->phone,$message);
                }

                // Order Pick-Up
                if ($result->status_message->status == "Pick-Up") {
                    // Fetch SMS Message
                    $messages = Message::where('business_id','=',$result->business_id)->where('type','=',"Notification")->where('status','=',"Pick-Up")->first();
                    $message  = str_replace("ORDER_NO",$result->order_no,$messages->message);
                    $message  = str_replace("SABZIFY_SUPPORT",$result->business->email,$message);
                    $message  = str_replace("SABZIFY_PHONE",$result->business->phone,$message);
                }

                // Order Arrived
                if ($result->status_message->status == "Arrived") {
                    // Fetch SMS Message
                    $messages = Message::where('business_id','=',$result->business_id)->where('type','=',"Notification")->where('status','=',"Arrived")->first();
                    $message  = str_replace("ORDER_NO",$result->order_no,$messages->message);
                    $message  = str_replace("SABZIFY_SUPPORT",$result->business->email,$message);
                    $message  = str_replace("SABZIFY_PHONE",$result->business->phone,$message);
                }

                // Order Delivered
                if ($result->status_message->status == "Delivered") {
                    // Fetch SMS Message
                    $messages = Message::where('business_id','=',$result->business_id)->where('type','=',"Notification")->where('status','=',"Delivered")->first();
                    $message  = str_replace("ORDER_NO",$result->order_no,$messages->message);
                    $message  = str_replace("SABZIFY_SUPPORT",$result->business->email,$message);
                    $message  = str_replace("SABZIFY_PHONE",$result->business->phone,$message);
                }

                // Order Cancelled
                if ($result->status_message->status == "Cancelled") {
                    // Fetch SMS Message
                    $messages = Message::where('business_id','=',$result->business_id)->where('type','=',"Notification")->where('status','=',"Cancelled")->first();
                    $message  = str_replace("ORDER_NO",$result->order_no,$messages->message);
                    $message  = str_replace("SABZIFY_SUPPORT",$result->business->email,$message);
                    $message  = str_replace("SABZIFY_PHONE",$result->business->phone,$message);
                }

                // Is Delivery Charges Logic!
                $delivery = Delivery::where('id','=',$result->delivery_id)->where('business_id','=',$result->business_id)->first();
                if($result->details->sum('total') >= $delivery->free_delivery_after) {
                    $order_amount = $result->details->sum('total') - ($result->payment_status == "Unpaid" ?  $result->customer->user->wallet : $result->wallet_debit);
                }
                else {
                    $order_amount = ($result->details->sum('total') >= $delivery->free_delivery_after ?  $result->details->sum('total') + 0 : $result->details->sum('total') + $delivery->amount) - ($result->payment_status == "Unpaid" ?  $result->customer->user->wallet : $result->wallet_debit);
                }
                
                $message  = str_replace("ORDER_AMOUNT",round($order_amount),$message);
                $message  = str_replace("PAYMENT_METHOD",$result->payment_method,$message);


                // Push Notification Admin
                Order::AdminPushNotification($result->status_message->title,$message);
                // Push Notification Customer
                Order::CustomerPushNotification($result->customer->fcm_token,$result->status_message->title,$message);
            }

            session()->flash('success','Order Status Updated!');
            return redirect()->back();
        }
        else {
            session()->flash('error','This action is unauthorized.');
            return redirect()->back();
        }
    }

    public function payment_status(Request $request)
    {
        if (Gate::allows('isUpdate')) {
            $result = Order::findOrFail($request->order_id);
            $result->update([
                'payment_status' => $request->payment_status,
                'record_by' => auth()->id()
            ]);

            session()->flash('success','Order marked as '.$request->payment_status.'!');
            return redirect()->back();
        }
        else {
            session()->flash('error','This action is unauthorized.');
            return redirect()->back();
        }
    }    

    public function rider_status(Request $request)
    {
        if (Gate::allows('isUpdate')) {
            $result = Order::findOrFail($request->order_id);
            $result->update([
                'rider_id' => $request->rider_id,
                'record_by' => auth()->id()
            ]);

            session()->flash('success','Rider assigned!');
            return redirect()->back();
        }
        else {
            session()->flash('error','This action is unauthorized.');
            return redirect()->back();
        }
    }    


    public function slip($id)
    {
        // return $order->details;
        if (Gate::allows('isShow')) {
            $order = Order::where('business_id','=',auth()->user()->business_id)->where('id','=',$id)->first();
            return view('orders.slip', compact('order'));
        }
        else {
            session()->flash('error','This action is unauthorized.');
            return redirect()->back();
        }
    }

}