<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Customer;
use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;


class HomeController extends Controller
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

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        // 2021-10-24 16:16:17
        $from = date('Y-m-d', strtotime($request->from))." 00:00:00";
        $to   = date('Y-m-d', strtotime($request->to))." 23:59:59";

        // // User
        // $wallet_payable             = User::whereBetween('created_at', [$from, $to])->sum('wallet');

        // // Customers
        // $customers_all_count        = Customer::count();
        // $customers_new_count        = Customer::whereBetween('created_at', [$from, $to])->count();

        // // Orders
        // $orders_all_count           = Order::where('order_status_id','=','5')->count();
        // $orders_new_count           = Order::where('order_status_id','=','5')->whereBetween('created_at', [$from, $to])->count();
        // $re_orders_count            = Order::where('order_status_id','=','5')->whereBetween('created_at', [$from, $to])->groupBy('customer_id')->count();
        // $orders_cancelled_count     = Order::where('order_status_id','=','5')->whereBetween('updated_at', [$from, $to])->count();
        // $wallet_debit               = Order::whereBetween('updated_at', [$from, $to])->sum('wallet_debit');
        // $wallet_credit              = Order::whereBetween('updated_at', [$from, $to])->sum('wallet_credit');

        // $purchase_sum               = 0;
        // $delivery_sum               = 0;
        // $orders                     = Order::where('order_status_id','=','5')->whereBetween('created_at', [$from, $to])->get();
        // $order_gift_count           = Order::where('order_status_id','=','5')->where('is_gift','=',true)->whereBetween('created_at', [$from, $to])->count();
        // $order_delivery_count       = Order::where('order_status_id','=','5')->where('delivery_id','>',1)->whereBetween('created_at', [$from, $to])->count();
        // foreach($orders[0]->details as $key => $order) {
        //     $purchase_sum += ($order->purchase * $order->quantity);
        // }

        // foreach($orders as $key => $order) {
        //     if($order->details->sum('total') < $order->delivery->free_delivery_after) {
        //         $delivery_sum += $order->delivery->amount;
        //     }

        // }

        // return view('home', compact(
        //     'wallet_payable',
        //     'customers_all_count','customers_new_count',
        //     'orders_all_count',   'orders_new_count', 're_orders_count', 'orders_cancelled_count',
        //     'wallet_debit', 'wallet_credit','purchase_sum','orders','order_gift_count','delivery_sum','order_delivery_count'

        // ));
        
        return view('home');
    }

    public function index_filter(Request $request)
    {
        // return $request->all();
        // 2021-09-05 22:32:51

    }
}
