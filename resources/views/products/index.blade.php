@extends('layouts.app')

@section('content')
<div class="page-content">
    @include('layouts.alert')
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Products</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-box"></i></a></li>
                    <li class="breadcrumb-item active" aria-current="page">Product List</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            <div class="btn-group">
                <a href="{{ URL::to('products/create') }}" class="btn btn-success"><i class="bx bx-plus-circle"></i> Add Product</a>
            </div>
        </div>
    </div>

    <!--end breadcrumb-->
    <h6 class="mb-0 text-uppercase">Products List</h6>
    <hr/>
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table id="example" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Photo</th>
                            <th>Product</th>
                            <th>Purchase</th>
                            <th>Sale</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($products as $index => $product)
                        <tr title="{{ $product->note }}">
                            <td>{{ $index+1 }}</td>
                            <td class="text-center">
                                <a href="products/{{ $product->id }}/edit">
                                    <img src="{{ asset('assets/attachment/product/'.$product->image) }}" class="rounded-circle" width="75" height="75" alt="{{ $product->category->name }}">
                                </a><br>
                                {{ $product->category->name }}
                            </td>
                            <td>
                                <kbd>SKU: {{ $product->sku }}/{{$product->id }}</kbd><br>
                                Type: {{ $product->type == null ? "Default" : $product->type }}<br>
                                Badge: {{ $product->badge == null ? "Default" : $product->badge->name }}<br>
                                Name: {{ $product->name }},<br>{{ $product->name_ru }}, {{ $product->name_ur }}
                            </td>
                            <td>
                                {{ $product->account->title }} - {{ $product->account->type }} ({{ date("d/m/Y", $product->dated) }})<br>
                                {{ $product->supplier->name }} - {{ $product->supplier->business_name }}<br>
                                PKR {{ number_format($product->purchase, 2) }}<br>
                                Qty. {{ $product->purchased_qty."/".$product->unit->name }}
                            </td>
                            <td>
                                Unit: {{ $product->unit->name }}<br>
                                Profit: PKR {{ number_format($product->sale - $product->purchase, 2) }}/{{ $product->unit->name }}
                                <hr style="margin: 0.2rem 0 !important">
                               <kbd>Sale: PKR {{ number_format($product->sale, 2) }}</kbd>
                            </td>
                            <td>
                                By: {{ $product->user->name }}<br>
                                at: {{ Carbon\Carbon::parse(date("Y-m-d h:i:sa",$product->dated))->diffForHumans() }}
                                <hr style="margin: 0.2rem 0 !important">
                                @if($product->is_highlight == true)
                                    <a href="products/is_highlight/{{ $product->id }}">
                                        <div class="d-flex align-items-center text-success">
                                            <i class="bx bx-radio-circle-marked bx-rotate-90 align-middle font-18 me-1"></i>
                                            <span>Highlighted</span>
                                        </div>
                                    </a>
                                @else
                                    <a href="products/is_highlight/{{ $product->id }}">
                                        <div class="d-flex align-items-center text-danger">
                                            <i class="bx bx-radio-circle-marked bx-rotate-90 align-middle font-18 me-1"></i>
                                            <span>Click to highlight</span>
                                        </div>
                                    </a>
                                @endif

                                @if($product->is_available == true)
                                    <a href="products/is_available/{{ $product->id }}">
                                        <div class="d-flex align-items-center text-success">
                                            <i class="bx bx-radio-circle-marked bx-rotate-90 align-middle font-18 me-1"></i>
                                            <span>Active</span>
                                        </div>
                                    </a>
                                @else
                                    <a href="products/is_available/{{ $product->id }}">
                                        <div class="d-flex align-items-center text-danger">
                                            <i class="bx bx-radio-circle-marked bx-rotate-90 align-middle font-18 me-1"></i>
                                            <span>Inactive</span>
                                        </div>
                                    </a>
                                @endif
                                <hr style="margin: 0.2rem 0 !important">
                                <div class="d-flex order-actions">
                                    <a href="products/{{ $product->id }}" class="" title="View"><i class="bx bx-show"></i></a>
                                    <a href="products/{{ $product->id }}/edit" class="ms-2" title="Edit"><i class="bx bxs-edit"></i></a>
                                    <a href="products/{{ $product->id }}" class="ms-2" title="Delete" onclick="event.preventDefault(); document.getElementById('del-form').submit();">
                                        <i class="bx bxs-trash"></i></a>
                                    </a>
                                    <form id="del-form" action="products/{{ $product->id }}" method="POST">
                                        @csrf
                                        {{ method_field('DELETE') }}
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>#</th>
                            <th>Photo</th>
                            <th>Product</th>
                            <th>Purchase</th>
                            <th>Sale</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
