<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class FrontEndController extends Controller
{
    public function index() {
        $products = Product::all();
        return view('frontend.index', compact('products')); 
    }

    public function show($id) {
        $product = Product::find($id);
        return view('frontend.product-detail', compact('product'));
    }


}
