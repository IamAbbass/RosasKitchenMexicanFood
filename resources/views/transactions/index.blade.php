@extends('layouts.app')

@section('content')
<div class="page-content">
    @include('layouts.alert')
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Transactions</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-buildings"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Transactions</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            <div class="btn-group">
                <a href="{{ URL::to('deposit') }}" class="btn btn-success"><i class="bx bx-plus-circle"></i> Deposit</a>
            </div>
        </div>
    </div>

    <!--end breadcrumb-->
    <h6 class="mb-0 text-uppercase">Transactions <kbd>Closing Balance (PKR {{ number_format($transactions->sum('credit') - $transactions->sum('debit'),2) }})</kbd></h6>
    <hr/>
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table id="example" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Transaction</th>
                            <th>Debit (PKR {{ number_format($transactions->sum('debit'),2) }})</th>
                            <th>Credit (PKR {{ number_format($transactions->sum('credit'),2) }})</th>
                            <!-- <th>Debit</th>
                            <th>Credit</th> -->
                            <th>Is Available</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($transactions as $index => $transaction)
                        <tr title="{{ $transaction->address }}">
                            <td>{{ $index+1 }}</td>
                            <td>
                                <small>{{ $transaction->category }}/000{{ $transaction->transaction_id }}</small><br>
                                <kbd>{{ $transaction->transaction }}</kbd><br>
                                <small>{!! str_replace(PHP_EOL,"<br>",$transaction->description) !!}</small>
                            </td>
                            <td>{{ number_format($transaction->debit,2) }}</td>
                            <td>{{ number_format($transaction->credit,2) }}</td>
                            <td>
                                @if($transaction->is_available == true)
                                    <a href="transactions/is_available/{{ $transaction->id }}">
                                        <div class="d-flex align-items-center text-success">
                                            <i class="bx bx-radio-circle-marked bx-rotate-90 align-middle font-18 me-1"></i>
                                            <span>Active</span>
                                        </div>
                                    </a>
                                @else
                                    <a href="transactions/is_available/{{ $transaction->id }}">
                                        <div class="d-flex align-items-center text-danger">
                                            <i class="bx bx-radio-circle-marked bx-rotate-90 align-middle font-18 me-1"></i>
                                            <span>Inactive</span>
                                        </div>
                                    </a>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>#</th>
                            <th>Transaction</th>
                            <th>Debit (PKR {{ number_format($transactions->sum('debit'),2) }})</th>
                            <th>Credit (PKR {{ number_format($transactions->sum('credit'),2) }})</th>
                            <!-- <th>Debit</th>
                            <th>Credit</th> -->
                            <th>Is Available</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
