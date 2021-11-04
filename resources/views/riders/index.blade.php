@extends('layouts.app')

@section('content')
<div class="page-content">
    @include('layouts.alert')
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Contacts</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-book-content"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Riders</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            <div class="btn-group">
                <a href="{{ URL::to('riders/create') }}" class="btn btn-success"><i class="bx bx-plus-circle"></i> Add Rider</a>
            </div>
        </div>
    </div>

    <!--end breadcrumb-->
    <h6 class="mb-0 text-uppercase">Riders List</h6>
    <hr/>
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table id="example" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Photo</th>
                            <th>Rider Details</th>
                            <th>Address</th>
                            <th>Is Available</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($riders as $index => $rider)
                        <tr title="{{ $rider->address }}">
                            <td>{{ $index+1 }}</td>
                            <td>{{ $rider->image }}</td>
                            <td>{{ $rider->name }}<br>{{ $rider->cnic }}<br>{{ $rider->phone }}<br>{{ $rider->email }}</td>
                            <td>{{ $rider->address }}</td>
                            <td>
                                @if($rider->is_available == true)
                                    <a href="rider/is_available/{{ $rider->id }}">
                                        <div class="d-flex align-items-center text-success">
                                            <i class="bx bx-radio-circle-marked bx-rotate-90 align-middle font-18 me-1"></i>
                                            <span>Active</span>
                                        </div>
                                    </a>
                                @else
                                    <a href="rider/is_available/{{ $rider->id }}">
                                        <div class="d-flex align-items-center text-danger">
                                            <i class="bx bx-radio-circle-marked bx-rotate-90 align-middle font-18 me-1"></i>
                                            <span>Inactive</span>
                                        </div>
                                    </a>
                                @endif
                            </td>
                            <td>
                                <div class="d-flex order-actions">
                                    <a href="riders/{{ $rider->id }}" class="" title="View"><i class="bx bx-show"></i></a>
                                    <a href="riders/{{ $rider->id }}/edit" class="ms-2" title="Edit"><i class="bx bxs-edit"></i></a>
                                    <a href="riders/{{ $rider->id }}" class="ms-2" title="Delete" onclick="event.preventDefault(); document.getElementById('del-form').submit();">
                                        <i class="bx bxs-trash"></i></a>
                                    </a>
                                    <form id="del-form" action="riders/{{ $rider->id }}" method="POST">
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
                            <th>Rider Details</th>
                            <th>Address</th>
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
