@php
    $confirmed  = \App\Models\Message::where('business_id','=',auth()->user()->business_id)->where('type','=',"Notification")->where('status','=',"Confirmed")->first();
    $preparing  = \App\Models\Message::where('business_id','=',auth()->user()->business_id)->where('type','=',"Notification")->where('status','=',"Preparing")->first();
    $pick_up    = \App\Models\Message::where('business_id','=',auth()->user()->business_id)->where('type','=',"Notification")->where('status','=',"Pick-Up")->first();
    $arrived    = \App\Models\Message::where('business_id','=',auth()->user()->business_id)->where('type','=',"Notification")->where('status','=',"Arrived")->first();
    $delivered  = \App\Models\Message::where('business_id','=',auth()->user()->business_id)->where('type','=',"Notification")->where('status','=',"Delivered")->first();
    $cancelled  = \App\Models\Message::where('business_id','=',auth()->user()->business_id)->where('type','=',"Notification")->where('status','=',"Cancelled")->first();
@endphp

<div class="search-bar">
    <div class="position-relative search-bar-box">
        <form action="/order/search" method="post">
        @csrf
            <div class="input-group"> <span class="input-group-text" id="basic-addon1">RKMF-</span>
                <input type="text" class="form-control" name="order_no" autocomplete="off" placeholder="Order No.">
            </div>
            <button type="submit" class="position-absolute top-50 search-close translate-middle-y"><i class='bx bx-x'></i></button>
        </form>
    </div>
</div>


<div class="top-menu ms-auto">
    <ul class="navbar-nav align-items-center">
        <!-- Confirmed -->
        <li class="nav-item dropdown dropdown-large">
            <a class="nav-link dropdown-toggle dropdown-toggle-nocaret position-relative" title="Confirmed" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                <i class='bx bx-cart'></i>
                <span class="alert-count">{{ \App\Models\Order::where('business_id','=',auth()->user()->business_id)->where('order_status_id','=',$confirmed->id)->count() }}</span>
            </a>
            <div class="dropdown-menu dropdown-menu-end">
                <a href="/orders/filter/{{ $confirmed->id }}">
                    <div class="msg-header">
                        <p class="msg-header-title">Confirmed</p>
                        <!-- <p class="msg-header-clear ms-auto"></p> -->
                    </div>
                </a>
                <div class="header-notifications-list">
                    @foreach( \App\Models\Order::where('business_id','=',auth()->user()->business_id)->where('order_status_id','=',$confirmed->id)->orderBy('id', 'DESC')->take(7)->get() as $index => $order)
                    <a class="dropdown-item" href="/orders/{{ $order->id }}">
                        <div class="d-flex align-items-center">
                            <div class="notify">
                                <img style="{{ ($order->customer->user->is_verified == true) ? 'border: 2.5px solid green' : 'border: 2.5px solid red' }}" src="{{ asset('assets/attachment/user/'.$order->customer->user->image) }}"  class="msg-avatar" alt="{{ $order->name }}">
                            </div>
                            <div class="flex-grow-1">
                                <h6 class="msg-name">
                                    {{ $order->order_no }}
                                    <span class="msg-time float-end">
                                        {{ Carbon\Carbon::parse(date("Y-m-d h:i:sa", strtotime($order->updated_at)))->diffForHumans() }}    
                                    </span>
                                </h6>
                                <hr style="margin: 3px">
                                <p class="msg-info">
                                    {{ $order->name }}, {{ $order->phone }}<br>
                                    <!-- {{ $order->address }} <br> -->
                                    PKR: {{ number_format(($order->details->sum('total') >= $order->delivery->free_delivery_after ? $order->details->sum('total') : $order->delivery->amount + $order->details->sum('total')) - ($order->payment_status == "Unpaid" ?  $order->customer->user->wallet : $order->wallet_debit),2) }} - <i>({{ $order->payment_status." / ".$order->payment_method }})</i>
                                    <br>{{ date("Y-m-d h:i:sa",$order->dated) }}
                                </p>
                            </div>
                        </div>
                    </a>
                    @endforeach
                </div>
                <!-- <a href="/orders/filter/{{ $confirmed->id }}">
                    <div class="text-center msg-footer">View All</div>
                </a> -->
            </div>
        </li>

        <!-- Preparing -->
        <li class="nav-item dropdown dropdown-large">
            <a class="nav-link dropdown-toggle dropdown-toggle-nocaret position-relative" title="Preparing" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                <i class='bx bx-shopping-bag'></i>
                <span class="alert-count">{{ \App\Models\Order::where('business_id','=',auth()->user()->business_id)->where('order_status_id','=',$preparing->id)->count() }}</span>
            </a>
            <div class="dropdown-menu dropdown-menu-end">
                <a href="/orders/filter/{{ $preparing->id }}">
                    <div class="msg-header">
                        <p class="msg-header-title">Preparing</p>
                        <!-- <p class="msg-header-clear ms-auto"></p> -->
                    </div>
                </a>
                <div class="header-notifications-list">
                    @foreach( \App\Models\Order::where('business_id','=',auth()->user()->business_id)->where('order_status_id','=',$preparing->id)->orderBy('id', 'DESC')->take(7)->get() as $index => $order)
                    <a class="dropdown-item" href="/orders/{{ $order->id }}">
                        <div class="d-flex align-items-center">
                            <div class="notify">
                                <img style="{{ ($order->customer->user->is_verified == true) ? 'border: 2.5px solid green' : 'border: 2.5px solid red' }}" src="{{ asset('assets/attachment/user/'.$order->customer->user->image) }}"  class="msg-avatar" alt="{{ $order->name }}">
                            </div>
                            <div class="flex-grow-1">
                                <h6 class="msg-name">
                                    {{ $order->order_no }}
                                    <span class="msg-time float-end">
                                        {{ Carbon\Carbon::parse(date("Y-m-d h:i:sa", strtotime($order->updated_at)))->diffForHumans() }}    
                                    </span>
                                </h6>
                                <hr style="margin: 3px">
                                <p class="msg-info">
                                    {{ $order->name }}, {{ $order->phone }}<br>
                                    <!-- {{ $order->address }} <br> -->
                                    PKR: {{ number_format(($order->details->sum('total') >= $order->delivery->free_delivery_after ? $order->details->sum('total') : $order->delivery->amount + $order->details->sum('total')) - ($order->payment_status == "Unpaid" ?  $order->customer->user->wallet : $order->wallet_debit),2) }} - <i>({{ $order->payment_status." / ".$order->payment_method }})</i>
                                    <br>{{ date("Y-m-d h:i:sa",$order->dated) }}
                                </p>
                            </div>
                        </div>
                    </a>
                    @endforeach
                </div>
                <!-- <a href="/orders/filter/{{ $preparing->id }}">
                    <div class="text-center msg-footer">View All</div>
                </a> -->
            </div>
        </li>

        <!-- Pick-Up -->
        <li class="nav-item dropdown dropdown-large">
            <a class="nav-link dropdown-toggle dropdown-toggle-nocaret position-relative" title="Pick-Up" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                <i class='bx bx-cycling'></i>
                <span class="alert-count">{{ \App\Models\Order::where('business_id','=',auth()->user()->business_id)->where('order_status_id','=',$pick_up->id)->count() }}</span>
            </a>
            <div class="dropdown-menu dropdown-menu-end">
                <a href="/orders/filter/{{ $pick_up->id }}">
                    <div class="msg-header">
                        <p class="msg-header-title">Pick-Up</p>
                        <!-- <p class="msg-header-clear ms-auto"></p> -->
                    </div>
                </a>
                <div class="header-notifications-list">
                    @foreach( \App\Models\Order::where('business_id','=',auth()->user()->business_id)->where('order_status_id','=',$pick_up->id)->orderBy('id', 'DESC')->take(7)->get() as $index => $order)
                    <a class="dropdown-item" href="/orders/{{ $order->id }}">
                        <div class="d-flex align-items-center">
                            <div class="notify">
                                <img style="{{ ($order->customer->user->is_verified == true) ? 'border: 2.5px solid green' : 'border: 2.5px solid red' }}" src="{{ asset('assets/attachment/user/'.$order->customer->user->image) }}"  class="msg-avatar" alt="{{ $order->name }}">
                            </div>
                            <div class="flex-grow-1">
                                <h6 class="msg-name">
                                    {{ $order->order_no }}
                                    <span class="msg-time float-end">
                                        {{ Carbon\Carbon::parse(date("Y-m-d h:i:sa", strtotime($order->updated_at)))->diffForHumans() }}    
                                    </span>
                                </h6>
                                <hr style="margin: 3px">
                                <p class="msg-info">
                                    {{ $order->name }}, {{ $order->phone }}<br>
                                    <!-- {{ $order->address }} <br> -->
                                    PKR: {{ number_format(($order->details->sum('total') >= $order->delivery->free_delivery_after ? $order->details->sum('total') : $order->delivery->amount + $order->details->sum('total')) - ($order->payment_status == "Unpaid" ?  $order->customer->user->wallet : $order->wallet_debit),2) }} - <i>({{ $order->payment_status." / ".$order->payment_method }})</i>
                                    <br>{{ date("Y-m-d h:i:sa",$order->dated) }}
                                </p>
                            </div>
                        </div>
                    </a>
                    @endforeach
                </div>
                <!-- <a href="/orders/filter/{{ $pick_up->id }}">
                    <div class="text-center msg-footer">View All</div>
                </a> -->
            </div>
        </li>

        <!-- Arrived -->
        <li class="nav-item dropdown dropdown-large">
            <a class="nav-link dropdown-toggle dropdown-toggle-nocaret position-relative" title="Arrived" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                <i class='bx bx-been-here'></i>
                <span class="alert-count">{{ \App\Models\Order::where('business_id','=',auth()->user()->business_id)->where('order_status_id','=',$arrived->id)->count() }}</span>
            </a>
            <div class="dropdown-menu dropdown-menu-end">
                <a href="/orders/filter/{{ $arrived->id }}">
                    <div class="msg-header">
                        <p class="msg-header-title">Arrived</p>
                        <!-- <p class="msg-header-clear ms-auto"></p> -->
                    </div>
                </a>
                <div class="header-message-list">
                    @foreach( \App\Models\Order::where('business_id','=',auth()->user()->business_id)->where('order_status_id','=',$arrived->id)->orderBy('id', 'DESC')->take(7)->get() as $index => $order)
                    <a class="dropdown-item" href="/orders/{{ $order->id }}">
                        <div class="d-flex align-items-center">
                            <div class="notify">
                                <img style="{{ ($order->customer->user->is_verified == true) ? 'border: 2.5px solid green' : 'border: 2.5px solid red' }}" src="{{ asset('assets/attachment/user/'.$order->customer->user->image) }}"  class="msg-avatar" alt="{{ $order->name }}">
                            </div>
                            <div class="flex-grow-1">
                                <h6 class="msg-name">
                                    {{ $order->order_no }}
                                    <span class="msg-time float-end">
                                        {{ Carbon\Carbon::parse(date("Y-m-d h:i:sa", strtotime($order->updated_at)))->diffForHumans() }}    
                                    </span>
                                </h6>
                                <hr style="margin: 3px">
                                <p class="msg-info">
                                    {{ $order->name }}, {{ $order->phone }}<br>
                                    <!-- {{ $order->address }} <br> -->
                                    PKR: {{ number_format(($order->details->sum('total') >= $order->delivery->free_delivery_after ? $order->details->sum('total') : $order->delivery->amount + $order->details->sum('total')) - ($order->payment_status == "Unpaid" ?  $order->customer->user->wallet : $order->wallet_debit),2) }} - <i>({{ $order->payment_status." / ".$order->payment_method }})</i>
                                    <br>{{ date("Y-m-d h:i:sa",$order->dated) }}
                                </p>
                            </div>
                        </div>
                    </a>
                    @endforeach
                </div>
                <!-- <a href="/orders/filter/{{ $arrived->id }}">
                    <div class="text-center msg-footer">View All Messages</div>
                </a> -->
            </div>
        </li>
        
        <!-- Delivered -->
        <li class="nav-item dropdown dropdown-large">
            <a class="nav-link dropdown-toggle dropdown-toggle-nocaret position-relative" title="Delivered" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                <i class='bx bx-door-open'></i>
                <span class="alert-count">{{ \App\Models\Order::where('business_id','=',auth()->user()->business_id)->where('order_status_id','=',$delivered->id)->count() }}</span>
            </a>
            <div class="dropdown-menu dropdown-menu-end">
                <a href="/orders/filter/{{ $delivered->id }}">
                    <div class="msg-header">
                        <p class="msg-header-title">Delivered</p>
                        <!-- <p class="msg-header-clear ms-auto"></p> -->
                    </div>
                </a>
                <div class="header-message-list">
                    @foreach( \App\Models\Order::where('business_id','=',auth()->user()->business_id)->where('order_status_id','=',$delivered->id)->orderBy('id', 'DESC')->take(7)->get() as $index => $order)
                    <a class="dropdown-item" href="/orders/{{ $order->id }}">
                        <div class="d-flex align-items-center">
                            <div class="notify">
                                <img style="{{ ($order->customer->user->is_verified == true) ? 'border: 2.5px solid green' : 'border: 2.5px solid red' }}" src="{{ asset('assets/attachment/user/'.$order->customer->user->image) }}"  class="msg-avatar" alt="{{ $order->name }}">
                            </div>
                            <div class="flex-grow-1">
                                <h6 class="msg-name">
                                    {{ $order->order_no }}
                                    <span class="msg-time float-end">
                                        {{ Carbon\Carbon::parse(date("Y-m-d h:i:sa", strtotime($order->updated_at)))->diffForHumans() }}    
                                    </span>
                                </h6>
                                <hr style="margin: 3px">
                                <p class="msg-info">
                                    {{ $order->name }}, {{ $order->phone }}<br>
                                    <!-- {{ $order->address }} <br> -->
                                    PKR: {{ number_format(($order->details->sum('total') >= $order->delivery->free_delivery_after ? $order->details->sum('total') : $order->delivery->amount + $order->details->sum('total')) - ($order->payment_status == "Unpaid" ?  $order->customer->user->wallet : $order->wallet_debit),2) }} - <i>({{ $order->payment_status." / ".$order->payment_method }})</i>
                                    <br>{{ date("Y-m-d h:i:sa",$order->dated) }}
                                </p>
                            </div>
                        </div>
                    </a>
                    @endforeach
                </div>
                <!-- <a href="/orders/filter/{{ $delivered->id }}">
                    <div class="text-center msg-footer">View All Messages</div>
                </a> -->
            </div>
        </li>

        <!-- Cancelled -->
        <li class="nav-item dropdown dropdown-large">
            <a class="nav-link dropdown-toggle dropdown-toggle-nocaret position-relative" title="Cancelled" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                <i class='bx bx-task-x'></i>
                <span class="alert-count">{{ \App\Models\Order::where('business_id','=',auth()->user()->business_id)->where('order_status_id','=',$cancelled->id)->count() }}</span>
            </a>
            <div class="dropdown-menu dropdown-menu-end">
                <a href="/orders/filter/{{ $cancelled->id }}">
                    <div class="msg-header">
                        <p class="msg-header-title">Cancelled</p>
                        <!-- <p class="msg-header-clear ms-auto"></p> -->
                    </div>
                </a>
                <div class="header-message-list">
                    @foreach( \App\Models\Order::where('business_id','=',auth()->user()->business_id)->where('order_status_id','=',$cancelled->id)->orderBy('id', 'DESC')->take(7)->get() as $index => $order)
                    <a class="dropdown-item" href="/orders/{{ $order->id }}">
                        <div class="d-flex align-items-center">
                            <div class="notify">
                                <img style="{{ ($order->customer->user->is_verified == true) ? 'border: 2.5px solid green' : 'border: 2.5px solid red' }}" src="{{ asset('assets/attachment/user/'.$order->customer->user->image) }}"  class="msg-avatar" alt="{{ $order->name }}">
                            </div>
                            <div class="flex-grow-1">
                                <h6 class="msg-name">
                                    {{ $order->order_no }}
                                    <span class="msg-time float-end">
                                        {{ Carbon\Carbon::parse(date("Y-m-d h:i:sa", strtotime($order->updated_at)))->diffForHumans() }}    
                                    </span>
                                </h6>
                                <hr style="margin: 3px">
                                <p class="msg-info">
                                    {{ $order->name }}, {{ $order->phone }}<br>
                                    <!-- {{ $order->address }} <br> -->
                                    PKR: {{ number_format(($order->details->sum('total') >= $order->delivery->free_delivery_after ? $order->details->sum('total') : $order->delivery->amount + $order->details->sum('total')) - ($order->payment_status == "Unpaid" ?  $order->customer->user->wallet : $order->wallet_debit),2) }} - <i>({{ $order->payment_status." / ".$order->payment_method }})</i>
                                    <br>{{ date("Y-m-d h:i:sa",$order->dated) }}
                                </p>
                            </div>
                        </div>
                    </a>
                    @endforeach
                </div>
                <!-- <a href="/orders/filter/{{ $cancelled->id }}">
                    <div class="text-center msg-footer">View All Messages</div>
                </a> -->
            </div>
        </li>

        <!-- Shortcuts -->
        {{-- <li class="nav-item dropdown dropdown-large">
            <a class="nav-link dropdown-toggle dropdown-toggle-nocaret" title="Shortcuts" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                <i class='bx bx-category' style="font-size:25px;"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-end">
                <div class="row row-cols-3 g-3 p-3">
                    <div class="col text-center">
                        <a href="/orders">
                            <div class="app-box mx-auto bg-gradient-kyoto text-dark"><i class='bx bx-cart'></i>
                            </div>
                            <div class="app-title">Orders</div>
                        </a>
                    </div>
                    <div class="col text-center">
                        <a href="/order/purchase">
                            <div class="app-box mx-auto bg-gradient-blues text-dark"><i class='bx bx-file'></i>
                            </div>
                            <div class="app-title">Purchase Order</div>
                        </a>
                    </div>
                    <div class="col text-center">
                        <a href="#">
                            <div class="app-box mx-auto bg-gradient-burning text-white"><i class='bx bx-data'></i>
                            </div>
                            <div class="app-title">Activity Log</div>
                        </a>
                    </div>
                    <div class="col text-center">
                        <a href="/products">
                            <div class="app-box mx-auto bg-gradient-cosmic text-white"><i class='bx bx-box'></i>
                            </div>
                            <div class="app-title">Products</div>
                        </a>
                    </div>
                    <div class="col text-center">
                        <a href="/share/catalogue">
                            <div class="app-box mx-auto bg-gradient-lush text-white"><i class='bx bx-shield'></i>
                            </div>
                            <div class="app-title">Share Catalogue</div>
                        </a>
                    </div>
                    <div class="col text-center">
                        <a href="#">
                            <div class="app-box mx-auto bg-gradient-moonlit text-white"><i class='bx bx-filter-alt'></i>
                            </div>
                            <div class="app-title">--</div>
                        </a>
                    </div>
                </div>
            </div>
        </li> --}}
    </ul>
</div>
