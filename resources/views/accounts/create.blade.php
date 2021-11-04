@extends('layouts.app')

@section('content')
<div class="page-content">
    @include('layouts.alert')
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Bank Accounts</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-buildings"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Add New Account</li>
                </ol>
            </nav>
        </div>
    </div>
    <!--end breadcrumb-->

    <div class="card">
        <div class="card-body p-4">
            <h5 class="card-title">Add New Account</h5>
            <hr/>
            <div class="form-body mt-4">
                <div class="row">
                    <div class="col-lg-12">
                            <div class="border border-3 p-3 rounded">
                                <form action="/accounts" method="POST" enctype="multipart/form-data">
                                @csrf
                                    <div class="row g-2">
                                        <div class="col-md-7">
                                            <label class="form-label">* Title</label>
                                            <input type="text" name="title" value="{{ old('title') }}" autofocus class="form-control">
                                        </div>
                                        <div class="col-md-3">
                                            <label class="form-label">* Type</label>
                                            <select class="form-select" name="type">
                                                <option value="">Select an option</option>
                                                <option value="Bank" {{ (old("type") == "Bank" ? "selected":"") }}>Bank</option>
                                                <option value="Cash" {{ (old("type") == "Cash" ? "selected":"") }}>Cash</option>
                                            </select>
                                        </div>

                                        <div class="col-md-2">
                                            <label class="form-label">* Opening Balance</label>
                                            <input type="text" name="amount" value="{{ old('amount') }}" class="form-control">
                                        </div>

                                        <div class="col-md-12">
                                            <div class="input-group"> <span class="input-group-text">Bank Details</span>
                                                <textarea class="form-control" name="details" rows="5" aria-label="With textarea">
Account Title: John
Account Number: 00000000001
Branch: Johar Mor Branch
IBAN: PK10BANK0000000000000001</textarea>
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
