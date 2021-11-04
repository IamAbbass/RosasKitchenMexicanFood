@extends('layouts.app')

@section('content')
<div class="page-content">
    @include('layouts.alert')
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Expenses</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-wallet"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Add New Expense</li>
                </ol>
            </nav>
        </div>
    </div>
    <!--end breadcrumb-->

    <div class="card">
        <div class="card-body p-4">
            <h5 class="card-title">Add New Expense</h5>
            <hr/>
            <div class="form-body mt-4">
                <div class="row">
                    <div class="col-lg-12">
                            <div class="border border-3 p-3 rounded">
                                <form action="/expenses" method="POST" enctype="multipart/form-data">
                                @csrf
                                    <div class="row g-2">
                                        <div class="col-md-3">
                                            <label class="form-label">* Head Name</label>
                                            <select class="form-select" name="head_id" autofocus>
                                                <option value="">Select an option</option>
                                                @foreach($heads as $index => $head)
                                                    <option value="{{ $head->id }}" {{ (old("head_id") == $head->id ? "selected":"") }}>{{ $head->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-3">
                                            <label class="form-label">* Account Name</label>
                                            <select class="form-select" name="account_id">
                                                <option value="">Select an option</option>
                                                @foreach($accounts as $index => $account)
                                                    <option value="{{ $account->id }}" {{ (old("account_id") == $account->id ? "selected":"") }}>{{ $account->title }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label">* Title</label>
                                            <input type="text" name="title" value="{{ old('title') }}" class="form-control">
                                        </div>
                                        <div class="col-md-2">
                                            <label class="form-label">* Amount</label>
                                            <input type="text" name="amount" value="{{ old('amount') }}" class="form-control">
                                        </div>
                                        <div class="col-md-10">
                                            <label class="form-label">Description</label>
                                            <input type="text" name="description" value="{{ old('description') }}" class="form-control">
                                        </div>
                                        <div class="col-md-2">
                                            <label class="form-label">* Date</label>
                                            <input type="date" name="date" value="{{ old('date', date('Y-m-d')) }}" class="form-control">
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
