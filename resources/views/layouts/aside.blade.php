<div class="sidebar-wrapper" data-simplebar="true">
    <div class="sidebar-header">
        <div>
            <a href="/home"><img src="{{ asset('assets/attachment/business/'.auth()->user()->business->icon) }}" class="logo-icon" alt="logo icon"></a>
        </div>

        <div class="text-center">
            <a href="/home"><h4 class="logo-text">{{ auth()->user()->business->name }}<br><small>{{ auth()->user()->business->phone }}</small></h4></a>
        </div>
        <div class="toggle-icon ms-auto"><i class='bx bx-arrow-to-left'></i></div>
    </div>
    <!--navigation-->
    <ul class="metismenu" id="menu">
        <li>
            <a href="/">
                <div class="parent-icon"><i class='bx bx-globe'></i></div>
                <div class="menu-title">Website</div>
            </a>
        </li>
        <!-- <li class="menu-label">General</li> -->
        <li>
            <a class="has-arrow" href="javascript:;">
                <div class="parent-icon"><i class="bx bx-book-content"></i>
                </div>
                <div class="menu-title">Contacts</div>
            </a>
            <ul>
                @canany(['isOwner','isAdmin'])
                <li> <a class="has-arrow" href="javascript:;"><i class="bx bx-right-arrow-alt"></i>Business & Users</a>
                    <ul>
                        <li> <a href="/businesses"><i class="bx bx-right-arrow-alt"></i>Business</a> </li>
                        <li> <a href="/users"><i class="bx bx-right-arrow-alt"></i>Users</a> </li>
                    </ul>
                </li>
                @endcanany
                <li> <a href="/customers"><i class="bx bx-right-arrow-alt"></i>Customers</a> </li>
                <li> <a href="/suppliers"><i class="bx bx-right-arrow-alt"></i>Suppliers</a> </li>
                <li> <a href="/riders"><i class="bx bx-right-arrow-alt"></i>Riders</a> </li>
            </ul>
        </li>

        <li>
            <a class="has-arrow" href="javascript:;">
                <div class="parent-icon"><i class="bx bx-radar"></i>
                </div>
                <div class="menu-title">Marketing</div>
            </a>
            <ul class="mm-collapse">
                <li> <a href="/fcm"><i class="bx bx-right-arrow-alt"></i>FCM Marketing</a> </li>
                <li> <a href="/sms"><i class="bx bx-right-arrow-alt"></i>Send Message</a> </li>
                <li> <a href="/whatsapp"><i class="bx bx-right-arrow-alt"></i>Send WhatsApp</a> </li>
                <li> <a href="/share/price" target="_blank"><i class="bx bx-right-arrow-alt"></i>Share Price List</a></li>
                <li> <a href="/catalogue/1" target="_blank"><i class="bx bx-right-arrow-alt"></i>Wholesale Catalogue</a> </li>
                <li> <a href="/catalogue/2" target="_blank"><i class="bx bx-right-arrow-alt"></i>Retail Catalogue</a> </li>
            </ul>
        </li>
        <li>
            <a class="has-arrow" href="javascript:;">
                <div class="parent-icon"><i class="bx bx-box"></i>
                </div>
                <div class="menu-title">Products</div>
            </a>
            <ul class="mm-collapse">
                <li> <a href="/products"><i class="bx bx-right-arrow-alt"></i>Products</a> </li>
                <li> <a href="/products/1/edit"><i class="bx bx-right-arrow-alt"></i>Products Update Que</a> </li>
                <li> <a href="/products/pricing/form" target="_blank"><i class="bx bx-right-arrow-alt"></i>Re-Pricing Form</a> </li>
                <li><hr style="margin: 0"></li>
                <li> <a href="/categories"><i class="bx bx-right-arrow-alt"></i>Categories</a> </li>
                <li> <a href="/units"><i class="bx bx-right-arrow-alt"></i>Units</a> </li>
                <li> <a href="/badges"><i class="bx bx-right-arrow-alt"></i>Badges</a> </li>
            </ul>
        </li>
        <li>
            <a class="has-arrow" href="javascript:;">
                <div class="parent-icon"><i class="bx bx-cart"></i>
                </div>
                <div class="menu-title">Orders</div>
            </a>
            <ul class="mm-collapse">
                <li> <a href="/orders"><i class="bx bx-right-arrow-alt"></i>All Orders</a> </li>
                <li> <a class="has-arrow" href="javascript:;"><i class="bx bx-right-arrow-alt"></i>Order Details</a>
                    <ul>
                        <li> <a href="/orders/filter/1"><i class="bx bx-right-arrow-alt"></i>Confirmed</a> </li>
                        <li> <a href="/orders/filter/2"><i class="bx bx-right-arrow-alt"></i>Prepairing</a> </li>
                        <li> <a href="/orders/filter/3"><i class="bx bx-right-arrow-alt"></i>Picked Up</a> </li>
                        <li> <a href="/orders/filter/4"><i class="bx bx-right-arrow-alt"></i>Arrived</a> </li>
                        <li> <a href="/orders/filter/5"><i class="bx bx-right-arrow-alt"></i>Delivered</a> </li>
                        <li> <a href="/orders/filter/6"><i class="bx bx-right-arrow-alt"></i>Cancelled</a> </li>
                    </ul>
                </li>
                <li> <a href="/order/purchase"  target="_blank"><i class="bx bx-right-arrow-alt"></i>Purchser Order</a> </li>
                <li><hr style="margin: 0"></li>
                <li> <a href="/messages"><i class="bx bx-right-arrow-alt"></i>Order Message</a> </li>
                <li> <a href="javascript:;"><i class="bx bx-right-arrow-alt"></i>Order Timings</a></li>
                <li> <a href="/deliveries"><i class="bx bx-right-arrow-alt"></i>Delivery Charges</a> </li>
            </ul>
        </li>
        <li>
            <a class="has-arrow" href="javascript:;">
                <div class="parent-icon"><i class="bx bx-wallet"></i>
                </div>
                <div class="menu-title">Expenses</div>
            </a>
            <ul>
                <li> <a href="/heads"><i class="bx bx-right-arrow-alt"></i>Expense Head</a> </li>
                <li> <a href="/expenses/create"><i class="bx bx-right-arrow-alt"></i>Add Expense</a> </li>
                <li> <a href="/expenses"><i class="bx bx-right-arrow-alt"></i>Expense List</a> </li>
            </ul>
        </li>
        <li>
            <a class="has-arrow" href="javascript:;">
                <div class="parent-icon"><i class="lni lni-bricks"></i>
                </div>
                <div class="menu-title">Fixed Assets</div>
            </a>
            <ul>
                <li> <a href="/fixes/create"><i class="bx bx-right-arrow-alt"></i>Add Assets</a> </li>
                <li> <a href="/fixes"><i class="bx bx-right-arrow-alt"></i>Assets List</a> </li>
            </ul>
        </li>
        <li>
            <a class="has-arrow" href="javascript:;">
                <div class="parent-icon"><i class="bx bx-buildings"></i>
                </div>
                <div class="menu-title">Bank Accounts</div>
            </a>
            <ul>
                <li> <a href="/transactions"><i class="bx bx-right-arrow-alt"></i>Transactions</a> </li>
                <li> <a href="/accounts"><i class="bx bx-right-arrow-alt"></i>Account List</a> </li>
                <li> <a href="/accounts/create"><i class="bx bx-right-arrow-alt"></i>Add Account</a> </li>
            </ul>
        </li>

        @canany(['isOwner','isAdmin'])
        <li>
            <a class="has-arrow" href="javascript:;">
                <div class="parent-icon"><i class="bx bx-printer"></i>
                </div>
                <div class="menu-title">Reports</div>
            </a>
            <ul>
                <li> <a href="/active_users" target="_blank"><i class="bx bx-right-arrow-alt"></i>Active Map</a> </li>
                <li> <a href="/activities" target="_blank"><i class="bx bx-right-arrow-alt"></i>Activity Log</a> </li>
            </ul>
        </li>
        @endcanany
    </ul>
    <!--end navigation-->
</div>