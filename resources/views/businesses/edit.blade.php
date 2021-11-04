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
                    <li class="breadcrumb-item active" aria-current="page">Edit Business</li>
                </ol>
            </nav>
        </div>
    </div>
    <!--end breadcrumb-->

    <div class="card">
        <div class="card-body p-4">
            <h5 class="card-title">Edit Business</h5>
            <hr/>
            <div class="form-body mt-4">
                <div class="row">
                    <div class="col-lg-12">
                            <div class="border border-3 p-3 rounded">
                                <form action="/businesses/{{ $business->id }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PATCH')
                                    <div class="row g-2">
                                        <div class="col-md-3">
                                            <label class="form-label">Icon</label>
                                            <input type="file" name="icon" value="{{ $business->icon }}" autofocus class="form-control">
                                            <input type="hidden" name="old_icon" value="{{ $business->icon }}">
                                        </div>
                                        <div class="col-md-3">
                                            <label class="form-label">FCM Icon</label>
                                            <input type="file" name="fcm_icon" value="{{ $business->fcm_icon }}" autofocus class="form-control">
                                            <input type="hidden" name="old_fcm_icon" value="{{ $business->fcm_icon }}">
                                        </div>
                                        <div class="col-md-3">
                                            <label class="form-label">Logo</label>
                                            <input type="file" name="image" value="{{ $business->image }}" class="form-control">
                                            <input type="hidden" name="old_image" value="{{ $business->image }}">
                                        </div>
                                        <div class="col-md-3">
                                            <label class="form-label">FCM Logo</label>
                                            <input type="file" name="fcm_image" value="{{ $business->fcm_image }}" class="form-control">
                                            <input type="hidden" name="old_fcm_image" value="{{ $business->fcm_image }}">
                                        </div>
                                        <div class="col-md-3">
                                            <label class="form-label">* Business Name</label>
                                            <input type="text" name="name" value="{{ $business->name }}" class="form-control">
                                        </div>
                                        <div class="col-md-3">
                                            <label class="form-label">* Slogan</label>
                                            <input type="text" name="slogan" value="{{ $business->slogan }}" class="form-control">
                                        </div>
                                        <div class="col-md-2">
                                            <label class="form-label">* Phone</label>
                                            <input type="text" name="phone" value="{{ $business->phone }}" class="form-control">
                                        </div>
                                        <div class="col-md-2">
                                            <label class="form-label">* Website</label>
                                            <input type="text" name="website" value="{{ $business->website }}" class="form-control">
                                        </div>
                                        <div class="col-md-2">
                                            <label class="form-label">* Email</label>
                                            <input type="email" name="email" value="{{ $business->email }}" class="form-control">
                                        </div>
                                        <div class="col-md-12">
                                            <label class="form-label">* Address</label>
                                            <input type="text" name="address" value="{{ $business->address }}" class="form-control">
                                        </div>

                                        <div class="col-md-2">
                                            <label class="form-label">Facebook</label>
                                            <input type="text" name="facebook" value="{{ $business->facebook }}" class="form-control">
                                        </div>
                                        <div class="col-md-2">
                                            <label class="form-label">Instagram</label>
                                            <input type="text" name="instagram" value="{{ $business->instagram }}" class="form-control">
                                        </div>
                                        <div class="col-md-2">
                                            <label class="form-label">Youtube</label>
                                            <input type="text" name="youtube" value="{{ $business->youtube }}" class="form-control">
                                        </div>
                                        <div class="col-md-2">
                                            <label class="form-label">Twitter</label>
                                            <input type="text" name="twitter" value="{{ $business->twitter }}" class="form-control">
                                        </div>
                                        
                                        <div class="col-md-2">
                                            <label class="form-label">NTN</label>
                                            <input type="text" name="ntn" value="{{ $business->ntn }}" class="form-control">
                                        </div>
                                        <div class="col-md-2">
                                            <label class="form-label">STRN</label>
                                            <input type="text" name="strn" value="{{ $business->strn }}" class="form-control">
                                        </div>
                                        <div class="col-md-2">
                                            <label class="form-label">* Min Order</label>
                                            <input type="number" name="min_order" value="{{ $business->min_order }}" class="form-control">
                                        </div>
                                        <div class="col-md-2">
                                            <label class="form-label">Is Gift Offer ?</label>
                                            <select class="form-select" name="is_gift">
                                                <option value="0" {{ ($business->is_gift == false ? "selected":"") }}>No</option>
                                                <option value="1" {{ ($business->is_gift == true ? "selected":"") }}>Yes</option>
                                            </select>
                                        </div>
                                        <div class="col-md-8">
                                            <label class="form-label">* Off Note</label>
                                            <input type="text" name="off_note" value="{{ $business->off_note }}" class="form-control">
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
