<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProductCartModel;

class ProductCartController extends Controller
{
    public function admin_product_cart(Request $request)
    {
        return view('admin.product_cart.list');
    }
}
