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
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-book-content"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Edit Assets</li>
                </ol>
            </nav>
        </div>
    </div>
    <!--end breadcrumb-->

    <div class="card">
        <div class="card-body p-4">
            <h5 class="card-title">Edit Assets</h5>
            <hr/>
            <div class="form-body mt-4">
                <div class="row">
                    <div class="col-lg-12">
                            <div class="border border-3 p-3 rounded">
                                <form action="/fixes/{{ $fix->id }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PATCH')
                                    <div class="row g-2">
                                        <div class="col-md-3">
                                            <label class="form-label">* Account Name</label>
                                            <select class="form-select" name="account_id">
                                                <option value="">Select an option</option>
                                                @foreach($accounts as $index => $account)
                                                    <option {{ $fix->account_id == $account->id ? 'selected' : '' }} value="{{ $account->id }}">{{ $account->title }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-5">
                                            <label class="form-label">* Title</label>
                                            <input type="text" name="title" value="{{ $fix->title }}" class="form-control">
                                        </div>
                                        <div class="col-md-2">
                                            <label class="form-label">* Amount</label>
                                            <input type="number" name="amount" value="{{ $fix->amount }}" class="form-control">
                                        </div>
                                        <div class="col-md-2">
                                            <label class="form-label">Date</label>
                                            <input type="date" name="date" value="{{ $fix->date }}" class="form-control">
                                        </div>
                                        <div class="col-md-12">
                                            <label class="form-label">Description</label>
                                            <input type="text" name="description" value="{{ $fix->description }}" class="form-control">
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
