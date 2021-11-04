<?php

use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;
use App\Models\Business;



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/clear', function() {
    Artisan::call('cache:clear');
    Artisan::call('view:clear');
    Artisan::call('config:clear');
    session()->flash('success','Application cache flushed.');

    return redirect()->to('https://sabzify.pk');
});

Route::get('/', function () {
    $business = Business::where('id','=',1)->first();
    return view('store', compact('business'));
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::resource('/customers', App\Http\Controllers\CustomerController::class);
Route::get('/customers/is_available/{id}', [App\Http\Controllers\CustomerController::class, 'is_available'])->name('is_available');

Route::resource('/suppliers', App\Http\Controllers\SupplierController::class);
Route::get('/suppliers/is_available/{id}', [App\Http\Controllers\SupplierController::class, 'is_available'])->name('is_available');

Route::resource('/businesses', App\Http\Controllers\BusinessController::class);
Route::get('/businesses/is_available/{id}', [App\Http\Controllers\BusinessController::class, 'is_available'])->name('is_available');

Route::resource('/users', App\Http\Controllers\UserController::class);
Route::get('/profile/{id}', [App\Http\Controllers\UserController::class, 'profile'])->name('profile');
Route::post('/profile/{id}/update', [App\Http\Controllers\UserController::class, 'profile_update'])->name('profile_update');
Route::get('/users/is_available/{id}', [App\Http\Controllers\UserController::class, 'is_available'])->name('is_available');

Route::resource('/roles', App\Http\Controllers\RoleController::class);

Route::resource('/expenses', App\Http\Controllers\ExpenseController::class);
Route::get('/expenses/is_available/{id}', [App\Http\Controllers\ExpenseController::class, 'is_available'])->name('is_available');

Route::resource('/fixes', App\Http\Controllers\FixController::class);
Route::get('/fixes/is_available/{id}', [App\Http\Controllers\FixController::class, 'is_available'])->name('is_available');

Route::resource('/accounts', App\Http\Controllers\AccountController::class);
Route::get('/deposit', [App\Http\Controllers\AccountController::class, 'deposit'])->name('deposit');
Route::post('/deposit/store', [App\Http\Controllers\AccountController::class, 'deposit_store'])->name('deposit_store');
Route::get('/accounts/is_available/{id}', [App\Http\Controllers\AccountController::class, 'is_available'])->name('is_available');

Route::resource('/transactions', App\Http\Controllers\TransactionController::class);
Route::get('/transactions/is_available/{id}', [App\Http\Controllers\TransactionController::class, 'is_available'])->name('is_available');

Route::resource('/heads', App\Http\Controllers\HeadController::class);
Route::get('/heads/is_available/{id}', [App\Http\Controllers\HeadController::class, 'is_available'])->name('is_available');

Route::resource('/categories', App\Http\Controllers\CategoryController::class);
Route::get('/categories/is_available/{id}', [App\Http\Controllers\CategoryController::class, 'is_available'])->name('is_available');

Route::resource('/units', App\Http\Controllers\UnitController::class);
Route::get('/units/is_available/{id}', [App\Http\Controllers\UnitController::class, 'is_available'])->name('is_available');

Route::resource('/products', App\Http\Controllers\ProductController::class);
Route::get('/products/is_highlight/{id}', [App\Http\Controllers\ProductController::class, 'is_highlight'])->name('is_highlight');
Route::get('/products/is_available/{id}', [App\Http\Controllers\ProductController::class, 'is_available'])->name('is_available');
Route::get('/products/pricing/form', [App\Http\Controllers\ProductController::class, 'pricing'])->name('pricing');
Route::post('/products/pricing/update', [App\Http\Controllers\ProductController::class, 'pricing_update'])->name('pricing_update');

Route::get('/catalogue/{id}', [App\Http\Controllers\ProductController::class, 'catalogue'])->name('catalogue');

Route::get('/share/price', [App\Http\Controllers\ShareController::class, 'price'])->name('price');

Route::resource('/badges', App\Http\Controllers\BadgeController::class);
Route::get('/badges/is_available/{id}', [App\Http\Controllers\BadgeController::class, 'is_available'])->name('is_available');

Route::resource('/deliveries', App\Http\Controllers\DeliveryController::class);
Route::get('/deliveries/is_available/{id}', [App\Http\Controllers\DeliveryController::class, 'is_available'])->name('is_available');

Route::resource('/orders', App\Http\Controllers\OrderController::class);
Route::get('/order/purchase', [App\Http\Controllers\OrderController::class, 'purchase'])->name('purchase');
Route::post('/order/search', [App\Http\Controllers\OrderController::class, 'search'])->name('search');
Route::post('/order_status/change', [App\Http\Controllers\OrderController::class, 'order_status'])->name('order_status');
Route::post('/payment_status/change', [App\Http\Controllers\OrderController::class, 'payment_status'])->name('payment_status');
Route::post('/rider_status/change', [App\Http\Controllers\OrderController::class, 'rider_status'])->name('rider_status');
Route::get('/orders/filter/{id}', [App\Http\Controllers\OrderController::class, 'filter'])->name('filter');
Route::get('/orders/slip/{id}', [App\Http\Controllers\OrderController::class, 'slip'])->name('slip');
Route::get('/orders/pay_bill/{id}', [App\Http\Controllers\OrderController::class, 'pay_bill'])->name('pay_bill');
Route::post('/orders/pay_bill/{order}/update', [App\Http\Controllers\OrderController::class, 'pay_bill_update'])->name('pay_bill_update');

Route::resource('/order_details', App\Http\Controllers\OrderDetailController::class);

Route::resource('/riders', App\Http\Controllers\RiderController::class);
Route::get('/riders/is_available/{id}', [App\Http\Controllers\RiderController::class, 'is_available'])->name('is_available');

Route::resource('/messages', App\Http\Controllers\MessageController::class);

Route::resource('/activities', App\Http\Controllers\ActivityController::class);

Route::resource('/fcm', App\Http\Controllers\FcmController::class);

Route::resource('/sms', App\Http\Controllers\SmsController::class);

Route::resource('/whatsapp', App\Http\Controllers\WhatsAppController::class);

Route::get('/active_users', [App\Http\Controllers\ReportController::class, 'active_users'])->name('active_users');
