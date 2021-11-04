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
                    <li class="breadcrumb-item active" aria-current="page">Pay Bill</li>
                </ol>
            </nav>
        </div>
    </div>

    <!--end breadcrumb-->
    <hr/>
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-7 table-responsive">
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>Customer Order</th>
                                <th>Customer Contact</th>
                            </tr>
                        </thead>
                        <tbody>
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
                            <tr>
                                <td class="text-center">
                                    <a href="/orders/{{ $order->id }}">
                                        <img style="{{ ($order->customer->user->is_verified == true) ? 'border: 2.5px solid green' : 'border: 2.5px solid red' }}" src="{{ asset('assets/attachment/user/'.$order->customer->user->image) }}" class="rounded-circle" width="50" height="50" alt="{{ $order->name }}"><br>
                                        {{ $order->order_no }}
                                    </a><br>
                                    <small>
                                        dt. {{ date("d-m-Y h:i:sa",$order->dated) }}<br>
                                        Status changed since {{ Carbon\Carbon::parse(date("Y-m-d h:i:sa",$order->dated))->diffForHumans() }}<br>
                                        {{ $order->record_by == 0 ? 'Mobile App' : 'By: '.$order->customer->user->name }}
                                    </small>
                                </td>
                                <td>
                                    Name: {{ $order->name }}<br>
                                    <a href="tel:92{{ $order->phone }}">Phone: {{ $order->phone }}</a> / <a href="https://api.whatsapp.com/send?phone=92{{ $order->phone }}" target="_blank"><i class="lni lni-whatsapp"></i></a><br>
                                    Email: {{ $order->email }}<br>
                                    Wallet: PKR {{ number_format($order->customer->user->wallet) }}
                                    <hr style="margin: 0.2rem 0 !important">
                                    Coupon: {{ $order->coupon }}, Gift: {{ $order->is_gift == true ? "Yes" : "No" }}<br>
                                    <small>
                                        <span>App order radius is {{ number_format($distance,2)." Km" }}</span> - 
                                        <a href="https://www.google.com/maps/place/{{ $order->location }}" target="_blank">Google Map</a>
                                    </small>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="4" style="padding:4px; font-weight:bold; font-size:11px;">Address: {{ $order->address }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="col-md-5">
                    <h5 class="card-title">Billing Details (<i>{{ $order->status_message->status }} / {{ $order->payment_status }} / {{ $order->payment_method }}</i>)</h5>
                    <hr style="margin: 0.2rem 0 !important">
                    <form action="/orders/pay_bill/{{ $order->id }}/update" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row g-2">
                            <div class="col-md-4">
                                <label class="billing_label">Gross Amount</label>
                                <input type="number" value="{{ $order->details->sum('total') }}" class="form-control small_dropdown" readonly>
                            </div>

                            @if($order->details->sum('total') >= $order->delivery->free_delivery_after)
                                <div class="col-md-4">
                                    <label class="billing_label"><span id="zero_wallet_debit">Wallet Debit (Clear It)</span></label>
                                    <input type="number" name="wallet_debit" id="wallet_debit" value="{{ $order->payment_status == "Unpaid" ?  $order->customer->user->wallet : $order->wallet_debit }}" class="form-control small_dropdown" readonly>
                                </div>
                                <div class="col-md-4">
                                    <label class="billing_label">Net Amount</label>
                                    <input type="number" id="net_amount" value="{{ $order->payment_status == "Unpaid" ?  $order->details->sum('total') - $order->customer->user->wallet : $order->details->sum('total') - $order->wallet_debit }}" class="form-control small_dropdown" readonly>
                                </div>
                                <div class="col-md-4">
                                    <label class="billing_label">* Received</label>
                                    <input type="number" id="received" name="received" value="{{ $order->payment_status == "Unpaid" ?  $order->details->sum('total') - $order->customer->user->wallet : $order->details->sum('total') - $order->wallet_debit }}" class="form-control small_dropdown">
                                </div>
                                <div class="col-md-4">
                                    <label class="billing_label">* Change Return</label>
                                    <input type="number" id="change_return" name="change_return" value="0" class="form-control small_dropdown">
                                </div>
                                <div class="col-md-4">
                                    <label class="billing_label">Wallet Credit</label>
                                    <input type="number" id="wallet_credit" value="0" name="wallet_credit" class="form-control small_dropdown" readonly>
                                </div>
                            @else
                                <div class="col-md-4">
                                    <label class="billing_label">Delivery Charges</label>
                                    <input type="number" value="{{ $order->details->sum('total') >= $order->delivery->free_delivery_after ?  0 : $order->delivery->amount }}" class="form-control small_dropdown" readonly>
                                </div>
                                <div class="col-md-4">
                                    <label class="billing_label"><span id="zero_wallet_debit">Wallet Debit (Clear It)</span></label>
                                    <input type="number"  name="wallet_debit" id="wallet_debit" value="{{ $order->payment_status == "Unpaid" ?  $order->customer->user->wallet : $order->wallet_debit }}" class="form-control small_dropdown" readonly>
                                </div>
                                <div class="col-md-3">
                                    <label class="billing_label">Net Amount</label>
                                    <input type="number" id="net_amount" value="{{ ($order->payment_status == "Unpaid" ?  $order->details->sum('total') - $order->customer->user->wallet : $order->details->sum('total') - $order->wallet_debit) + ($order->details->sum('total') >= $order->delivery->free_delivery_after ?  0 : $order->delivery->amount) }}" class="form-control small_dropdown" readonly>
                                </div>
                                <div class="col-md-3">
                                    <label class="billing_label">* Received</label>
                                    <input type="number" id="received" name="received" value="{{ ($order->payment_status == "Unpaid" ?  $order->details->sum('total') - $order->customer->user->wallet : $order->details->sum('total') - $order->wallet_debit) + ($order->details->sum('total') >= $order->delivery->free_delivery_after ?  0 : $order->delivery->amount) }}" class="form-control small_dropdown">
                                </div>
                                <div class="col-md-3">
                                    <label class="billing_label">* Change Return</label>
                                    <input type="number" id="change_return" name="change_return" value="0" class="form-control small_dropdown">
                                </div>
                                <div class="col-md-3">
                                    <label class="billing_label">Wallet Credit</label>
                                    <input type="number" id="wallet_credit" value="0" name="wallet_credit" class="form-control small_dropdown" readonly>
                                </div>
                            @endif

                            <div class="col-md-9">
                                <label class="billing_label">Remarks</label>
                                <input type="text" name="remarks" value="{{ $order->remarks == null ? "No remarks yet." : $order->remarks }}" class="form-control small_dropdown">
                            </div>
                            <div class="col-3" style="margin-top:1.8rem">
                                <div class="d-grid">
                                    <button type="submit" class="btn btn-success small_dropdown">Pay</button>
                                </div>
                            </div>
                            </div>
                    </form>
                </div>
            </div>
            <div class="row">
                <div class="table-responsive">
                     <!-- Order Details -->
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>Image</th>
                                <th>Description</th>
                                <th width="11%">Purchase</th>
                                <th width="11%">Sale</th>
                                <th width="11%">Unit</th>
                                <th width="11%">Qty</th>
                                <th width="12%">Amount</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $purchase_sum = 0;
                            @endphp
                            @foreach($order->details as $index => $order_detail)
                            @php
                                $purchase_sum += ($order_detail->purchase * $order_detail->quantity);
                            @endphp
                            <tr>
                                <td class="text-center">
                                    <a href="/products/{{$order_detail->product_id}}/edit" target="_blank">
                                        <img src="{{ asset('assets/attachment/product/'.$order_detail->product->image) }}" class="rounded-circle" width="50" height="50" alt="{{ $order_detail->name }}"><br>
                                        <small>{{ $order_detail->product->sku }}/{{ $order_detail->product->id }}</small>
                                    </a>
                                </td>
                                <td>
                                    {{ $order_detail->product->name }}, {{ $order_detail->product->name_ru }}, {{ $order_detail->product->name_ur }}
                                    <hr style="margin: 0.2rem 0 !important">
                                    Profit: {{ ($order_detail->sale - $order_detail->purchase) * $order_detail->quantity }}
                            </td>
                                <td>{{ $order_detail->purchase }}</td>
                                <td>{{ $order_detail->sale }}</td>
                                <td>{{ $order_detail->unit }}</td>
                                <td class="text-center">{{ $order_detail->quantity }}</td>
                                <td>{{ number_format($order_detail->total) }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot style="font-weight: bold;">
                            <tr>
                                <td colspan="6" style="padding: 0 3px; font-weight:bold; font-size:10px;">Note: {{ $order->note }}</td>
                            </tr>
                            <tr>
                                <td colspan="6" style="padding: 0 3px; font-weight:bold; font-size: 10px;">Remarks: {{ $order->remarks == null ? "No remarks yet." : $order->remarks }}</td>
                            </tr>
                            <tr>
                                <td colspan="6" style="text-align: right; padding: 0 3px;">Gross Amount - <small><i>{{ $order->details->count() }} Item(s)</i></small></td>    
                                <td style="padding: 0 3px;">{{ number_format($order->details->sum('total')) }}</td>
                            </tr>

                            @if($order->details->sum('total') >= $order->delivery->free_delivery_after == null ? 0 : $order->delivery->free_delivery_after)
                                <tr>
                                    <td colspan="6" style="text-align: right; padding: 0 3px;">{{ $order->payment_status }} Debit</td>
                                    <td style="padding: 0 3px;">{{ $order->payment_status == "Unpaid" ?  number_format($order->customer->user->wallet) : number_format($order->wallet_debit) }}</td>
                                </tr>
                                <tr>
                                    <td colspan="6" style="text-align: right; padding: 0 3px;">Net Amount <small><i> - ({{ $order->payment_method }})</i></small></td>
                                    <td style="padding: 0 3px;">{{ $order->details->sum('total') - ($order->payment_status == "Unpaid" ?  number_format($order->customer->user->wallet) : number_format($order->wallet_debit)) }}</td>
                                </tr>
                            @else
                                <tr>
                                    <td colspan="6" style="text-align: right; padding: 0 3px;">{{ $order->delivery->name }}</td>    
                                    <td style="padding: 0 3px;">{{ $order->details->sum('total') >= $order->delivery->free_delivery_after ?  "Free" : number_format($order->delivery->amount) }}</td>
                                </tr>
                                <tr>
                                    <td colspan="6" style="text-align: right; padding: 0 3px;">{{ $order->payment_status }} Debit</td>    
                                    <td style="padding: 0 3px;">{{ $order->payment_status == "Unpaid" ?  number_format($order->customer->user->wallet) : number_format($order->wallet_debit) }}</td>
                                </tr>
                                <tr>
                                    <td colspan="6" style="text-align: right; padding: 0 3px;">Net Amount <small><i> - {{ $order->payment_method }}</i></small></td>
                                    <td style="padding: 0 3px;">{{ $order->details->sum('total') >= $order->delivery->free_delivery_after ?  number_format($order->details->sum('total')) : number_format(($order->details->sum('total') + $order->delivery->amount) - ($order->payment_status == "Unpaid" ?  $order->customer->user->wallet : $order->wallet_debit)) }}</td>
                                </tr>
                            @endif

                            @if($order->payment_status == "Paid")
                                <tr>
                                    <td colspan="7" style="padding: 0;font-size: 5px;background-color: #000;">&nbsp</td>
                                </tr>
                                <tr style="color: #a62523">
                                    <th style="text-align: right; padding: 0 3px; font-size: 11px;">Net Purchase</th>    
                                    <th style="padding: 0 3px; font-size: 11px;">{{ number_format($purchase_sum) }}</th>    

                                    @if ($order->is_gift == true)
                                        <th colspan="4" style="text-align: right; padding: 0 3px; font-size: 11px;">Net Profit (Including Gift)</th>
                                        <th style="padding: 0 3px; font-size: 11px;">{{ number_format($order->received - $order->change_return - $order->wallet_credit - $purchase_sum - 30) }}</th>
                                    @else
                                        <th colspan="4" style="text-align: right; padding: 0 3px; font-size: 11px;">Net Profit</th>
                                        <th style="padding: 0 3px; font-size: 11px;">{{ number_format($order->received - $order->change_return - $order->wallet_credit - $purchase_sum) }}</th>
                                    @endif
                                </tr>
                                <tr style="color: #a62523">
                                    <th style="text-align: right; padding: 0 3px; font-size: 11px;">Received</th>    
                                    <th style="padding: 0 3px; font-size: 11px;">{{ number_format($order->received) }}</th>    

                                    <th style="text-align: right; padding: 0 3px; font-size: 11px;">Change Return</th>    
                                    <th style="padding: 0 3px; font-size: 11px;">{{ number_format($order->change_return) }}</th>

                                    <th colspan="2" style="text-align: right; padding: 0 3px; font-size: 11px;">Wallet Credit</th>    
                                    <th style="padding: 0 3px; font-size: 11px;">{{ number_format($order->wallet_credit) }}</th>
                                </tr>
                            @else
                                <tr>
                                    <td colspan="7" style="padding: 0;font-size: 5px;background-color: #000;">&nbsp</td>
                                </tr>
                                <tr style="color: #a62523">
                                    <th colspan="6" style="text-align: right; padding: 0 3px; font-size: 11px;">Net Purchase</th>    
                                    <th style="padding: 0 3px; font-size: 11px;">{{ number_format($purchase_sum) }}</th>    
                                </tr>
                            @endif

                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
