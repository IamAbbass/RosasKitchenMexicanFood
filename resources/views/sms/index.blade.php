@extends('layouts.app')

@section('content')
<div class="page-content">
    @include('layouts.alert')
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Marketing</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-radar"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">SMS Marketing</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            <div class="btn-group">
                <a href="{{ URL::to('sms/create') }}" class="btn btn-success"><i class="bx bx-plus-circle"></i> Market via SMS</a>
            </div>
        </div>
    </div>
    <!--end breadcrumb-->
    <h6 class="mb-0 text-uppercase">SMS List</h6>
    <hr/>
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table id="example" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th class="text-center">#</th>
                            <th>SMS Log</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($smss as $index => $sms)
                        <tr>
                            <td class="text-center">{{ $sms->id }}</td>
                            <td>
                                <h5><b>{{ $sms->number }}</b></h5>
                                <h6><i>{{ $sms->message }}</i></h6>
                                <small style="font-size:9px">{{ $sms->user->name }} / {{ $sms->created_at }}</small><br>
                                <a href="/sms/{{ $sms->id }}/edit"><span class="badge bg-warning text-dark"><i class="bx bx-repost mr-1"></i>Want to send again?</span></a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th class="text-center">#</th>
                            <th>SMS Log</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
