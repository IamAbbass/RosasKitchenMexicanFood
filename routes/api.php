<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// On Board (Create Token)
Route::get('/welcome', [App\Http\Controllers\ApiController::class, 'welcome']);

// Authentication
Route::get('/auth', [App\Http\Controllers\ApiController::class, 'auth']);

// Update FCM Token
Route::get('/fcm', [App\Http\Controllers\ApiController::class, 'fcm']);

// Fetch All Categories
Route::get('/category', [App\Http\Controllers\ApiController::class, 'category']);

// Fetch All Products
Route::get('/product', [App\Http\Controllers\ApiController::class, 'product']);

// Fetch All Products By Category ID
Route::get('/category/{id}', [App\Http\Controllers\ApiController::class, 'category_products']);

// Fetch Product By ID
Route::get('/product/{id}', [App\Http\Controllers\ApiController::class, 'product_view']);

// Fetch All Delivery
Route::get('/delivery/options', [App\Http\Controllers\ApiController::class, 'delivery']);

// Order Timings
Route::get('/order/timings', [App\Http\Controllers\ApiController::class, 'order_timings']);

// Place An Order
Route::get('/order', [App\Http\Controllers\ApiController::class, 'order']);

// Fetch All Orders
Route::get('/myorders', [App\Http\Controllers\ApiController::class, 'myorders']);

// Order Details
Route::get('/myorders_details', [App\Http\Controllers\ApiController::class, 'myorders_details']);

// Order Tracking
Route::get('/tracking', [App\Http\Controllers\ApiController::class, 'order_tracking']);

// User Profile
Route::get('/profile', [App\Http\Controllers\ApiController::class, 'profile']);

// User Profile Update
Route::get('/profile/update', [App\Http\Controllers\ApiController::class, 'profile_update']);
