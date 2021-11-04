@extends('layouts.app_catelogue')
    @section('content')
    <div class="page-content">
        @include('layouts.alert')
        <div style="background-color:#FFF">
            <div class="card-body">
                <div id="invoice">
                    <div class="invoice overflow-auto" style="padding-top: 0;">
                        <div>
                            <header>
                                <div class="row">
                                    <div class="col">
                                        <b>{{ auth()->user()->business->name." - ".auth()->user()->business->slogan }}</b>
                                    </div>
                                    <div class="col company-details">
                                        <b>Qty.{{ $products->count() }}, {{ date("jS M Y",time()) }}</b>
                                    </div>
                                </div>
                            </header>
                            <form action="/products/pricing/update" method="POST" enctype="multipart/form-data">
                            @csrf
                                <main style="padding-bottom: 0;">
                                <div class="row row-cols-6 row-cols-lg-6 row-cols-xl-6">
                                    @foreach($products as $index => $product)
                                    <input type="hidden" name="id[]" value="{{ $product->id }}" class="form-control">
                                    <div class="col">
                                        <div class="card radius-15">
                                            <div class="card-body text-center border radius-15" style="padding: 0; {{ $product->is_available == 0 ? "border-color: red !important":"" }}">
                                                <a href="/products/{{ $product->id }}/edit" target="_blank">
                                                    <img src="{{ asset('assets/attachment/product/'.$product->image) }}" width="50" height="50" class="rounded-circle shadow mt-1" alt="{{ $product->category->name }}">
                                                </a>
                                                <b>
                                                    <h5 class="mb-1 mt-1">{{ $product->name_ur }}</h5>
                                                    <p class="mb-0 hidden-view">{{ $product->purchase }}  ___/ {{ $product->unit->name }}</p>
                                                </b>
                                                <input type="number" name="purchase[]" value="{{ $product->purchase }}" class="form-control mb-1 extra_small_field hidden-print" title="Purchase">
                                                <input type="number" name="sale[]" value="{{ $product->sale }}" class="form-control extra_small_field hidden-print" title="Sale">
                                                <input type="number" name="discount[]" value="{{ $product->discount }}" class="form-control extra_small_field hidden-print" title="Discount">
                                                <select name="unit_id[]" class="form-control small_field hidden-print" title="Unit">
                                                    @foreach($units as $unit)
                                                        <option {{ ($product->unit_id == $unit->id) ? 'selected' : '' }} value="{{$unit->id}}">{{ $unit->name }}</option>
                                                    @endforeach
                                                </select>
                                                <select name="is_available[]" class="form-control small_field hidden-print" title="Is Available">
                                                    <option value="1" {{ ($product->is_available == 1 ? "selected":"") }}>Active</option>
                                                    <option value="0" {{ ($product->is_available == 0 ? "selected":"") }}>Inactive</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
        
                                </div>
                            </main>
                            <div class="col-12">
                                <div class="d-grid">
                                    <button type="submit" class="btn btn-success hidden-print">Update Purchase & Selling Price</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
