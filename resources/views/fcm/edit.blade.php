@extends('layouts.app')

@section('content')
<div class="page-content">
    @include('layouts.alert')
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Marketing</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-radar"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">FCM Marketing (Proofreading)</li>
                </ol>
            </nav>
        </div>
    </div>
    <!--end breadcrumb-->

    <div class="card">
        <div class="card-body p-4">
            <h5 class="card-title">FCM Marketing (Proofreading)</h5>
            <hr/>
            <div class="form-body mt-4">
                <div class="row">
                    <div class="col-lg-12">
                            <div class="border border-3 p-3 rounded">
                                <form action="/fcm/{{ $fcm->id }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PATCH')
                                    <div class="row g-2">
                                        <div class="col-md-5">
                                            <label class="form-label">* Title</label>
                                            <input class="form-control" type="text" name="title" value="{{ $fcm->title }}">
                                        </div>
                                        <div class="col-md-7">
                                            <label class="form-label">* Description</label>
                                            <input class="form-control" type="text" name="description" value="{{ $fcm->description }}">
                                        </div>
                                        <div class="col-3 mt-4">
                                            <div class="d-grid">
                                                <button type="submit" class="btn btn-success">Click to send again</button>
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
</div>
@endsection
