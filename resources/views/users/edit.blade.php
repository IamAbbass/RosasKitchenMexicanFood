@extends('layouts.app')

@section('content')
<div class="page-content">
    @include('layouts.alert')
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Users</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-book-content"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Edit Users</li>
                </ol>
            </nav>
        </div>
    </div>
    <!--end breadcrumb-->

    <div class="card">
        <div class="card-body p-4">
            <h5 class="card-title">Edit Users</h5>
            <hr/>
            <div class="form-body mt-4">
                <div class="row">
                    <div class="col-lg-12">
                            <div class="border border-3 p-3 rounded">
                                <form action="/users/{{ $user->id }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PATCH')
                                    <div class="row g-2">
                                        <div class="col-md-2">
                                            <label class="form-label">Photo</label>
                                            <input readonly type="text" name="image" value="{{ $user->image }}" class="form-control">
                                        </div>
                                        <div class="col-md-3">
                                            <label class="form-label">* Users Name</label>
                                            <input type="text" name="name" value="{{ $user->name }}" class="form-control">
                                        </div>
                                        <div class="col-md-2">
                                            <label class="form-label">Password</label>
                                            <input type="text" name="password" value="" class="form-control">
                                        </div>
                                        <div class="col-md-3">
                                            <label class="form-label">* Email</label>
                                            <input type="email" name="email" value="{{ $user->email }}" class="form-control">
                                        </div>
                                        <div class="col-md-2">
                                            <label class="form-label">* Phone</label>
                                            <input type="text" name="phone" value="{{ $user->phone }}" class="form-control">
                                        </div>
                                        <div class="col-md-12">
                                            <label class="form-label">Address</label>
                                            <input type="text" name="address" value="{{ $user->address }}" class="form-control">
                                        </div>
                                    </div>
                                    @can('isOwner','isAdmin')
                                    <hr>
                                    <div class="row g-2">
                                        <div class="col-md-3">
                                            <label class="form-label">Permission</label>
                                            <select class="form-select" name="permission">
                                                <option {{ $user->role->permission == 'Admin' ? 'selected' : '' }} value="Admin">Admin</option>
                                                <option {{ $user->role->permission == 'Manager' ? 'selected' : '' }} value="Manager">Manager</option>
                                                <option {{ $user->role->permission == 'User' ? 'selected' : '' }} value="User">User</option>
                                            </select>
                                        </div>
                                        <div class="col-md-9">
                                            <label class="form-label">Title</label>
                                            <input type="text" name="title" value="{{ $user->role->title }}" class="form-control">
                                        </div>

                                        <table class="table table-striped table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Role</th>
                                                    <th>Description</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>1</td>
                                                    <td>Access</td>
                                                    <td>Display a listing of the resource</td>
                                                    <td>
                                                        <div class="form-check form-switch">
                                                            <input class="form-check-input" type="checkbox" name="index" value="1" id="flexSwitch-{{ $user->role->index }}"
                                                            {{ $user->role->index == 1 ? 'checked' : '' }} {{ $user->role->permission == 'Admin'  ? 'checked hidden' : '' }} >
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>2</td>
                                                    <td>Create</td>
                                                    <td>Show the form for creating a new resource</td>
                                                    <td>
                                                        <div class="form-check form-switch">
                                                            <input class="form-check-input" type="checkbox" name="create" value="1" id="flexSwitch-{{ $user->role->create }}"
                                                            {{ $user->role->create == 1 ? 'checked' : '' }} {{ $user->role->permission == 'Admin'  ? 'checked hidden' : '' }} >
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>3</td>
                                                    <td>Store</td>
                                                    <td>Store a newly created resource in storage</td>
                                                    <td>
                                                        <div class="form-check form-switch">
                                                            <input class="form-check-input" type="checkbox" name="store" value="1" id="flexSwitch-{{ $user->role->store }}"
                                                            {{ $user->role->store == 1 ? 'checked' : '' }} {{ $user->role->permission == 'Admin'  ? 'checked hidden' : '' }} >
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>4</td>
                                                    <td>Show</td>
                                                    <td>Display the specified resource</td>
                                                    <td>
                                                        <div class="form-check form-switch">
                                                            <input class="form-check-input" type="checkbox" name="show" value="1" id="flexSwitch-{{ $user->role->show }}"
                                                            {{ $user->role->show == 1 ? 'checked' : '' }} {{ $user->role->permission == 'Admin'  ? 'checked hidden' : '' }} >
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>5</td>
                                                    <td>Edit</td>
                                                    <td>Show the form for editing the specified resource</td>
                                                    <td>
                                                        <div class="form-check form-switch">
                                                            <input class="form-check-input" type="checkbox" name="edit" value="1" id="flexSwitch-{{ $user->role->edit }}"
                                                            {{ $user->role->edit == 1 ? 'checked' : '' }} {{ $user->role->permission == 'Admin'  ? 'checked hidden' : '' }} >
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>6</td>
                                                    <td>Update</td>
                                                    <td>Update the specified resource in storage</td>
                                                    <td>
                                                        <div class="form-check form-switch">
                                                            <input class="form-check-input" type="checkbox" name="update" value="1" id="flexSwitch-{{ $user->role->update }}"
                                                            {{ $user->role->update == 1 ? 'checked' : '' }} {{ $user->role->permission == 'Admin'  ? 'checked hidden' : '' }} >
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>7</td>
                                                    <td>Delete</td>
                                                    <td>Remove the specified resource from storage</td>
                                                    <td>
                                                        <div class="form-check form-switch">
                                                            <input class="form-check-input" type="checkbox" name="destroy" value="1" id="flexSwitch-{{ $user->role->destroy }}"
                                                            {{ $user->role->destroy == 1 ? 'checked' : '' }} {{ $user->role->permission == 'Admin'  ? 'checked hidden' : '' }} >
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>8</td>
                                                    <td>Status</td>
                                                    <td>Active/Inactive the specified resource from storage</td>
                                                    <td>
                                                        <div class="form-check form-switch">
                                                            <input class="form-check-input" type="checkbox" name="is_available" value="1" id="flexSwitch-{{ $user->role->is_available }}"
                                                            {{ $user->role->is_available == 1 ? 'checked' : '' }} {{ $user->role->permission == 'Admin'  ? 'checked hidden' : '' }} >
                                                        </div>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        @endcan

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
