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
                    <li class="breadcrumb-item active" aria-current="page">Users</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            <div class="btn-group">
                <a href="{{ URL::to('users/create') }}" class="btn btn-success"><i class="bx bx-plus-circle"></i> Add Users</a>
            </div>
        </div>
    </div>

    <!--end breadcrumb-->
    <h6 class="mb-0 text-uppercase">Users List</h6>
    <hr/>
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table id="example" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Photo</th>
                            <th>Users</th>
                            <th>Contact</th>
                            <th>Role</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $index => $user)
                        <tr>
                            <td>{{ $index+1 }}</td>
                            <td class="text-center">
                                <img style="{{ ($user->is_verified == true) ? 'border: 2.5px solid green' : 'border: 2.5px solid red' }}" src="{{ asset('assets/attachment/user/'.$user->image) }}" class="rounded-circle" width="50" height="50" alt="{{ $user->users_name }}">
                            </td>
                            <td>
                                <b>
                                    {{ $user->customer == null ? "" : "Customer ID: ".$user->customer->id }}<br>
                                    {{ $user->business->name }}<br>
                                    {{ $user->name }}
                                </b><br>
                                <small style="font-size: 10px;">{{ $user->address }}</small><br>
                                <!-- <small style="font-size: 10px;">
                                    <a targer="_blank" href="{{ $user->api_token == null ? '' : $user->api_token }}"> APT Token</a>,
                                    <a targer="_blank" href="{{ $user->customer == null ? '' : $user->customer->fcm_token }}"> FCM TOKEN</a>
                                </small> -->
                            </td>
                            <td>
                                Verified: {{ $user->is_verified == 0 ? "False" : "True"}}<br>
                                {{ $user->phone }}<br>
                                {{ $user->email }}
                            </td>
                            <td style="font-size: 11px; line-height: 11px;">
                                <!-- Index / Access -->
                                @if($user->role->index == 1)
                                    <div class="d-flex align-items-center text-success">
                                        <i class="bx bx-radio-circle-marked bx-rotate-90 align-middle font-18 me-1"></i>
                                        <span>Access</span>
                                    </div>
                                @else
                                    <div class="d-flex align-items-center text-danger">
                                        <i class="bx bx-radio-circle-marked bx-rotate-90 align-middle font-18 me-1"></i>
                                        <span>Access</span>
                                    </div>
                                @endif

                                <!-- Create -->
                                @if($user->role->create == 1)
                                    <div class="d-flex align-items-center text-success">
                                        <i class="bx bx-radio-circle-marked bx-rotate-90 align-middle font-18 me-1"></i>
                                        <span>Create</span>
                                    </div>
                                @else
                                    <div class="d-flex align-items-center text-danger">
                                        <i class="bx bx-radio-circle-marked bx-rotate-90 align-middle font-18 me-1"></i>
                                        <span>Create</span>
                                    </div>
                                @endif

                                <!-- Store -->
                                @if($user->role->store == 1)
                                    <div class="d-flex align-items-center text-success">
                                        <i class="bx bx-radio-circle-marked bx-rotate-90 align-middle font-18 me-1"></i>
                                        <span>Store</span>
                                    </div>
                                @else
                                    <div class="d-flex align-items-center text-danger">
                                        <i class="bx bx-radio-circle-marked bx-rotate-90 align-middle font-18 me-1"></i>
                                        <span>Store</span>
                                    </div>
                                @endif

                                <!-- Show -->
                                @if($user->role->show == 1)
                                    <div class="d-flex align-items-center text-success">
                                        <i class="bx bx-radio-circle-marked bx-rotate-90 align-middle font-18 me-1"></i>
                                        <span>Show</span>
                                    </div>
                                @else
                                    <div class="d-flex align-items-center text-danger">
                                        <i class="bx bx-radio-circle-marked bx-rotate-90 align-middle font-18 me-1"></i>
                                        <span>Show</span>
                                    </div>
                                @endif

                                <!-- Edit -->
                                @if($user->role->edit == 1)
                                    <div class="d-flex align-items-center text-success">
                                        <i class="bx bx-radio-circle-marked bx-rotate-90 align-middle font-18 me-1"></i>
                                        <span>Edit</span>
                                    </div>
                                @else
                                    <div class="d-flex align-items-center text-danger">
                                        <i class="bx bx-radio-circle-marked bx-rotate-90 align-middle font-18 me-1"></i>
                                        <span>Edit</span>
                                    </div>
                                @endif

                                <!-- Update -->
                                @if($user->role->update == 1)
                                    <div class="d-flex align-items-center text-success">
                                        <i class="bx bx-radio-circle-marked bx-rotate-90 align-middle font-18 me-1"></i>
                                        <span>Update</span>
                                    </div>
                                @else
                                    <div class="d-flex align-items-center text-danger">
                                        <i class="bx bx-radio-circle-marked bx-rotate-90 align-middle font-18 me-1"></i>
                                        <span>Update</span>
                                    </div>
                                @endif

                                <!-- Delete -->
                                @if($user->role->destroy == 1)
                                    <div class="d-flex align-items-center text-success">
                                        <i class="bx bx-radio-circle-marked bx-rotate-90 align-middle font-18 me-1"></i>
                                        <span>Delete</span>
                                    </div>
                                @else
                                    <div class="d-flex align-items-center text-danger">
                                        <i class="bx bx-radio-circle-marked bx-rotate-90 align-middle font-18 me-1"></i>
                                        <span>Delete</span>
                                    </div>
                                @endif

                                <!-- Status -->
                                @if($user->role->is_available == 1)
                                    <div class="d-flex align-items-center text-success">
                                        <i class="bx bx-radio-circle-marked bx-rotate-90 align-middle font-18 me-1"></i>
                                        <span>Active/Inactive</span>
                                    </div>
                                @else
                                    <div class="d-flex align-items-center text-danger">
                                        <i class="bx bx-radio-circle-marked bx-rotate-90 align-middle font-18 me-1"></i>
                                        <span>Active/Inactive</span>
                                    </div>
                                @endif
                            <td>
                                @if($user->customer_id <= 0)
                                    <b class="text-success">Business {{ $user->role->permission }}</b>
                                    <hr style="margin: 0 0 5px 0;">
                                @endif
                                <div class="d-flex order-actions">
                                    <a href="users/{{ $user->id }}" class="" title="View"><i class="bx bx-show"></i></a>
                                    <a href="users/{{ $user->id }}/edit" class="ms-2" title="Edit"><i class="bx bxs-edit"></i></a>
                                    <a href="users/{{ $user->id }}" class="ms-2" title="Delete" onclick="event.preventDefault(); document.getElementById('del-form').submit();">
                                        <i class="bx bxs-trash"></i></a>
                                    </a>
                                    <form id="del-form" action="users/{{ $user->id }}" method="POST">
                                        @csrf
                                        {{ method_field('DELETE') }}
                                    </form>
                                </div>
                                <hr style="margin: 5px 0 0 0;">
                                @if($user->is_available == true)
                                    <a href="users/is_available/{{ $user->id }}">
                                        <div class="d-flex align-items-center text-success">
                                            <i class="bx bx-radio-circle-marked bx-rotate-90 align-middle font-18 me-1"></i>
                                            <span>Active</span>
                                        </div>
                                    </a>
                                @else
                                    <a href="users/is_available/{{ $user->id }}">
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
                            <th>Photo</th>
                            <th>Users</th>
                            <th>Contact</th>
                            <th>Role</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
