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
                    <li class="breadcrumb-item active" aria-current="page">Edit Message</li>
                </ol>
            </nav>
        </div>
    </div>
    <!--end breadcrumb-->

    <div class="card">
        <div class="card-body p-4">
            <h5 class="card-title">Edit Message</h5>
            <hr/>
            <div class="form-body mt-4">
                <div class="row">
                    <div class="col-lg-12">
                            <div class="border border-3 p-3 rounded">
                                <form action="/messages/{{ $message->id }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PATCH')
                                    <div class="row g-2">
                                        <div class="col-md-2">
                                            <label class="form-label">Type</label>
                                            <input type="text" value="{{ $message->type }}" readonly class="form-control">
                                        </div>
                                        <div class="col-md-2">
                                            <label class="form-label">Status</label>
                                            <input type="text" value="{{ $message->status }}" readonly class="form-control">
                                        </div>
                                        <div class="col-md-12">
                                            <div class="input-group"> <span class="input-group-text">Message</span>
                                                <textarea class="form-control" name="message" rows="1" aria-label="With textarea">{{ $message->message }}</textarea>
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
