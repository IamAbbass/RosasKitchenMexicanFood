<!doctype html>
<html lang=" str_replace('_', '-', app()->getLocale()) ">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="icon" href="{{ asset('assets/attachment/business/'.auth()->user()->business->icon) }}" type="image/png">
        <title>{{ auth()->user()->business->name." - ".auth()->user()->business->slogan }}</title>
    </head>
    <body>
        <!-- Customer Slip -->
        <div class="ticket">
            <div class="heading-container">
              <!-- Header text -->
              <p class="headings">{{ auth()->user()->business->name }}</p>
              <p class="sub-headings">{{ auth()->user()->business->slogan }}</p>
              <!-- Title of receipt -->
              <p class="title">SALE RECEIPT</p>
            </div>

            <table class="tbl-heading">
              <tr>
                <th>Invoice</th>
                <th>{{ $order->order_no }}</th>
              </tr>
              <tr>
                <th>Date</th>
                <th>{{ date("jS M Y, h:i A",$order->dated) }}</th>
              </tr>
              <tr>
                <th>Customer</th>
                <th>+92{{ $order->phone }}</th>
              </tr>
              <tr>
                <th>Address</th>
                <th>{{ $order->address }}</th>
              </tr>
            </table>

            <table class="tbl-items">
                <thead>
                    <tr>
                        <th class="text-center">Name</th>
                        <th class="text-center">Unit</th>
                        <th class="text-center">Price</th>
                        <th class="text-center">Amt.</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($order->details as $index => $order_detail)
	                    <tr>
                          <td class="text-left">
                            <b>
                              {{ $order_detail->product->name }}<br> 
                              {{ $order_detail->product->name_ur }}
                            </b>
	                        </td>
                          <td class="text-center">{{ $order_detail->quantity }}x{{ $order_detail->unit }}</td>
                          <td class="text-center">{{ $order_detail->sale }}</td>
	                        <td class="text-center">{{ $order_detail->total }}</td>
	                    </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th class="text-left" colspan="3">Gross Amount - <small><i>{{ $order->details->count() }} Item(s)</i></small></th>
                        <th>{{ $order->details->sum('total') }}</th>
                    </tr>

                    @if($order->details->sum('total') >= $order->delivery->free_delivery_after == null ? 0 : $order->delivery->free_delivery_after)
                        <tr>
                            <th class="text-left" colspan="3">Wallet Debit</th>
                            <th>{{ number_format($order->payment_status == "Unpaid" ?  $order->customer->user->wallet : $order->wallet_debit) }}</th>
                        </tr>
                        <tr>
                            <th class="text-left" colspan="3">Net Amount <small><i> - ({{ $order->payment_method }})</i></small></th>
                            <th>{{ number_format($order->details->sum('total') - ($order->payment_status == "Unpaid" ?  $order->customer->user->wallet : $order->wallet_debit)) }}</th>
                        </tr>
                    @else
                        <tr>
                            <th class="text-left" colspan="3">{{ $order->delivery->name }}</th>    
                            <th>{{ number_format($order->details->sum('total')) >= $order->delivery->free_delivery_after ?  "Free" : $order->delivery->amount }}</th>    
                        </tr>
                        <tr>
                            <th class="text-left" colspan="3">Wallet Debit</th>    
                            <th>{{ number_format($order->payment_status == "Unpaid" ?  $order->customer->user->wallet : $order->wallet_debit) }}</th>
                        </tr>
                        <tr>
                            <th class="text-left" colspan="3">Net Amount <small><i> - {{ $order->payment_method }}</i></small></th>
                            <th>{{ number_format(($order->details->sum('total') >= $order->delivery->free_delivery_after ?  $order->details->sum('total') + 0 : $order->details->sum('total') + $order->delivery->amount) - ($order->payment_status == "Unpaid" ?  $order->customer->user->wallet : $order->wallet_debit)) }}</th>    
                        </tr>
                    @endif

                    @if ($order->details->sum('discount') > 0)
                        <tr>
                            <th class="text-center" colspan="4" style="font-size: 9.5px">You saved PKR {{ number_format($order->details->sum('discount'),2) }} on this order.</th>
                        </tr>
                    @endif

                </tfoot>
            </table>
            <footer>
              <h5>TERMS & CONDITIONS</h5>
              <p style="font-size: 11px; text-align: justify;">
                  - Sabzify will not cater to any complaints made after 01 hours of delivery time.<br />
                  - Opening of parcels without cash payment is strictly prohibited.<br />
                  - Provide original receipt to return or exchange any item.<br />
                  - Prices are inclusive of sales tax, where applicable.
              </p>
              <p style="font-size: 19px; text-align: center;">
                <strong>
                    For Home Delivery, Whatsapp or Call<br>
                    {{ auth()->user()->business->phone }}
                </strong>
              </p>
              <p style="font-size: 10.5px; text-align: center;">
                <strong>
                  Timings: 10:30 AM to 07:00 PM<br>
                  Friday Break: 12:45 PM to 02:30 PM
                </strong>
              </p>
              <p style="font-size: 14px; text-align: center;">
                <img src="{{ asset('assets/attachment/business/playstore.png') }}" width="100" alt="Sabzify App"><br>
                <strong>Scan & rate with 5 stars</strong>
              </p>
              <p style="font-size: 11px; text-align: center;">
                  Powered By: <strong><i>Zed Developers</i></strong><br>
                  Cell: 0302-2203204, 0316-1126671<br>
                  Web: www.zeddevelopers.com
              </p>
            </footer>
        </div>

        <!-- Store Keeper Slip -->
        <div class="ticket" style="margin-top: 30px;border-top: 2px dashed;padding-top: 30px;">
            <table class="tbl-heading">
              <tr>
                <th>Invoice</th>
                <th>{{ $order->order_no }}</th>
              </tr>
              <tr>
                <th>Date</th>
                <th>{{ date("jS M Y, h:i A",$order->dated) }}</th>
              </tr>
            </table>

            <table class="tbl-items">
                <thead>
                    <tr>
                        <th class="text-center">Name</th>
                        <th class="text-center">Unit</th>
                        <th class="text-center">Price</th>
                        <th class="text-center">Amt.</th>
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
                          <td class="text-left">
                            <b>
                              {{ $order_detail->product->name }}<br> 
                              {{ $order_detail->product->name_ur }}
                            </b>
	                        </td>
                          <td class="text-center">{{ $order_detail->quantity }}x{{ $order_detail->unit }}</td>
                          <td class="text-center">{{ $order_detail->purchase }}</td>
	                        <td class="text-center">{{ $order_detail->purchase * $order_detail->quantity }}</td>
	                    </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th class="text-left" colspan="3">Purchase Amt. - <small><i>{{ $order->details->count() }} Item(s)</i></small></th>
                        <th>{{ number_format($purchase_sum) }}</th>
                    </tr>
                </tfoot>
            </table>
            <footer>
              <p style="font-size: 11px; text-align: center;">
                  Powered By: <strong><i>Zed Developers</i></strong><br>
                  Cell: 0302-2203204, 0316-1126671<br>
                  Web: www.zeddevelopers.com
              </p>
            </footer>
        </div>

        <script type="text/javascript">
            window.print();
            window.onfocus=function(){ window.close();}
        </script>
    </body>
</html>

<style type="text/css">
  body{
    margin: 0;
    padding: 0;
  }
  .ticket {
    width: 47.70mm;
  }
  .headings{
    font-size: 37px;
    font-weight: bold;
    text-transform: uppercase;
    letter-spacing: 1px;
  }
  .sub-headings{
  	font-size: 14px;
  	font-weight: bold;
  	text-transform: uppercase;
    letter-spacing: 1px;
  }
  .title {
  	font-size: 15px;
  	font-weight: bold;
  	text-transform: uppercase;
    letter-spacing: 1px;
    padding: 10px 0 2px 0;
  }
  .heading-container {
    text-align: center;
  }
  p {
    margin: 0;
    padding: 0;
  }
  table {
    width: 100%;
    margin-bottom: 10px;
  }
  table, th, td{
    border-collapse: collapse;
    border: 1px solid #000;
    padding: 2px 4px;
  }
  .tbl-heading th{
    font-size: 10px;
    text-align: left;
  }
  .tbl-items th{
    font-size: 12px;
    font-weight: bold;
  }
  .tbl-items td{
    font-size: 12px;
  }
  small{
    font-size: 10px;
  }
  footer p {
    padding: 3px 0;
  }
  h5 {
    margin: 0 0 4px 0;
    text-decoration: underline;
    font-size: 14px;
    text-align: center;
  }
  .text-justify {
    text-align: justify;
  }
  .text-left {
    text-align: left;
  }
  .float-left {
    float: left;
  }
  .text-center {
    text-align: center;
  }
  .text-right {
    text-align: right;
  }
  .float-right {
    float: right;
  }

</style>
