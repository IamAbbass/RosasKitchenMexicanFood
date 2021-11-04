@extends('layouts.app')

@section('content')
<div class="page-content">
    @include('layouts.alert')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-12 col-xl-12">
                            <form action="/home" method="GET" enctype="multipart/form-data">
                                <div class="row row-cols-lg-auto g-2">
                                    <div class="col-12">
                                        <div class="btn-group">
                                            <span class="btn btn-white">From Date</span>
                                            <div class="btn-group">
                                                <input type="text" name="from" value="{{ old('from',date('d F, Y', time())) }}" class="form-control datepicker" readonly/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="btn-group">
                                            <span class="btn btn-white">To Date</span>
                                            <div class="btn-group">
                                                <input type="text" name="to" value="{{ old('to',date('d F, Y', time())) }}" class="form-control datepicker" readonly/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="btn-group">
                                            <button type="submit" class="btn btn-white">Search</button>
                                        </div>
                                    </div>
                                    <form>
                                    <div class="col-12">
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-white">Quick Filter</button>
                                            <div class="btn-group" role="group">
                                                <button id="btnGroupDrop1" type="button" class="btn btn-white dropdown-toggle dropdown-toggle-nocaret px-1" data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class='bx bxs-category'></i>
                                                </button>
                                                <ul class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                                                <li><a class="dropdown-item" href="#">Today</a></li>
                                                <li><a class="dropdown-item" href="#">Yesterday</a></li>
                                                <li><a class="dropdown-item" href="#">Weekly</a></li>
                                                <li><a class="dropdown-item" href="#">Monthly</a></li>
                                                <li><a class="dropdown-item" href="#">Yearly</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <h6 class="mb-1">Customers, Orders & Unpaid Wallet</h6>
    <hr style="margin-top: 0"/>
    <div class="row row-cols-1 row-cols-md-2 row-cols-xl-4">
        <div class="col">
            <div class="card radius-10">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div>
                            <p class="mb-0 text-secondary">Customers</p>
                            <h4 class="my-1">0</h4>
                            {{-- <p class="mb-0 font-13 text-success">No. of customers registered</p> --}}
                        </div>
                        <div class="widgets-icons bg-light-info text-info ms-auto"><i class='bx bxs-group'></i></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card radius-10">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div>
                            <p class="mb-0 text-secondary">New Customers</p>
                            <h4 class="my-1">0</h4>
                        </div>
                        <div class="widgets-icons bg-light-info text-info ms-auto"><i class='bx bxs-user'></i></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card radius-10">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div>
                            <p class="mb-0 text-secondary">Orders</p>
                            <h4 class="my-1">0</h4>
                        </div>
                        <div class="widgets-icons bg-light-success text-success ms-auto"><i class="bx bxs-cart"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card radius-10">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div>
                            <p class="mb-0 text-secondary">New Orders</p>
                            <h4 class="my-1">0</h4>
                        </div>
                        <div class="widgets-icons bg-light-success text-success ms-auto"><i class="bx bxs-cart-alt"></i></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card radius-10">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div>
                            <p class="mb-0 text-secondary">Re Orders</p>
                            <h4 class="my-1">0</h4>
                        </div>
                        <div class="widgets-icons bg-light-success text-success ms-auto"><i class="bx bxs-cart-alt"></i></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card radius-10">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div>
                            <p class="mb-0 text-secondary">Cancelled</p>
                            <h4 class="my-1">0</h4>
                        </div>
                        <div class="widgets-icons bg-light-danger text-danger ms-auto"><i class="bx bxs-cart"></i></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card radius-10">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div>
                            <p class="mb-0 text-secondary">Wallet (Payable)</p>
                            <h4 class="my-1">0</h4>
                        </div>
                        <div class="widgets-icons bg-light-warning text-warning ms-auto"><i class="bx bxs-wallet"></i></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card radius-10">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div>
                            <p class="mb-0 text-secondary">Wallet (Debit)</p>
                            <h4 class="my-1">0</h4>
                        </div>
                        <div class="widgets-icons bg-light-warning text-warning ms-auto"><i class="bx bxs-wallet-alt"></i></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card radius-10">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div>
                            <p class="mb-0 text-secondary">Wallet (Credit)</p>
                            <h4 class="my-1">0</h4>
                        </div>
                        <div class="widgets-icons bg-light-warning text-warning ms-auto"><i class="bx bxs-wallet-alt"></i></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <h6 class="mb-1">Orders Details</h6>
    <hr style="margin-top: 0"/>
    <div class="row row-cols-1 row-cols-md-2 row-cols-xl-5">
        <div class="col">
            <div class="card radius-10">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div>
                            <p class="mb-0 text-secondary">Purchases</p>
                            <h4 class="my-1">0</h4>
                        </div>
                        <div class="widgets-icons bg-light-primary text-primary ms-auto"><i class="bx bx-box"></i></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card radius-10">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div>
                            <p class="mb-0 text-secondary">Sale</p>
                            <h4 class="my-1">0</h4>
                        </div>
                        <div class="widgets-icons bg-light-success text-success ms-auto"><i class="bx bxs-cart"></i></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card radius-10">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div>
                            <p class="mb-0 text-secondary">Delivery (0)</p>
                            <h4 class="my-1">0</h4>
                        </div>
                        <div class="widgets-icons bg-light-success text-success ms-auto"><i class="bx bx-cycling"></i></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card radius-10">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div>
                            <p class="mb-0 text-secondary">Gifts (0)</p>
                            <h4 class="my-1">0</h4>
                        </div>
                        <div class="widgets-icons bg-light-warning text-warning ms-auto"><i class="bx bxs-gift"></i></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card radius-10">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div>
                            <p class="mb-0 text-secondary">Profit</p>
                            <h4 class="my-1">0</h4>
                        </div>
                        <div class="widgets-icons bg-light-success text-success ms-auto"><i class="bx bxs-wallet-alt"></i></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card radius-10">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div>
                            <p class="mb-0 text-secondary">Damages/Expense</p>
                            <h4 class="my-1">0</h4>
                        </div>
                        <div class="widgets-icons bg-light-danger text-danger ms-auto"><i class="bx bxs-eraser"></i></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <h6 class="mb-1">Expenses</h6>
    <hr style="margin-top: 0"/>
    <div class="row row-cols-1 row-cols-md-2 row-cols-xl-5">
        <div class="col">
            <div class="card radius-10">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div>
                            <p class="mb-0 text-secondary">Expenses</p>
                            <h4 class="my-1">000</h4>
                        </div>
                        <div class="widgets-icons bg-light-danger text-danger ms-auto"><i class='bx bxs-group'></i></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card radius-10">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div>
                            <p class="mb-0 text-secondary">Printing</p>
                            <h4 class="my-1">000</h4>
                        </div>
                        <div class="widgets-icons bg-light-danger text-danger ms-auto"><i class="bx bxs-cart"></i></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card radius-10">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div>
                            <p class="mb-0 text-secondary">Marketing</p>
                            <h4 class="my-1">000</h4>
                        </div>
                        <div class="widgets-icons bg-light-danger text-danger ms-auto"><i class="bx bxs-cart"></i></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card radius-10">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div>
                            <p class="mb-0 text-secondary">Damages</p>
                            <h4 class="my-1">000</h4>
                        </div>
                        <div class="widgets-icons bg-light-danger text-danger ms-auto"><i class='bx bxs-user'></i></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--end row-->
</div
@endsection
