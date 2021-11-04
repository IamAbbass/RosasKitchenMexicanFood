<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ShareController extends Controller
{
    public function price()
    {
        $catelogue = "Price list";
        $products = Product::where('business_id','=',auth()->user()->business_id)->where('is_available',true)->orderBy('id', 'ASC')->get();
        return view('products.price', compact('products','catelogue'));
    }
}
