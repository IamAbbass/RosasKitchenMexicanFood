@extends('layouts.app')

@section('content')
<div class="page-content">
    @include('layouts.alert')
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Users</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-book-content"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Add New Users</li>
                </ol>
            </nav>
        </div>
    </div>
    <!--end breadcrumb-->

    <div class="card">
        <div class="card-body p-4">
            <h5 class="card-title">Add New Users</h5>
            <hr/>
            <div class="form-body mt-4">
                <div class="row">
                    <div class="col-lg-12">
                            <div class="border border-3 p-3 rounded">
                                <form action="/users" method="POST" enctype="multipart/form-data">
                                @csrf
                                    <div class="row g-2">
                                        <div class="col-md-3">
                                            <label class="form-label">Photo</label>
                                            <input readonly type="text" name="image" value="default.png" class="form-control">
                                        </div>
                                        <div class="col-md-3">
                                            <label class="form-label">* Users Name</label>
                                            <input type="text" name="name" value="{{ old('name') }}" class="form-control">
                                        </div>
                                        <div class="col-md-3">
                                            <label class="form-label">* Password</label>
                                            <input type="text" name="password" value="" class="form-control">
                                        </div>
                                        <div class="col-md-3">
                                            <label class="form-label">* Email</label>
                                            <input type="email" name="email" value="{{ old('email') }}" class="form-control">
                                        </div>
                                        <div class="col-md-3">
                                            <label class="form-label">* Phone</label>
                                            <input type="text" name="phone" value="{{ old('phone') }}" class="form-control">
                                        </div>
                                        <div class="col-md-9">
                                            <label class="form-label">Address</label>
                                            <input type="text" name="address" value="{{ old('address') }}" class="form-control">
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
