@extends('layouts.app_catelogue')
    @section('content')
    <div class="page-content">
        @include('layouts.alert')
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3 hidden-print">
            <div class="breadcrumb-title pe-3">Marketing</div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-radar"></i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">{{ $catelogue == null ? "Retail Catelogue" : $catelogue }}</li>
                        </ol>
                    </nav>
                </div>
                <div class="ms-auto">
                    <div class="text-end">
                            <button type="button" class="btn btn-secondary px-2" onclick="window.print(); return false;"><i class="bx bx-printer"></i> Print</button>
                            <!-- <button type="button" class="btn btn-secondary px-2"><i class="bx bx-download"></i> Save as PDF</button> -->
                            <a href="/share/catalogue" target="_blank" class="btn btn-secondary px-2"><i class="bx bx-share-alt"></i> Share</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--end breadcrumb-->
        <div style="background-color:#FFF">
            <div class="card-body">
                <div id="invoice">
                    <div class="invoice overflow-auto" style="padding-top: 0;">
                        <div>
                            <header>
                                <div class="row">
                                    <div class="col">
                                        <img src="{{ asset('assets/attachment/business/'.auth()->user()->business->image) }}" width="400" alt="" />
                                    </div>
                                    <div class="col company-details">
                                        <h3 class="name">
                                            <a href="{{ auth()->user()->business->website }}">
                                                <small>
                                                    {{ $catelogue == null ? "Retail Catelogue" : $catelogue }}</br>
                                                    <small>{{ date("jS M Y",time()) }}</small> <!---  h:i:sA -->
                                                </small>
                                            </a>
                                        </h3>
                                        <div style="font-size: 16px;"><b>Order now <i class="lni lni-pointer-down"></i></b></div>
                                        <div style="font-size: 14px;"><i class="lni lni-whatsapp"></i> <a href="https://bit.ly/ROZA-wa" target="_blank">{{ auth()->user()->business->phone }}</a></div>
                                        <div style="font-size: 14px;"><i class="lni lni-play-store"></i> <a href="https://play.google.com/store/apps/details?id=com.zed.ROZA" target="_blank">ROZA App.</a></div>
                                        <div style="font-size: 14px;"><i class="lni lni-world"></i> <a href="{{ auth()->user()->business->website }}" target="_blank">{{ auth()->user()->business->name }}</a></div>
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
