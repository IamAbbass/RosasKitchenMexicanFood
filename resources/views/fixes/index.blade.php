@extends('layouts.app')

@section('content')
<div class="page-content">
    @include('layouts.alert')
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Assets</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="lni lni-bricks"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Assets List</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            <div class="btn-group">
                <a href="{{ URL::to('fixes/create') }}" class="btn btn-success"><i class="bx bx-plus-circle"></i> Add Assets</a>
            </div>
        </div>
    </div>

    <!--end breadcrumb-->
    <h6 class="mb-0 text-uppercase">Assets List</h6>
    <hr/>
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table id="example" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Account</th>
                            <th>Title</th>
                            <th>Date & Amount</th>
                            <th>Description</th>
                            <th>Is Available</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($fixes as $index => $fix)
                        <tr title="{{ $fix->address }}">
                            <td>{{ $index+1 }}</td>
                            <td>{{ $fix->account->title }}</td>
                            <td>{{ $fix->title }}</td>
                            <td>dt. {{ date("d-m-Y", strtotime($fix->date)) }}<br>{{ number_format($fix->amount,2) }}</td>
                            <td>{{ $fix->description }}</td>
                            <td>
                                @if($fix->is_available == true)
                                    <a href="fixes/is_available/{{ $fix->id }}">
                                        <div class="d-flex align-items-center text-success">
                                            <i class="bx bx-radio-circle-marked bx-rotate-90 align-middle font-18 me-1"></i>
                                            <span>Active</span>
                                        </div>
                                    </a>
                                @else
                                    <a href="fixes/is_available/{{ $fix->id }}">
                                        <div class="d-flex align-items-center text-danger">
                                            <i class="bx bx-radio-circle-marked bx-rotate-90 align-middle font-18 me-1"></i>
                                            <span>Inactive</span>
                                        </div>
                                    </a>
                                @endif
                            </td>
                            <td>
                                <div class="d-flex order-actions">
                                    <a href="fixes/{{ $fix->id }}" class="" title="View"><i class="bx bx-show"></i></a>
                                    <a href="fixes/{{ $fix->id }}/edit" class="ms-2" title="Edit"><i class="bx bxs-edit"></i></a>
                                    <a href="fixes/{{ $fix->id }}" class="ms-2" title="Delete" onclick="event.preventDefault(); document.getElementById('del-form').submit();">
                                        <i class="bx bxs-trash"></i></a>
                                    </a>
                                    <form id="del-form" action="fixes/{{ $fix->id }}" method="POST">
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
                            <th>Account</th>
                            <th>Title</th>
                            <th>Date & Amount</th>
                            <th>Description</th>
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