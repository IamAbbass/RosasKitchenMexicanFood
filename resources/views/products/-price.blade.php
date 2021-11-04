@extends('layouts.app_catelogue')
    @section('content')
    <div class="page-content hidden-print">
        @include('layouts.alert')
        <div style="background-color:#FFF">
            <div class="card-body">
                <div id="invoice">
                    <div class="invoice overflow-auto" style="padding-top: 0;">
                        <div>
                            <h3 class="price_header">
                                <a href="{{ auth()->user()->business->website }}">
                                    {{ $catelogue == null ? "Retail Catelogue" : $catelogue }}
                                    <small>{{ date("jS M Y",time()) }}</small> <!---  h:i:sA -->
                                </a>
                            </h3>

                            <header style="padding: 0;">
                                <div class="row">
                                    <div class="col">
                                        <img src="{{ asset('assets/attachment/logo.png') }}" width="300" alt="" />
                                    </div>
                                    <div class="col company-details">
                                        <div style="font-size: 20px;"><b>Order now <i class="lni lni-pointer-down"></i></b></div>
                                        <div style="font-size: 17px;"><i class="lni lni-whatsapp"></i> <a href="https://bit.ly/sabzify-wa" target="_blank">{{ auth()->user()->business->phone }}</a></div>
                                        <div style="font-size: 17px;"><i class="lni lni-play-store"></i> <a href="https://play.google.com/store/apps/details?id=com.zed.sabzify" target="_blank">SABZIFY App.</a></div>
                                        <div style="font-size: 17px;"><i class="lni lni-world"></i> <a href="{{ auth()->user()->business->website }}" target="_blank">{{ auth()->user()->business->name }}</a></div>
                                    </div>
                                </div>
                            </header>
                            <main style="padding-bottom: 0;">
                                <div class="row row-cols-5 row-cols-lg-5 row-cols-xl-5">
                                    @foreach($products as $index => $product)
                                    <div class="col">
                                        <div class="card radius-15">
                                            <div class="card-body text-center" style="padding: 0">
                                                <div class="p-1 border radius-15">
                                                    <!-- <p class="mb-1 mt-0"><strong>{{ $product->sku }}</strong></p> -->
                                                    <img src="{{ asset('assets/attachment/product/'.$product->image) }}" width="50" height="50" class="rounded-circle shadow" alt="{{ $product->category->name }}">
                                                    <b>
                                                        <h4 class="mb-1 mt-2">{{ $product->name_ur }}</h4>
                                                        <!-- {!! $product->discount <= 0 ? "" : "<p class='mb-0'>Save Rs.".$product->discount."/".$product->unit->name." </p>" !!} -->
                                                        <p class="mb-0">Rs.{{ $product->sale }}/{{ $product->unit->name }}</p>
                                                    </b>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </main>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
