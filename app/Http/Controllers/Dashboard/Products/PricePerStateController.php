<?php

namespace App\Http\Controllers\Dashboard\Products;

use App\Models\Product;
use App\Http\Controllers\Controller;

class PricePerStateController extends Controller
{
    //

    public function index($product_id)
    {
        $product = Product::with('prices')->findOrFail($product_id);
        //
        return view('pages.products.prices', compact('product'));
    }
}
