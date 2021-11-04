@extends('layouts.app')

@section('content')
<div class="page-content">
    @include('layouts.alert')
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Bank Accounts</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-buildings"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Account List</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            <div class="btn-group">
                <a href="{{ URL::to('accounts/create') }}" class="btn btn-success"><i class="bx bx-plus-circle"></i> Add Account</a>
            </div>
        </div>
    </div>

    <!--end breadcrumb-->
    <h6 class="mb-0 text-uppercase">Accounts List</h6>
    <hr/>
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table id="example" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Title</th>
                            <th>Type</th>
                            <th>Amount</th>
                            <th>Is Available</th>
                            <!-- <th>Action</th> -->
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($accounts as $index => $account)
                        <tr title="{{ $account->address }}">
                            <td>{{ $index+1 }}</td>
                            <td>
                                <kbd>{{ $account->title }}</kbd><br>
                                <small>{!! str_replace(PHP_EOL,"<br>",$account->details) !!}</small>
                            </td>
                            <td>{{ $account->type }}</td>
                            <td>{{ number_format($account->amount,2) }}</td>
                            <td>
                                @if($account->is_available == true)
                                    <a href="accounts/is_available/{{ $account->id }}">
                                        <div class="d-flex align-items-center text-success">
                                            <i class="bx bx-radio-circle-marked bx-rotate-90 align-middle font-18 me-1"></i>
                                            <span>Active</span>
                                        </div>
                                    </a>
                                @else
                                    <a href="accounts/is_available/{{ $account->id }}">
                                        <div class="d-flex align-items-center text-danger">
                                            <i class="bx bx-radio-circle-marked bx-rotate-90 align-middle font-18 me-1"></i>
                                            <span>Inactive</span>
                                        </div>
                                    </a>
                                @endif
                            </td>
                            <!-- <td>
                                <a href="deposit">
                                    <div class="d-flex align-items-center text-info">
                                        <i class="bx bx-radio-circle-marked bx-rotate-90 align-middle font-18 me-1"></i>
                                        <span>Deposit</span>
                                    </div>
                                </a>
                                <hr style="margin: 5px 0 10px 0;">
                                <div class="d-flex order-actions">
                                    <a href="accounts/{{ $account->id }}" class="" title="View"><i class="bx bx-show"></i></a>
                                    <a href="accounts/{{ $account->id }}/edit" class="ms-2" title="Edit"><i class="bx bxs-edit"></i></a>
                                    <a href="accounts/{{ $account->id }}" class="ms-2" title="Delete" onclick="event.preventDefault(); document.getElementById('del-form').submit();">
                                        <i class="bx bxs-trash"></i></a>
                                    </a>
                                    <form id="del-form" action="accounts/{{ $account->id }}" method="POST">
                                        @csrf
                                        {{ method_field('DELETE') }}
                                    </form>
                                </div>
                            </td> -->
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>#</th>
                            <th>Title</th>
                            <th>Type</th>
                            <th>Amount</th>
                            <th>Is Available</th>
                            <!-- <th>Action</th> -->
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
