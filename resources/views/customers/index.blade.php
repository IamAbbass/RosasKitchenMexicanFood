@extends('layouts.app')

@section('content')
<div class="page-content">
    @include('layouts.alert')
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Contacts</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-book-content"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Customers</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            <div class="btn-group">
                <a href="{{ URL::to('customers/create') }}" class="btn btn-success"><i class="bx bx-plus-circle"></i> Add Customer</a>
            </div>
        </div>
    </div>

    <!--end breadcrumb-->
    <h6 class="mb-0 text-uppercase">Customers List</h6>
    <hr/>
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table id="example" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Devide Info</th>
                            <th>Google Auth</th>
                            <th>Facebook Auth</th>
                            <th>Locality</th>
                            <th>Security</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($customers as $index => $customer)
                        <tr>
                            <td>{{ $index+1 }}</td>
                            <td>
                                Brand: {{ $customer->brand }}<br>            
                                Manufacturer: {{ $customer->manufacturer }}<br>
                                Model: {{ $customer->model }}<br>
                                Os: {{ $customer->os }}<br>
                                IMEI: {{ $customer->imei }}<br>
                                Android ID: {{ $customer->android_id }}<br>              
                                FCM Token: {{ $customer->fcm_token }}
                            </td>
                            <td>
                                Customer IMG: {{ $customer->image }}<br>
                                UUID: {{ $customer->uuid }}
                            </td>
                            <td>
                                PSID: {{ $customer->psid }}<br>
                                FB Name: {{ $customer->fb_profile_name }}
                            </td>
                            <td>
                                Region: {{ $customer->region_id }}<br>
                                District: {{ $customer->district_id }}<br>
                                Township: {{ $customer->township_id }}<br>
                                Town: {{ $customer->town_id }}
                            </td>
                            <td>
                                Device Token: {{ $customer->device_token }} 
                            </td>
                            <td>
                                @if($customer->is_available == true)
                                    <a href="customers/is_available/{{ $customer->id }}">
                                        <div class="d-flex align-items-center text-success">
                                            <i class="bx bx-radio-circle-marked bx-rotate-90 align-middle font-18 me-1"></i>
                                            <span>Active</span>
                                        </div>
                                    </a>
                                @else
                                    <a href="customers/is_available/{{ $customer->id }}">
                                        <div class="d-flex align-items-center text-danger">
                                            <i class="bx bx-radio-circle-marked bx-rotate-90 align-middle font-18 me-1"></i>
                                            <span>Inactive</span>
                                        </div>
                                    </a>
                                @endif
                                <!-- <hr style="margin: 0.2rem 0 !important">
                                <div class="d-flex order-actions">
                                    <a href="customers/{{ $customer->id }}" class="" title="View"><i class="bx bx-show"></i></a>
                                    <a href="customers/{{ $customer->id }}/edit" class="ms-2" title="Edit"><i class="bx bxs-edit"></i></a>
                                    <a href="customers/{{ $customer->id }}" class="ms-2" title="Delete" onclick="event.preventDefault(); document.getElementById('del-form').submit();">
                                        <i class="bx bxs-trash"></i></a>
                                    </a>
                                    <form id="del-form" action="customers/{{ $customer->id }}" method="POST">
                                        @csrf
                                        {{ method_field('DELETE') }}
                                    </form>
                                </div> -->
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>#</th>
                            <th>Devide Info</th>
                            <th>Google Auth</th>
                            <th>Facebook Auth</th>
                            <th>Locality</th>
                            <th>Security</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
