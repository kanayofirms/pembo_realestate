<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProductModel;
use App\Models\ColourModel;

class OrderController extends Controller
{
    public function list_order(Request $request)
    {
        return view('admin.order.list');
    }

    public function add_order(Request $request)
    {
        $data['getProduct'] = ProductModel::get();
        $data['getColour'] = ColourModel::get();
        return view('admin.order.add', $data);
    }
}
