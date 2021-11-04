<!doctype html>
<html lang=" str_replace('_', '-', app()->getLocale()) ">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="icon" href="{{ asset('assets/attachment/favicon.png') }}" type="image/png">
        <title>{{ config('app.name', false) }}  -  {{ config('app.slogan', false) }}</title>
    </head>
    <body>
        <div class="ticket">
            <div class="heading-container">
                <!-- Header text -->
                <p class="headings">{{ config('app.name', false) }}</p>
                <p class="sub-headings">{{ config('app.slogan', false) }}</p>
                <!-- <p>Whatsapp: {{ auth()->user()->business->phone }}</p> -->
                <!-- Title of receipt -->
                <p class="title">Purchase Order</p>
            </div>

            <table class="tbl-heading">
				<tr>
					<th>Date</th>
					<th class="text-center">{{ date("D, jS M Y",time()) }}</th>
				</tr>
				<tr>
					<th>Orders</th>
					<th class="text-center">{{ $orders->count() }}</th>
				</tr>
			</table>


            <table class="tbl-items">
                <thead>
                    <tr>
                        <th class="text-center">#</th>
                        <th class="text-center">Description</th>
                    </tr>
                </thead>
                <tbody>
                  <tr>
                      <td class="text-center">0</td>
                      <td>
                          Green Chilli German <i class="float-right">Kg</i><br>
                          Hari Mirch, ہری مرچ<br>
                          Bags of. 1-2-1-7<br>
                          Total 11 Kg
                      </td>
                  </tr>
                  @foreach($orders as $index => $order)
                  <tr>
                      <td class="text-center">{{ $index+1 }}</td>
                      <td>
                          Green Chilli German <i class="float-right">kg</i><br>
                          Hari Mirch, ہری مرچ<br>
                          Bags of. 1-2-1-7<br>
                          Total 11 Kg
                      </td>
                  </tr>
                  @endforeach
                </tbody>
            </table>
            <footer>
                <p>
                    Powered By: <strong><i>Zed Developers</i></strong><br>
                    Cell: 0302-2203204, 0316-1126671<br>
                    Web: www.zeddevelopers.com
                </p>
            </footer>
        </div>
        {{-- <script type="text/javascript">
            window.print();
            window.onfocus=function(){ window.close();}
        </script> --}}
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
  /* table th {
  	text-align: left;
    font-size: 15px;
  } */
  table, th, td{
    border-collapse: collapse;
    border: 1px solid #000;
    padding: 2px 4px;
  }
  .tbl-heading th{
    font-size: 12px;
  }
  .tbl-items td{
    font-size: 12px;
  }
  .tbl-items th{
    font-size: 12px;
    font-weight: bold;
  }
  footer p {
    font-size: 11px;
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
