@extends('layouts.app')

@section('content')
<div class="page-content">
    @include('layouts.alert')
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Orders</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-cart"></i></a></li>
                    <li class="breadcrumb-item active" aria-current="page">Add Order</li>
                </ol>
            </nav>
        </div>
    </div>
    <!--end breadcrumb-->

    <div class="card">
        <div class="card-body p-4">
            <h5 class="card-title">Add Order</h5>
            <hr/>
            <div class="form-body mt-3">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="border border-3 p-3 rounded">
                            <form action="/orders" method="POST" enctype="multipart/form-data">
                            @csrf
                                <div class="row g-2">
                                    <div class="col-md-2">
                                        <label class="form-label">* SKU</label>
                                        <input type="text" name="sku" value="SBZ0000{{ $sku+1 }}" readonly class="form-control">
                                    </div>
                                    <div class="col-md-2">
                                        <label class="form-label">Order Photo</label>
                                        <input type="file" name="image" value="{{ old('image') }}" class="form-control">
                                    </div>
                                    <div class="col-md-2">
                                        <label class="form-label">* Name</label>
                                        <input type="text" name="name" value="{{ old('name') }}" class="form-control">
                                    </div>
                                    <div class="col-md-2">
                                        <label class="form-label">* Name (ru)</label>
                                        <input type="text" name="name_ru" value="{{ old('name_ru') }}" class="form-control">
                                    </div>
                                    <div class="col-md-2">
                                        <label class="form-label">* Name (ur)</label>
                                        <input type="text" name="name_ur" value="{{ old('name_ur') }}" class="form-control">
                                    </div>
                                    <div class="col-md-2">
                                        <label class="form-label">* Type</label>
                                        <select class="form-select" name="type">
                                            <option value="Local" {{ (old("type") == "Local" ? "selected":"") }}>Local</option>
                                            <option value="China" {{ (old("type") == "China" ? "selected":"") }}>China</option>
                                        </select>
                                    </div>
                                    <div class="col-md-2">
                                        <label class="form-label">* Category</label>
                                        <select class="form-select" name="category_id">
                                            <option value="">Select Category</option>
                                            @foreach($categories as $index => $category)
                                                <option value="{{ $category->id }}" {{ (old("category") == $category->id ? "selected":"") }}>{{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-2">
                                        <label class="form-label">* Selling Unit</label>
                                        <select class="form-select" name="unit_id">
                                            <option value="">Select Selling Unit</option>
                                            @foreach($units as $index => $unit)
                                                <option value="{{ $unit->id }}" {{ (old("unit") == $unit->id ? "selected":"") }}>{{ $unit->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <label class="form-label">* Supplier</label>
                                        <select class="form-select" name="supplier_id">
                                            <option value="">Select Supplier</option>
                                            @foreach($suppliers as $index => $supplier)
                                                <option value="{{ $supplier->id }}" {{ (old("supplier_id") == $supplier->id ? "selected":"") }}>{{ $supplier->name }} - {{ $supplier->business_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <label class="form-label">* Account</label>
                                        <select class="form-select" name="account_id">
                                        <option value="">Select Account</option>
                                            @foreach($accounts as $index => $account)
                                                <option value="{{ $account->id }}" {{ (old("account_id") == $account->id ? "selected":"") }}>{{ $account->title }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-2">
                                        <label class="form-label">* Badge</label>
                                        <select class="form-select" name="badge_id">
                                            <option value="">Select Badge</option>
                                            @foreach($badges as $index => $badge)
                                                <option value="{{ $badge->id }}" {{ (old("badge_id") == $badge->id ? "selected":"") }}>{{ $badge->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <hr>
                                    <div class="col-md-2">
                                        <label class="form-label">* Purchase Price</label>
                                        <input type="number" name="purchase" value="{{ old('purchase', '0') }}" class="form-control">
                                    </div>
                                    <div class="col-md-2">
                                        <label class="form-label">* Purchased Quantity</label>
                                        <input type="number" name="purchased_qty" value="{{ old('quantity', '0') }}" class="form-control">
                                    </div>
                                    <div class="col-md-2">
                                        <label class="form-label">* Purchased Unit</label>
                                        <select class="form-select" name="purchased_unit">
                                            <option value="">Select Purchased Unit</option>
                                            @foreach($units as $index => $unit)
                                                <option value="{{ $unit->id }}" {{ (old("purchased_unit") == $unit->id ? "selected":"") }}>{{ $unit->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-2">
                                        <label class="form-label">* Sale Price</label>
                                        <input type="number" name="sale" value="{{ old('sale',0) }}" class="form-control">
                                    </div>
                                    <div class="col-md-2">
                                        <label class="form-label">* Discount</label>
                                        <input type="number" name="discount" value="{{ old('discount', '0') }}" class="form-control">
                                    </div>
                                    <div class="col-md-1">
                                        <label class="form-label">Profit</label>
                                        <input type="text" name="profit" value="0%" class="form-control" readonly>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="input-group"> <span class="input-group-text">Description</span>
                                            <textarea class="form-control" name="description" rows="2" aria-label="With textarea"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="input-group"> <span class="input-group-text">Note</span>
                                            <textarea class="form-control" name="note" rows="2" aria-label="With textarea"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-2 mt-4">
                                        <div class="d-grid">
                                            <button type="submit" class="btn btn-success">Save</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div><!--end row-->
            </div>
        </div>
    </div>
</div
@endsection
