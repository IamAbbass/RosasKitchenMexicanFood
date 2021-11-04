@extends('layouts.app')

@section('title', $product->name.", ".$product->name_ru.", ".$product->name_ur)
@section('content')
<div class="page-content">
    @include('layouts.alert')
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Products</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-box"></i></a></li>
                    <li class="breadcrumb-item active" aria-current="page">Edit Products</li>
                </ol>
            </nav>
        </div>
    </div>
    <!--end breadcrumb-->

    <div class="card">
        <div class="card-body p-4">
            <h5 class="card-title">Edit Products</h5>
            <hr/>
            <div class="form-body mt-3">
                <form action="/products/{{ $product->id }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PATCH')
                <div class="row">
                    <div class="col-lg-12 mb-3">
                        <div class="border border-3 p-3 rounded">
                            <div class="row g-2">
                                <div class="col-md-2">
                                    <label class="form-label">SKU</label>
                                    <input type="text" name="sku" value="{{ $product->sku }}" readonly class="form-control">
                                </div>
                                <div class="col-md-2">
                                    <label class="form-label">Product Photo</label>
                                    <input type="file" name="image" value="{{ $product->image }}" class="form-control">
                                    <input type="hidden" name="old_image" value="{{ $product->image }}">
                                </div>
                                <div class="col-md-2">
                                    <label class="form-label">* Name</label>
                                    <input type="text" name="name" value="{{ $product->name }}" class="form-control">
                                </div>
                                <div class="col-md-2">
                                    <label class="form-label">* Name (ru)</label>
                                    <input type="text" name="name_ru" value="{{ $product->name_ru }}" class="form-control">
                                </div>
                                <div class="col-md-2">
                                    <label class="form-label">* Name (ur)</label>
                                    <input type="text" name="name_ur" value="{{ $product->name_ur }}" class="form-control">
                                </div>
                                <div class="col-md-2">
                                    <label class="form-label">* Category</label>
                                    <select class="form-select" name="category_id">
                                        <option value="">Select Category</option>
                                        @foreach($categories as $index => $category)
                                            <option value="{{ $category->id }}" {{ ($product->category_id == $category->id ? "selected":"") }}>{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <label class="form-label">Type</label>
                                    <select class="form-select" name="type">
                                        <option value="" {{ ($product->type == null ? "selected":"") }}>Default</option>
                                        <option value="China" {{ ($product->type == "China" ? "selected":"") }}>China</option>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label">Badge</label>
                                    <select class="form-select" name="badge_id">
                                        <option value="">Default</option>
                                        @foreach($badges as $index => $badge)
                                            <option value="{{ $badge->id }}" {{ ($product->badge_id == $badge->id ? "selected":"") }}>{{ $badge->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <label class="form-label">* Sale Unit</label>
                                    <select class="form-select" name="unit_id">
                                        <option value="">Select Unit</option>
                                        @foreach($units as $index => $unit)
                                            <option value="{{ $unit->id }}" {{ ($product->unit_id == $unit->id ? "selected":"") }}>{{ $unit->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <label class="form-label">* Sale Price</label>
                                    <input type="number" name="sale" value="{{ $product->sale }}" class="form-control" step=".01">
                                </div>
                                <div class="col-md-2">
                                    <label class="form-label">* Discount</label>
                                    <input type="number" name="discount" value="{{ $product->discount }}" class="form-control" step=".01">
                                </div>
                                <div class="col-md-1">
                                    <label class="form-label">Profit</label>
                                    <input type="text" name="profit" value="0%" class="form-control" readonly>
                                </div>
                                <div class="col-md-5">
                                    <label class="form-label">* Supplier</label>
                                    <select class="form-select" name="supplier_id">
                                        <option value="">Select Supplier</option>
                                        @foreach($suppliers as $index => $supplier)
                                            <option value="{{ $supplier->id }}" {{ ($product->supplier_id == $supplier->id ? "selected":"") }}>{{ $supplier->name }} - {{ $supplier->business_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label">* Account</label>
                                    <select class="form-select" name="account_id">
                                    <option value="">Select Account</option>
                                        @foreach($accounts as $index => $account)
                                            <option value="{{ $account->id }}" {{ ($product->account_id == $account->id ? "selected":"") }}>{{ $account->title }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <label class="form-label">Highlighted</label>
                                    <select class="form-select" name="is_highlight" style="{{ ($product->is_highlight == 0) ? 'border: 1px solid #fd7e14' : 'border: 1px solid #785380' }}">
                                        <option value="1" {{ ($product->is_highlight == 1 ? "selected":"") }}>Yes</option>
                                        <option value="0" {{ ($product->is_highlight == 0 ? "selected":"") }}>No</option>
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <label class="form-label">Is Available</label>
                                    <select class="form-select" name="is_available" style="{{ ($product->is_available == 0) ? 'border: 1px solid #f41127' : 'border: 1px solid #785380' }}">
                                        <option value="1" {{ ($product->is_available == 1 ? "selected":"") }}>Active</option>
                                        <option value="0" {{ ($product->is_available == 0 ? "selected":"") }}>Inactive</option>
                                    </select>
                                </div>
                                <div class="col-md-12">
                                    <div class="input-group">
                                        <span class="input-group-text">
                                            <img src="{{ asset('assets/attachment/product/'.$product->image) }}" class="rounded-circle" width="100" height="100" alt="{{ $product->sku }}">
                                        </span>
                                        <textarea class="form-control" name="description" rows="1">{{ $product->description }}</textarea>
                                    </div>
                                </div>

                                <div class="col-md-2" {{ $transaction->debit > 0 ? "hidden":"" }}>
                                    <label class="form-label">* Purchase Price</label>
                                    <input type="number" name="purchase" value="{{ $product->purchase }}" class="form-control" step=".01">
                                </div>
                                <div class="col-md-2" {{ $transaction->debit > 0 ? "hidden":"" }}>
                                    <label class="form-label">* Purchased Quantity</label>
                                    <input type="number" name="purchased_qty" value="{{ $product->purchased_qty }}" class="form-control" step=".01">
                                </div>
                                <div class="col-md-2" {{ $transaction->debit > 0 ? "hidden":"" }}>
                                    <label class="form-label">* Purchased Unit</label>
                                    <select class="form-select" name="purchased_unit">
                                        <option value="">Select Unit</option>
                                        @foreach($units as $index => $unit)
                                            <option value="{{ $unit->id }}" {{ ($product->purchased_unit == $unit->id ? "selected":"") }}>{{ $unit->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Note</label>
                                    <textarea class="form-control" name="note" rows="1">{{ $product->note }}</textarea>
                                </div>

                                <div class="col-md-10 mt-4">
                                    <div class="form-check form-switch">
                                        <input style="width: 5em; height: 2em" class="form-check-input" type="checkbox" name="edit_next" value="{{ $product->id + 1 }}" {{ Session::get('EDIT-NEXT') }}>
                                        <label  style="padding-left: 5px; font-size:16px; font-weight:bold" class="form-check-label mt-2"> Auto edit next?</label>
                                    </div>
                                </div>

                                <div class="col-2 mt-4">
                                    <div class="d-grid">
                                        <button type="submit" class="btn btn-success">Save</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!--end row-->
            </div>
        </div>
    </div>
</div
@endsection
