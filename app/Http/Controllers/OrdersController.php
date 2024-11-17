<?php

namespace App\Http\Controllers;

use App\Models\OrdersDetailsModel;
use App\Models\OrdersModel;
use Illuminate\Http\Request;
use App\Models\ProductModel;
use App\Models\ColourModel;

class OrdersController extends Controller
{
    public function list_order(Request $request)
    {
        $data['getOrder'] = OrdersModel::getRecord();
        return view('admin.order.list', $data);
    }

    public function add_order(Request $request)
    {
        $data['getProduct'] = ProductModel::get();
        $data['getColour'] = ColourModel::get();
        return view('admin.order.add', $data);
    }

    public function store_order(Request $request)
    {
        // dd($request->all());
        $save = new OrdersModel;
        $save->product_id = trim($request->product_id);
        $save->qtys = trim($request->qtys);
        $save->save();

        if (!empty($request->colour_id)) {
            foreach ($request->colour_id as $colour_id) {
                $orders = new OrdersDetailsModel;
                $orders->orders_id = $save->id;
                $orders->colour_id = $colour_id;
                $orders->save();

                return redirect('admin/order')->with('success', "Order Successfully Created!");
            }
        }
    }
}
