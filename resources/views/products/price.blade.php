@extends('layouts.app_catelogue')
    @section('content')
    <div class="page-content hidden-print">
        @include('layouts.alert')
        <div style="background-color:#FFF">
            <div class="card-body">
                <div id="invoice">
                    <div class="invoice overflow-auto" style="padding-top: 0;">
                        <div>
                            <header style="padding: 0;">
                                <div class="row">
                                    <div class="col">
                                        <img src="{{ asset('assets/attachment/logo.png') }}" width="350" alt="" />
                                    </div>
                                    <div class="col company-details">
                                        <div style="font-size: 28px;"><b>Order now <i class="lni lni-pointer-down"></i></b></div>
                                        <div style="font-size: 20px;"><i class="lni lni-whatsapp"></i> {{ auth()->user()->business->phone }}</div>
                                        <div style="font-size: 20px;"><i class="lni lni-play-store"></i> ROZA.PK</div>
                                        <div style="font-size: 20px;"><i class="lni lni-world"></i> www.ROZA.pk</div>
                                    </div>
                                </div>
                            </header>
                            <main style="padding-bottom: 0;">
                                <div class="row row-cols-6 row-cols-lg-6 row-cols-xl-6">
                                    @foreach($products as $index => $product)
                                    <div class="card-body text-center" style="padding: 0">
                                        <div class="p-1 border radius-15">
                                            <h2 class="mb-1 mt-2 bold">{{ $product->name_ur }}</h2>
                                            <h4 class="mb-0">Rs.{{ $product->sale }}/{{ $product->unit->name }}</h4>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </main>
                            <hr style="margin: 11px 0 0px 0;">
                            <p class="price_header">
                                {{ $catelogue == null ? "Retail Catelogue" : $catelogue }}
                                <small>{{ date("jS M Y",time()) }}</small> <!---  h:i:sA -->
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
