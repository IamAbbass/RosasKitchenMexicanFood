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
                    <li class="breadcrumb-item active" aria-current="page">Business</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            <div class="btn-group">
                <a href="{{ URL::to('businesses/create') }}" class="btn btn-success"><i class="bx bx-plus-circle"></i> Add Business</a>
            </div>
        </div>
    </div>

    <!--end breadcrumb-->
    <h6 class="mb-0 text-uppercase">Business List</h6>
    <hr/>
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table id="example" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>#</th>
                            {{-- <th>Icon/Logo</th> --}}
                            <th>Business Name</th>
                            <th>Contact</th>
                            <th>Social Link</th>
                            <th>Settings</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($businesses as $index => $business)
                        <tr>
                            <td>{{ $index+1 }}</td>
                            {{-- <td class="text-center">
                                <img src="{{ asset('assets/attachment/business/'.$business->icon) }}" width="50" height="50" title="Icon">
                                <img src="{{ asset('assets/attachment/business/'.$business->fcm_icon) }}" width="50" height="50" title="FCM Icon">
                                <hr style="margin: 0.2rem 0 !important">
                                <img src="{{ asset('assets/attachment/business/'.$business->image) }}" width="80" height="80" title="Logo">
                                <img src="{{ asset('assets/attachment/business/'.$business->fcm_image) }}" width="80" height="80" title="FCM Logo">
                            </td> --}}
                            <td>{{ $business->name }}<br>{{ $business->slogan }}</td>
                            <td>{{ $business->phone }}<br>{{ $business->website }}<br>{{ $business->email }}</td>
                            <td>
                                <a target="_blank" href="{{ $business->facebook }}"><i class="lni lni-facebook"></i></a>
                                <a target="_blank" href="{{ $business->instagram }}"><i class="lni lni-instagram"></i></a>
                                <a target="_blank" href="{{ $business->twitter }}"><i class="lni lni-twitter"></i></a>
                                <a target="_blank" href="{{ $business->youtube }}"><i class="lni lni-youtube"></i></a>
                                <a href="tel:{{ $business->phone }}"><i class="lni lni-phone"></i></a>
                                <a target="_blank" href="https://wa.me/{{ $business->phone }}"><i class="lni lni-whatsapp"></i>
                            </td>
                            <td>
                                Gift: {{ $business->is_gift == 0 ? "No" : "Yes" }}<br>
                                Min Order: PKR {{ number_format($business->min_order,2) }}
                                <hr style="margin: 0.2rem 0 !important">
                                <div class="d-flex order-actions">
                                    <a href="businesses/{{ $business->id }}" class="" title="View"><i class="bx bx-show"></i></a>
                                    <a href="businesses/{{ $business->id }}/edit" class="ms-2" title="Edit"><i class="bx bxs-edit"></i></a>
                                    <a href="businesses/{{ $business->id }}" class="ms-2" title="Delete" onclick="event.preventDefault(); document.getElementById('del-form').submit();">
                                        <i class="bx bxs-trash"></i></a>
                                    </a>
                                    <form id="del-form" action="businesses/{{ $business->id }}" method="POST">
                                        @csrf
                                        {{ method_field('DELETE') }}
                                    </form>
                                </div>
                                <hr style="margin: 0.2rem 0 !important">
                                @if($business->is_available == true)
                                    <a href="businesses/is_available/{{ $business->id }}">
                                        <div class="d-flex align-items-center text-success">
                                            <i class="bx bx-radio-circle-marked bx-rotate-90 align-middle font-18 me-1"></i>
                                            <span>Active</span>
                                        </div>
                                    </a>
                                @else
                                    <a href="businesses/is_available/{{ $business->id }}">
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
                            {{-- <th>Image/Logo</th> --}}
                            <th>Business Name</th>
                            <th>Contact</th>
                            <th>Social Link</th>
                            <th>Settings</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
