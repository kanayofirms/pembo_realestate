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
        $data['getOrder'] = OrdersModel::getRecord($request);//update getRecord function with $request param
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
        // Create a new order
        $save = new OrdersModel;
        $save->product_id = trim($request->product_id);
        $save->qtys = trim($request->qtys);
        $save->save();

        // Check if colour_ids are provided
        if (!empty($request->colour_id)) {
            // Loop through all provided colour_ids and save them with the same order_id
            foreach ($request->colour_id as $colour_id) {
                $order = new OrdersDetailsModel;
                $order->orders_id = $save->id;  // Assign the order_id from the saved order
                $order->colour_id = $colour_id; // Assign the current colour_id
                $order->save();  // Save each order detail
            }
        }

        // Redirect after saving all order details
        return redirect('admin/order')->with('success', "Order Successfully Created!");
    }

    public function edit_order($id)
    {
        $data['getProduct'] = ProductModel::get();
        $data['getColour'] = ColourModel::get();
        $data['getRecord'] = OrdersModel::find($id);
        $data['getOrderDetail'] = OrdersDetailsModel::where('orders_id', '=', $id)->get();
        return view('admin.order.edit', $data);
    }

    public function update_order($id, Request $request)
    {
        // dd($request->all());
        $save = OrdersModel::find($id);
        $save->product_id = trim($request->product_id);
        $save->qtys = trim($request->qtys);
        $save->save();

        OrdersDetailsModel::where('orders_id', '=', $save->id)->delete();
        if (!empty($request->colour_id)) {
            // Loop through all provided colour_ids and save them with the same order_id
            foreach ($request->colour_id as $colour_id) {
                $order = new OrdersDetailsModel;
                $order->orders_id = $save->id;  // Assign the order_id from the saved order
                $order->colour_id = $colour_id; // Assign the current colour_id
                $order->save();  // Save each order detail
            }
        }

        // Redirect after saving all order details
        return redirect('admin/order')->with('success', "Order Successfully Updated!");
    }

    public function delete_order($id)
    {
        $deleteRecord = OrdersModel::find($id);
        $deleteRecord->delete();

        OrdersDetailsModel::where('orders_details.orders_id', '=', $id)->delete();

        return redirect()->back()->with('success', "Record Successfully Deleted!");
    }
}
