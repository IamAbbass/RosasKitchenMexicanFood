@extends('layouts.app')

@section('content')
<div class="page-content">
    @include('layouts.alert')
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Riders</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-book-content"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Edit Rider</li>
                </ol>
            </nav>
        </div>
    </div>
    <!--end breadcrumb-->

    <div class="card">
        <div class="card-body p-4">
            <h5 class="card-title">Edit Rider</h5>
            <hr/>
            <div class="form-body mt-4">
                <div class="row">
                    <div class="col-lg-12">
                            <div class="border border-3 p-3 rounded">
                                <form action="/riders/{{ $rider->id }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PATCH')
                                    <div class="row g-2">
                                    <div class="col-md-3">
                                            <label class="form-label">Photo</label>
                                            <input type="text" name="image" value="{{ $rider->image }}" autofocus class="form-control">
                                        </div>
                                        <div class="col-md-3">
                                            <label class="form-label">* Name</label>
                                            <input type="text" name="name" value="{{ $rider->name }}" class="form-control">
                                        </div>
                                        <div class="col-md-2">
                                            <label class="form-label">* CNIC</label>
                                            <input type="text" name="cnic" value="{{ $rider->cnic }}" class="form-control">
                                        </div>
                                        <div class="col-md-2">
                                            <label class="form-label">* Phone</label>
                                            <input type="text" name="phone" value="{{ $rider->phone }}" class="form-control">
                                        </div>
                                        <div class="col-md-2">
                                            <label class="form-label">Email</label>
                                            <input type="email" name="email" value="{{ $rider->email }}" class="form-control">
                                        </div>
                                        <div class="col-md-12">
                                            <label class="form-label">* Address</label>
                                            <input type="text" name="address" value="{{ $rider->address }}" class="form-control">
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
