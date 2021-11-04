@extends('layouts.app')

@section('content')
<div class="page-content">
    @include('layouts.alert')
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Orders</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-cart"></i></a></li>
                    <li class="breadcrumb-item active" aria-current="page">Order List - {{ $filter }}</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            <div class="btn-group">
                <a href="{{ URL::to('orders/create') }}" class="btn btn-success"><i class="bx bx-plus-circle"></i> Add Order</a>
            </div>
        </div>
    </div>

    <!--end breadcrumb-->
    <hr/>
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table id="example" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th class="text-center">#</th>
                            <th>Customer Order</th>
                            <th>Customer Contact</th>
                            <th>Order Details</th>
                            {{-- <th>Action</th> --}}
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($orders as $index => $order)
                        @php
                            $business = App\Models\Business::where('id','=',$order->business_id)->first();
                            $location1 = explode(",",$business->location);
                            $location2 = explode(",",$order->location);
                            $lat1 = $location1[0];
                            $lon1 = $location1[1];
                            $lat2 = $location2[0];
                            $lon2 = $location2[1];
                            $distance = App\Models\Order::distance($lat1, $lon1, $lat2, $lon2, "K");
                        @endphp
                        <tr title="{{ $order->address }}">
                            <td class="text-center">{{ $index+1 }}</td>
                            <td class="text-center">
                                <a href="/orders/{{ $order->id }}">
                                    {{ $order->order_no }}<br>
                                    <small>
                                        Order at {{ date("d-m-Y h:i:sa",$order->dated) }}<br>
                                        Since {{ Carbon\Carbon::parse(date("Y-m-d h:i:sa",$order->dated))->diffForHumans() }}
                                    </small>
                                    <hr style="margin: 0.2rem 0 !important">
                                    <small style="font-size:9px">
                                        Updated since {{ Carbon\Carbon::parse(date("Y-m-d h:i:sa",strtotime($order->updated_at)))->diffForHumans() }}
                                        by {{ $order->record_by == 0 ? 'Mobile App' : $order->user->name }}
                                    </small>
                                </a>
                            </td>
                            <td>
                                Name: {{ $order->name }}<br>
                                <a href="tel:92{{ $order->phone }}">Phone: {{ $order->phone }}</a><br>
                                Email: {{ $order->email }}<br>
                                <hr style="margin: 0.2rem 0 !important">
                                <small>App order radius is {{ number_format($distance,2)." Km" }} - <a href="https://www.google.com/maps/place/{{ $order->location }}" target="_blank">Google Map</a></small>
                            </td>
                            <td>
                                Coupon: {{ $order->coupon }}, Gift: {{ $order->is_gift == true ? "Yes" : "No" }}, Wallet: PKR {{ number_format($order->customer->user->wallet) }}<br>
                                Gross Amount: {{ round($order->details->sum('total')) }} - <small><i>(saved {{ $order->details->sum('discount') }})</i></small><br>
                                {{ $order->payment_status == "Unpaid" ?  "Unpaid Debit: ".number_format($order->customer->user->wallet) : "Paid Debit: ".number_format($order->wallet_debit) }}<br>

                                @if($order->details->sum('total') >= $order->delivery->free_delivery_after == null ? 0 : $order->delivery->free_delivery_after)
                                    <kbd>Net Amount: {{ number_format($order->details->sum('total') - ($order->payment_status == "Unpaid" ?  $order->customer->user->wallet : $order->wallet_debit)) }} - <i>({{ $order->status_message->status }} / {{ $order->payment_status }} / {{ $order->payment_method }})</i></kbd>
                                @else
                                    {{ $order->delivery->name }}: {{ number_format($order->delivery->amount) }}<br>
                                    <kbd>Net Amount: {{ number_format(($order->details->sum('total') + $order->delivery->amount) - ($order->payment_status == "Unpaid" ?  $order->customer->user->wallet : $order->wallet_debit)) }} - <i>({{ $order->status_message->status }} / {{ $order->payment_status }} / {{ $order->payment_method }})</i></kbd>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>#</th>
                            <th>Customer Order</th>
                            <th>Customer Contact</th>
                            <th>Order Details</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
