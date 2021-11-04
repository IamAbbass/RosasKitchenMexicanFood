@extends('layouts.app')

@section('content')
<div class="page-content">
    @include('layouts.alert')
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Accounts</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-buildings"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Deposit</li>
                </ol>
            </nav>
        </div>
    </div>
    <!--end breadcrumb-->

    <div class="card">
        <div class="card-body p-4">
            <h5 class="card-title">New Deposit</h5>
            <hr/>
            <div class="form-body mt-4">
                <div class="row">
                    <div class="col-lg-12">
                            <div class="border border-3 p-3 rounded">
                                <form action="/deposit/store" method="POST" enctype="multipart/form-data">
                                @csrf
                                    <div class="row g-2">
                                        <div class="col-md-10">
                                            <label class="form-label">* Account Title</label>
                                            <select class="form-select" name="account">
                                                <option value="">Select an account</option>
                                                @foreach($accounts as $index => $account)
                                                    <option value="{{ $account->id }}" {{ (old("account") == $account->id ? "selected":"") }}>{{ $account->title }} - ({{ $account->type }})</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="col-md-2">
                                            <label class="form-label">* Amount</label>
                                            <input type="number" name="amount" value="{{ old('amount') }}" class="form-control">
                                        </div>
                                        <div class="col-md-12">
                                            <div class="input-group"> <span class="input-group-text">* Note</span>
                                                <textarea class="form-control" name="note" rows="5" aria-label="With textarea">{{ old('note') }}</textarea>
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
