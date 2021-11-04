<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
    <meta name="viewport" content="width=device-width" />
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', false) }}</title>

    <style>
      /* -------------------------------------
          GLOBAL RESETS
      ------------------------------------- */
      
      /*All the styling goes here*/
      
      img {
        border: none;
        -ms-interpolation-mode: bicubic;
        max-width: 100%; 
      }

      body {
        background-color: #f6f6f6;
        font-family: sans-serif;
        -webkit-font-smoothing: antialiased;
        font-size: 14px;
        line-height: 1.4;
        margin: 0;
        padding: 0;
        -ms-text-size-adjust: 100%;
        -webkit-text-size-adjust: 100%; 
      }

      table {
        border-collapse: collapse;
        mso-table-lspace: 0pt;
        mso-table-rspace: 0pt;
        width: 100%; }
        table td {
          font-family: sans-serif;
          font-size: 14px;
          vertical-align: middle; 
      }
      

      /* -------------------------------------
          BODY & CONTAINER
      ------------------------------------- */

      .body {
        background-color: #f6f6f6;
        width: 100%; 
      }

      /* Set a max-width, and make it display as block so it will automatically stretch to that width, but will also shrink down on a phone or something */
      .container {
        display: block;
        margin: 0 auto !important;
        /* makes it centered */
        max-width: 580px;
        padding: 10px;
        width: 580px; 
      }

      /* This should also be a block element, so that it will fill 100% of the .container */
      .content {
        box-sizing: border-box;
        display: block;
        margin: 0 auto;
        max-width: 580px;
        padding: 10px; 
      }

      /* -------------------------------------
          HEADER, FOOTER, MAIN
      ------------------------------------- */
      .main {
        background: #ffffff;
        border-radius: 3px;
        width: 100%; 
      }

      .wrapper {
        box-sizing: border-box;
        padding: 20px; 
      }

      .content-block {
        padding: 0;
      }

      .footer {
        clear: both;
        margin-top: 10px;
        text-align: center;
        width: 100%; 
      }
        .footer td,
        .footer p,
        .footer span,
        .footer a {
          color: #999999;
          font-size: 12px;
          text-align: center; 
      }

      /* -------------------------------------
          TYPOGRAPHY
      ------------------------------------- */
      h1,
      h2,
      h3,
      h4 {
        color: #000000;
        font-family: sans-serif;
        font-weight: bold;
        line-height: 1.4;
        margin: 15px 0 8px 0;
        border-bottom: 1.5px dashed #c1c1c1;; 
      }

      h1 {
        font-size: 35px;
        font-weight: 300;
        text-align: center;
        text-transform: capitalize; 
      }

      p,
      ul,
      ol {
        font-family: sans-serif;
        font-size: 14px;
        font-weight: normal;
        margin: 0;
        margin-bottom: 15px; 
      }
        p li,
        ul li,
        ol li {
          list-style-position: inside;
          margin-left: 5px; 
      }

      a {
        color: #3498db;
        text-decoration: underline; 
      }

      /* -------------------------------------
          BUTTONS
      ------------------------------------- */
      .btn {
        box-sizing: border-box;
        width: 100%; }
        .btn > tbody > tr > td {
          padding-bottom: 15px; }
        .btn table {
          width: auto; 
      }
        .btn table td {
          background-color: #ffffff;
          border-radius: 5px;
          text-align: center; 
      }
        .btn a {
          background-color: #ffffff;
          border: solid 1px #3498db;
          border-radius: 5px;
          box-sizing: border-box;
          color: #3498db;
          cursor: pointer;
          display: inline-block;
          font-size: 14px;
          font-weight: bold;
          margin: 0;
          padding: 12px 25px;
          text-decoration: none;
          text-transform: capitalize; 
      }

      .btn-primary table td {
        background-color: #3498db; 
      }

      .btn-primary a {
        background-color: #3498db;
        border-color: #3498db;
        color: #ffffff; 
      }

      /* -------------------------------------
          OTHER STYLES THAT MIGHT BE USEFUL
      ------------------------------------- */
      .last {
        margin-bottom: 0; 
      }

      .first {
        margin-top: 0; 
      }

      .align-center {
        text-align: center; 
      }

      .align-right {
        text-align: right; 
      }

      .align-left {
        text-align: left; 
      }

      .clear {
        clear: both; 
      }

      .mt0 {
        margin-top: 0; 
      }

      .mb0 {
        margin-bottom: 0; 
      }

      .preheader {
        color: transparent;
        display: none;
        height: 0;
        max-height: 0;
        max-width: 0;
        opacity: 0;
        overflow: hidden;
        mso-hide: all;
        visibility: hidden;
        width: 0; 
      }

      .powered-by, .powered-by a {
        text-decoration: none;
        font-size: smaller;
        font-style: italic;
      }

      hr {
        border: 0;
        border-bottom: 1px solid #f6f6f6;
        margin: 20px 0; 
      }

      /* -------------------------------------
          RESPONSIVE AND MOBILE FRIENDLY STYLES
      ------------------------------------- */
      @media only screen and (max-width: 620px) {
        table[class=body] h1 {
          font-size: 28px !important;
          margin-bottom: 10px !important; 
        }
        table[class=body] p,
        table[class=body] ul,
        table[class=body] ol,
        table[class=body] td,
        table[class=body] span,
        table[class=body] a {
          font-size: 16px !important; 
        }
        table[class=body] .wrapper,
        table[class=body] .article {
          padding: 10px !important; 
        }
        table[class=body] .content {
          padding: 0 !important; 
        }
        table[class=body] .container {
          padding: 0 !important;
          width: 100% !important; 
        }
        table[class=body] .main {
          border-left-width: 0 !important;
          border-radius: 0 !important;
          border-right-width: 0 !important; 
        }
        table[class=body] .btn table {
          width: 100% !important; 
        }
        table[class=body] .btn a {
          width: 100% !important; 
        }
        table[class=body] .img-responsive {
          height: auto !important;
          max-width: 100% !important;
          width: auto !important; 
        }
      }

      /* -------------------------------------
          PRESERVE THESE STYLES IN THE HEAD
      ------------------------------------- */
      @media all {
        .ExternalClass {
          width: 100%; 
        }
        .ExternalClass,
        .ExternalClass p,
        .ExternalClass span,
        .ExternalClass font,
        .ExternalClass td,
        .ExternalClass div {
          line-height: 100%; 
        }
        .apple-link a {
          color: inherit !important;
          font-family: inherit !important;
          font-size: inherit !important;
          font-weight: inherit !important;
          line-height: inherit !important;
          text-decoration: none !important; 
        }
        #MessageViewBody a {
          color: inherit;
          text-decoration: none;
          font-size: inherit;
          font-family: inherit;
          font-weight: inherit;
          line-height: inherit;
        }
        .btn-primary table td:hover {
          background-color: #34495e !important; 
        }
        .btn-primary a:hover {
          background-color: #34495e !important;
          border-color: #34495e !important; 
        } 
      }

    </style>
  </head>
  <body class="">
    <!-- <span class="preheader">This is preheader text. Some clients will show this text as a preview.</span> -->
    <table role="presentation" border="0" cellpadding="0" cellspacing="0" class="body">
      <tr>
        <td>&nbsp;</td>
        <td class="container">
          <div class="content">

            <!-- START CENTERED WHITE CONTAINER -->
            <table role="presentation" class="main">

              <!-- START MAIN CONTENT AREA -->
              <tr>
                <td class="wrapper">
                  <table role="presentation" border="0" cellpadding="0" cellspacing="0">
                    <tr>
                      <td>
                        <img src="{{ config('app.url', false) }}/assets/attachment/logo.png" alt="{{ config('app.name', false) }}" />
                        <hr>
                        <p><strong>Hi {{ $order->name }},</strong></p>
                        <p>We're excited for you to receive your order <strong>{{ $order->order_no }}</strong><br>
                        We'll notify you once it's on its way, hope you had a great shopping experience!</p>
                        <p>Here's a confirmation of what you bought in your order.</p>

                        <!-- Delivery Detail -->
                        <h3>Delivery Detail</h3>
                        <table cellspacing="0" cellpadding="0">
                            <tr>
                                <th align="left">Name:</th>
                                <th align="left">{{ $order->name }}</th>
                            </tr>
                            <tr>
                                <th align="left">Phone:</th>
                                <th align="left">{{ $order->phone }}</th>
                            </tr>
                            <tr>
                                <th align="left">Email:</th>
                                <th align="left">{{ $order->email }}</th>
                            </tr>
                            <tr>
                                <th align="left">Address:</th>
                                <th align="left">{{ $order->address }}</th>
                            </tr>
                            <tr>
                                @if ($order->delivery == null)
                                    <th align="left">Delivery Fee:</th>
                                    <th align="left">Free</th>
                                @else
                                    <th align="left">{{ $order->delivery->name }}:</th>
                                    <th align="left">{{ $order->delivery->amount }}</th>
                                @endif
                            </tr>
                            <tr>
                                <th align="left">Order Amount:</th>
                                @if ( $order->delivery != null)
                                    <th align="left">{{ round($order->details->sum('total') + $order->delivery->amount) }} - {{ $order->payment_method }}</th>
                                @else
                                    <th align="left">{{ round($order->details->sum('total')) }} - {{ $order->payment_method }}</th>
                                @endif
                            </tr>
                            <tr>
                                <th align="left" colspan="2"><small>Please note, we are unable to change your order details once your order is placed.</small></th>
                            </tr>
                        </table>

                        <!-- Order Detail -->
                        <h3>Order Detail</h3>
                        <table class="table table-striped table-bordered">
                            <!-- <thead>
                                <tr>
                                    <th align="left">Product</th>
                                    <th align="left">Description</th>
                                    <th align="left">Amount</th>
                                </tr>
                            </thead> -->
                            <tbody>
                                @foreach($order->details as $index => $order_detail)
                                <tr style="border-bottom: 1px solid #c1c1c1;">
                                    <th align="left">
                                        <img src="{{ asset('assets/attachment/product/'.$order_detail->product->image) }}" class="rounded-circle" width="60" height="60" alt="{{ $order_detail->name }}"><br>
                                    </th>
                                    <th align="left">
                                        {{ $order_detail->quantity }} x {{ $order_detail->product->sku }}<br>
                                        {{ $order_detail->product->name }} ({{ $order_detail->product->name_ru }} - {{ $order_detail->product->name_ur }})
                                    </th>
                                    <th align="right">{{ $order_detail->total }}</th>
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    @if ($order->delivery == null)
                                        <th colspan="2" align="right">Delivery Fee</th>
                                        <th align="right">Free</th>
                                    @else
                                        <th colspan="2" align="right">{{ $order->delivery->name }}</th>
                                        <th align="right">{{ $order->delivery->amount }}</th>
                                    @endif
                                </tr>
                                <tr>
                                    <th colspan="2" align="right">Order Amount</th>
                                    <th align="right">
                                        @if ($order->delivery == null)
                                            {{ round($order->details->sum('total')) }}
                                        @else
                                            {{ round($order->details->sum('total') + $order->delivery->amount) }}
                                        @endif
                                    </th>
                                </tr>
                            </tfoot>
                        </table>

                        </br></br>
                        <p>Thank you for ordering from {{ config('app.name', false) }}</br>
                            <span style="font-style: italic;color: #999999;font-size: 11px;">
                                {{ config('app.name', false) }} - Sales
                            </span>
                        </p>
                      </td>
                    </tr>
                  </table>
                </td>
              </tr>

            <!-- END MAIN CONTENT AREA -->
            </table>
            <!-- END CENTERED WHITE CONTAINER -->

            <!-- START FOOTER -->
            <div class="footer">
              <table role="presentation" border="0" cellpadding="0" cellspacing="0">
                <tr>
                  <td class="content-block">
                    <span class="apple-link">
                        {{ config('app.name', false) }} - {{ config('app.slogan', false) }}<br>
                        {{ auth()->user()->business->phone }}, {{ config('app.ROZA_phone_style', false) }}
                    </span>
                  </td>
                </tr>
                <tr>
                  <td class="content-block powered-by">
                    Powered by: <a href="http://zeddevelopers.com">Zed Developers</a>
                  </td>
                </tr>
              </table>
            </div>
            <!-- END FOOTER -->
          </div>
        </td>
        <td>&nbsp;</td>
      </tr>
    </table>
  </body>
</html>
