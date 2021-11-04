@extends('layouts.app')

@section('content')
<div class="page-content">
    @include('layouts.alert')
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Contacts</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-book-content"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Add New Business</li>
                </ol>
            </nav>
        </div>
    </div>
    <!--end breadcrumb-->

    <div class="card">
        <div class="card-body p-4">
            <h5 class="card-title">Add New Business</h5>
            <hr/>
            <div class="form-body mt-4">
                <div class="row">
                    <div class="col-lg-12">
                            <div class="border border-3 p-3 rounded">
                                <form action="/businesses" method="POST" enctype="multipart/form-data">
                                @csrf
                                    <div class="row g-2">
                                        <div class="col-md-3">
                                            <label class="form-label">Icon</label>
                                            <input type="file" name="icon" value="{{ old('icon') }}" autofocus class="form-control">
                                        </div>
                                        <div class="col-md-3">
                                            <label class="form-label">FCM Icon</label>
                                            <input type="file" name="fcm_icon" value="{{ old('fcm_icon') }}" autofocus class="form-control">
                                        </div>
                                        <div class="col-md-3">
                                            <label class="form-label">Logo</label>
                                            <input type="file" name="image" value="{{ old('image') }}"  class="form-control">
                                        </div>
                                        <div class="col-md-3">
                                            <label class="form-label">FCM Logo</label>
                                            <input type="file" name="fcm_image" value="{{ old('fcm_image') }}"  class="form-control">
                                        </div>
                                        <div class="col-md-3">
                                            <label class="form-label">* Business Name</label>
                                            <input type="text" name="name" value="{{ old('name') }}" class="form-control">
                                        </div>
                                        <div class="col-md-3">
                                            <label class="form-label">* Slogan</label>
                                            <input type="text" name="slogan" value="{{ old('slogan') }}" class="form-control">
                                        </div>
                                        <div class="col-md-2">
                                            <label class="form-label">* Phone</label>
                                            <input type="text" name="phone" value="{{ old('phone') }}" class="form-control">
                                        </div>
                                        <div class="col-md-2">
                                            <label class="form-label">* Website</label>
                                            <input type="text" name="website" value="{{ old('website') }}" class="form-control">
                                        </div>
                                        <div class="col-md-2">
                                            <label class="form-label">* Email</label>
                                            <input type="email" name="email" value="{{ old('email') }}" class="form-control">
                                        </div>
                                        <div class="col-md-12">
                                            <label class="form-label">* Address</label>
                                            <input type="text" name="address" value="{{ old('address') }}" class="form-control">
                                        </div>
                                        <div class="col-md-2">
                                            <label class="form-label">Facebook</label>
                                            <input type="text" name="facebook" value="{{ old('facebook') }}" class="form-control">
                                        </div>
                                        <div class="col-md-2">
                                            <label class="form-label">Instagram</label>
                                            <input type="text" name="instagram" value="{{ old('instagram') }}" class="form-control">
                                        </div>
                                        <div class="col-md-2">
                                            <label class="form-label">Youtube</label>
                                            <input type="text" name="youtube" value="{{ old('youtube') }}" class="form-control">
                                        </div>
                                        <div class="col-md-2">
                                            <label class="form-label">Twitter</label>
                                            <input type="text" name="twitter" value="{{ old('twitter') }}" class="form-control">
                                        </div>
                                        <div class="col-md-2">
                                            <label class="form-label">NTN</label>
                                            <input type="text" name="ntn" value="{{ old('ntn') }}" class="form-control">
                                        </div>
                                        <div class="col-md-2">
                                            <label class="form-label">STRN</label>
                                            <input type="text" name="strn" value="{{ old('strn') }}" class="form-control">
                                        </div>
                                        <div class="col-md-2">
                                            <label class="form-label">* Min Order</label>
                                            <input type="number" name="min_order" value="{{ old('min_order') }}" class="form-control">
                                        </div>
                                        <div class="col-md-2">
                                            <label class="form-label">Is Gift Offer ?</label>
                                            <select class="form-select" name="is_gift">
                                                <option value="0" {{ (old('is_gift') == 0 ? "selected":"") }}>No</option>
                                                <option value="1" {{ (old('is_gift') == 1 ? "selected":"") }}>Yes</option>
                                            </select>
                                        </div>
                                        <div class="col-md-8">
                                            <label class="form-label">* Off Note</label>
                                            <input type="text" name="off_note" value="{{ old('off_note') }}" class="form-control">
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
