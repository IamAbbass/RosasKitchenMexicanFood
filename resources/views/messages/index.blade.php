@extends('layouts.app')

@section('content')
<div class="page-content">
    @include('layouts.alert')
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Order Message</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-message-square-detail"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Order Message List</li>
                </ol>
            </nav>
        </div>
        <!-- <div class="ms-auto">
            <div class="btn-group">
                <a href="{{ URL::to('messages/create') }}" class="btn btn-success"><i class="bx bx-plus-circle"></i> Add Order Message</a>
            </div>
        </div> -->
    </div>

    <!--end breadcrumb-->
    <h6 class="mb-0 text-uppercase">Order Message List</h6>
    <hr/>
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table id="example" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Type</th>
                            <th>Status</th>
                            <th>Message</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($messages as $index => $message)
                        <tr>
                            <td>{{ $index+1 }}</td>
                            <td>{{ $message->type }}</td>
                            <td>{{ $message->status }}</td>
                            <td>{{ $message->message }}</td>
                            <td>
                                <div class="d-flex order-actions">
                                    <a href="messages/{{ $message->id }}/edit" class="ms-2" title="Edit"><i class="bx bxs-edit"></i></a>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>#</th>
                            <th>Type</th>
                            <th>Status</th>
                            <th>Message</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
