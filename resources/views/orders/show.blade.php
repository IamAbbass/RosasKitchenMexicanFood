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
                    <li class="breadcrumb-item active" aria-current="page">Order Detail</li>
                </ol>
            </nav>
        </div>
    </div>

    <!--end breadcrumb-->
    <hr/>
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>Customer Order</th>
                            <th>Customer Contact</th>
                            <th>Order Details</th>
                            <th>Action</th>
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
                                <a href="/orders">
                                    <img style="{{ ($order->customer->user->is_verified == true) ? 'border: 2.5px solid green' : 'border: 2.5px solid red' }}" src="{{ asset('assets/attachment/user/'.$order->customer->user->image) }}" class="rounded-circle" width="50" height="50" alt="{{ $order->name }}"><br>
                                    {{ $order->order_no }}
                                </a><br>
                                <small>
                                    Order at {{ date("d-m-Y h:i:sa",$order->dated) }}<br>
                                    Since {{ Carbon\Carbon::parse(date("Y-m-d h:i:sa",$order->dated))->diffForHumans() }}
                                </small>
                            </td>
                            <td>
                                Name: {{ $order->name }}<br>
                                <a href="tel:92{{ $order->phone }}">Phone: {{ $order->phone }}</a> / <a href="https://api.whatsapp.com/send?phone=92{{ $order->phone }}" target="_blank"><i class="lni lni-whatsapp"></i></a><br>
                                Email: {{ $order->email }}<br>
                                Wallet: PKR {{ number_format($order->customer->user->wallet) }}
                                <hr style="margin: 0.2rem 0 !important">
                                <small>
                                    <span id="radius"></span><br>
                                    <span id="distance"></span> - <a href="https://www.google.com/maps/place/{{ $order->location }}" target="_blank">Google Map</a>
                                </small>
                            </td>
                            <td>
                                <small>App order radius is {{ number_format($distance,2)." Km" }}</small>
                                <hr style="margin: 0.2rem 0 !important">
                                Coupon: {{ $order->coupon }}, Gift: {{ $order->is_gift == true ? "Yes" : "No" }}<br>
                                Gross Amount: {{ number_format($order->details->sum('total')) }} - <small><i>(saved {{ $order->details->sum('discount') }})</i></small><br>
                                {{ $order->payment_status == "Unpaid" ?  "Unpaid Debit: ".number_format($order->customer->user->wallet) : "Paid Debit: ".number_format($order->wallet_debit) }}<br>

                                @if($order->details->sum('total') >= $order->delivery->free_delivery_after == null ? 0 : $order->delivery->free_delivery_after)
                                    <kbd>Net Amount: {{ number_format($order->details->sum('total') - ($order->payment_status == "Unpaid" ?  $order->customer->user->wallet : $order->wallet_debit)) }} - {{ $order->payment_method }}</kbd>
                                @else
                                    {{ $order->delivery->name }}: {{ number_format($order->delivery->amount) }}<br>
                                    <kbd>Net Amount: {{ number_format(($order->details->sum('total') + $order->delivery->amount) - ($order->payment_status == "Unpaid" ?  $order->customer->user->wallet : $order->wallet_debit)) }} - {{ $order->payment_method }}</kbd>
                                @endif
                            </td>
                            <td>
                                <div class="d-flex order-actions">
                                    <a href="/orders/slip/{{ $order->id }}" target="_blank" class="" title="Print Slip"><i class="lni lni-printer"></i></a>
                                    <a href="/orders/pay_bill/{{ $order->id }}" class="ms-2" title="Pay Bill"><i class="bx bxs-credit-card-front"></i></a>
                                    <a href="/orders/{{ $order->id }}/edit" class="ms-2" title="Edit"><i class="bx bxs-edit"></i></a>
                                    <a href="/orders/{{ $order->id }}" class="ms-2" title="Delete" onclick="event.preventDefault(); document.getElementById('del-form').submit();">
                                        <i class="bx bxs-trash"></i></a>
                                    </a>
                                    <form id="del-form" action="/orders/{{ $order->id }}" method="POST">
                                        @csrf
                                        {{ method_field('DELETE') }}
                                    </form>
                                </div>
                                <hr style="margin: 0.2rem 0 !important">
                                <form action="/order_status/change"  method="POST">
                                    @csrf
                                    <input type="hidden" name="order_id" value="{{ $order->id }}" required>
                                    <select name="order_status_id" class="form-control small_dropdown" onchange="this.form.submit()">
                                        @foreach($messages as $message)
                                            <option {{ ($order->order_status_id == $message->id) ? 'selected' : '' }} value="{{$message->id}}">Order is {{ ucfirst($message->status) }}</option>
                                        @endforeach
                                    </select>
                                </form>
                                <form action="/payment_status/change"  method="POST">
                                    @csrf
                                    <input type="hidden" name="order_id" value="{{ $order->id }}" required>
                                    <select name="payment_status" class="form-control small_dropdown" onchange="this.form.submit()">
                                        <option {{ ($order->payment_status == "Unpaid") ? 'selected' : '' }} value="Unpaid">Order is Unpaid</option>
                                        <option {{ ($order->payment_status == "Paid") ? 'selected' : '' }} value="Paid">Order is Paid</option>
                                    </select>
                                </form>
                                <form action="/rider_status/change"  method="POST">
                                    @csrf
                                    <input type="hidden" name="order_id" value="{{ $order->id }}" required>
                                    <select name="rider_id" class="form-control small_dropdown" onchange="this.form.submit()">
                                        <option value="">Select Rider</option>
                                        @foreach($riders as $rider)
                                            <option {{ ($order->rider_id == $rider->id) ? 'selected' : '' }} value="{{$rider->id}}">Rider: {{ ucfirst($rider->name) }}</option>
                                        @endforeach
                                    </select>
                                </form>
                                <hr style="margin: 0.2rem 0 !important">
                                <i>{{ $order->status_message->status }} / {{ $order->payment_status }} / {{ $order->payment_method }}</i><br>
                                <small style="font-size:8px">
                                    Since {{ Carbon\Carbon::parse(date("Y-m-d h:i:sa",strtotime($order->updated_at)))->diffForHumans() }}
                                    by {{ $order->record_by == 0 ? 'Mobile App' : $order->user->name }}
                                </small>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="4" style="padding:4px; font-weight:bold; font-size:11px;">Address: {{ $order->address }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="row">
                <div class="col-md-7 table-responsive">
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
                                    {{ $order_detail->product->name }}<br>{{ $order_detail->product->name_ur }}
                                    <hr style="margin: 0.2rem 0 !important">
                                    Profit: {{ ($order_detail->sale - $order_detail->purchase) * $order_detail->quantity }}
                                </td>
                                <td>
                                    {{ $order_detail->purchase }} x {{ $order_detail->quantity }}
                                    <hr style="margin: 0.2rem 0 !important">
                                    Purchse: {{ $order_detail->purchase * $order_detail->quantity }}
                                </td>
                                <td>{{ $order_detail->sale }}</td>
                                <td>{{ $order_detail->unit }}</td>
                                <td class="text-center">{{ $order_detail->quantity }}</td>
                                <td>{{ number_format($order_detail->total) }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot style="font-weight: bold;">
                            <tr>
                                <td colspan="7" style="padding: 0 3px; font-weight:bold; font-size:10px;">Note: {{ $order->note }}</td>
                            </tr>
                            <tr>
                                <td colspan="7" style="padding: 0 3px; font-weight:bold; font-size: 10px;">Remarks: {{ $order->remarks == null ? "No remarks yet." : $order->remarks }}</td>
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
                <div class="col-md-5">
                    <!-- <div id="msg"></div> -->
                    <div id="map" style="width: 100%; height: 100%;"></div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
        // Initialize and add the map
        var map;
        function initMap() {
            // The map, centered on Central Park
            const center = { lat: {{ $lat1 }}, lng: {{ $lon1 }} };
            const options = { zoom: 15, scaleControl: true, center: center };
            map = new google.maps.Map(
                document.getElementById('map'), options);
            // Locations of landmarks
            const point1 = { lat: {{ $lat1 }}, lng: {{ $lon1 }} };
            const point2 = { lat: {{ $lat2 }}, lng: {{ $lon2 }} };
            // The markers for The point1 and The point2 Collection
            var mk1 = new google.maps.Marker({ position: point1 }); //, map: map
            var mk2 = new google.maps.Marker({ position: point2 }); //, map: map

            // Draw strait line between two points
            // var line = new google.maps.Polyline({ path: [point1, point2] }); //, map: map

            // Formula to calculate strait line distance between these points
            function haversineDistance(mk1, mk2) {
                var rad = 6371.0710; // Radius of the Earth in kms
                var rlat1 = mk1.position.lat() * (Math.PI / 180); // Convert degrees to radians
                var rlat2 = mk2.position.lat() * (Math.PI / 180); // Convert degrees to radians
                var difflat = rlat2 - rlat1; // Radian difference (latitudes)
                var difflon = (mk2.position.lng() - mk1.position.lng()) * (Math.PI / 180); // Radian difference (longitudes)

                var d = 2 * rad * Math.asin(Math.sqrt(Math.sin(difflat / 2) * Math.sin(difflat / 2) + Math.cos(rlat1) * Math.cos(rlat2) * Math.sin(difflon / 2) * Math.sin(difflon / 2)));
                return d;
            }

            // Call method to get distance and print.
            var distance = haversineDistance(mk1, mk2);
            document.getElementById('radius').innerHTML = "Google  order radius is " + distance.toFixed(2) + " Km";

            // Travel Distance
            let directionsService = new google.maps.DirectionsService();
            let directionsRenderer = new google.maps.DirectionsRenderer();
            directionsRenderer.setMap(map); // Existing map object displays directions
            // Create route from existing points used for markers
            const route = {
                origin: point1,
                destination: point2,
                travelMode: 'DRIVING',
                provideRouteAlternatives: true
            }

            directionsService.route(route,
                // capture directions
                function (response, status) {
                    if (status !== 'OK') {
                        window.alert('Directions request failed due to ' + status);
                        return;
                    } else {
                        directionsRenderer.setDirections(response); // Add route to the map
                        var directionsData = response.routes[0].legs[0]; // Get data about the mapped route
                        if (!directionsData) {
                            window.alert('Directions request failed');
                            return;
                        } else {
                            document.getElementById('distance').innerHTML += "Google travel distance is " + directionsData.distance.text + " (" + directionsData.duration.text + ")";
                        }
                    }
                });
        }
    </script>
    <!-- replace api key below -->
    <script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB0k5eKvAEjLA5lU2QRHFtOqeGmai-vpe0&callback=initMap">
    </script>
@endsection
