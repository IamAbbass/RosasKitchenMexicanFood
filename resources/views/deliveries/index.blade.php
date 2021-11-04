@extends('layouts.app')

@section('content')
<div class="page-content">
    @include('layouts.alert')
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Orders</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-cart-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Delivery Charges List</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            <div class="btn-group">
                <a href="{{ URL::to('deliveries/create') }}" class="btn btn-success"><i class="bx bx-plus-circle"></i> Add Delivery</a>
            </div>
        </div>
    </div>

    <!--end breadcrumb-->
    <h6 class="mb-0 text-uppercase">Delivery Charges List</h6>
    <hr/>
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table id="example" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Delivery Name</th>
                            <th>Amount</th>
                            <th>Free Delivery After</th>
                            <th>Is Available</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($deliveries as $index => $delivery)
                        <tr title="{{ $delivery->address }}">
                            <td>{{ $index+1 }}</td>
                            <td>{{ $delivery->name }}</td>
                            <td>{{ number_format($delivery->amount,2) }}</td>
                            <td>{{ number_format($delivery->free_delivery_after,2) }}</td>
                            <td>
                                @if($delivery->is_available == true)
                                    <div class="d-flex align-items-center text-success">
                                        <i class="bx bx-radio-circle-marked bx-rotate-90 align-middle font-18 me-1"></i>
                                        <span>Active</span>
                                    </div>
                                @else
                                    <a href="deliveries/is_available/{{ $delivery->id }}">
                                        <div class="d-flex align-items-center text-danger">
                                            <i class="bx bx-radio-circle-marked bx-rotate-90 align-middle font-18 me-1"></i>
                                            <span>Inactive</span>
                                        </div>
                                    </a>
                                @endif
                            </td>
                            <td>
                                <div class="d-flex order-actions">
                                    {{-- <a href="deliveries/{{ $delivery->id }}" class="" title="View"><i class="bx bx-show"></i></a> --}}
                                    <a href="deliveries/{{ $delivery->id }}/edit" class="ms-2" title="Edit"><i class="bx bxs-edit"></i></a>
                                    {{-- <a href="deliveries/{{ $delivery->id }}" class="ms-2" title="Delete" onclick="event.preventDefault(); document.getElementById('del-form').submit();">
                                        <i class="bx bxs-trash"></i></a>
                                    </a>
                                    <form id="del-form" action="deliveries/{{ $delivery->id }}" method="POST">
                                        @csrf
                                        {{ method_field('DELETE') }}
                                    </form> --}}
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>#</th>
                            <th>Delivery</th>
                            <th>Amount</th>
                            <th>Free Delivery After</th>
                            <th>Is Available</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
