@extends('layouts.app_catelogue')
@section('content')
<div class="page-content">
    @include('layouts.alert')
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Activity Log</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-data"></i></a></li>
                    <li class="breadcrumb-item active" aria-current="page">Activity Log</li>
                </ol>
            </nav>
        </div>
    </div>

    <!--end breadcrumb-->
    <h6 class="mb-0 text-uppercase">Activity Log</h6>
    <hr/>
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table id="example" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>Activity Log</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($activities as $index => $activity)
                        <tr>
                            <td>
                                <strong>Request ID:</strong> {{ $activity->id }}<br>
                                <strong>Method:</strong> {{ $activity->method }}<br>
                                <strong>URI:</strong> {{ $activity->uri }}<br>
                                <strong>Request:</strong> {{ $activity->request_body }}<br>
                                <strong>Location:</strong> {{ $activity->lon }},  {{ $activity->lat }},  {{ $activity->acc }}
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>Activity Log</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
