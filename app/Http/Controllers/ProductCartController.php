<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProductCartModel;
use Str;

class ProductCartController extends Controller
{

    public function index()
    {
        return view('product_cart.products');
    }

    public function cart()
    {
        return view('product_cart.cart');
    }
    public function admin_product_cart(Request $request)
    {
        $getRecord = ProductCartModel::orderBy('id', 'desc');

        // Search Start
        if (!empty($request->id)) {
            $getRecord = $getRecord->where('product_cart.id', '=', $request->id);
        }

        if (!empty($request->name)) {
            $getRecord = $getRecord->where('product_cart.name', 'like', '%' . $request->name . '%');
        }

        if (!empty($request->price)) {
            $getRecord = $getRecord->where('product_cart.price', 'like', '%' . $request->price . '%');
        }

        if (!empty($request->created_at)) {
            $getRecord = $getRecord->where('product_cart.created_at', 'like', '%' . $request->created_at . '%');
        }

        if (!empty($request->updated_at)) {
            $getRecord = $getRecord->where('product_cart.updated_at', 'like', '%' . $request->updated_at . '%');
        }

        $getRecord = $getRecord->paginate(40);
        $data['getRecord'] = $getRecord;
        return view('admin.product_cart.list', $data);
    }

    public function admin_product_add()
    {
        return view('admin.product_cart.add');
    }

    public function admin_product_store(Request $request)
    {
        $save = new ProductCartModel;
        $save->name = trim($request->name);
        $save->description = trim($request->description);
        $save->price = trim($request->price);

        if (!empty($request->file('image'))) {
            $file = $request->file('image');
            $randomStr = Str::random(30);
            $filename = $randomStr . '.' . $file->getClientOriginalExtension();
            $file->move('product/', $filename);
            $save->image = $filename;
        }
        $save->save();
        return redirect('admin/product_cart')->with('success', "Product Successfully Added!");
    }

    public function admin_product_edit($id)
    {
        $data['getRecord'] = ProductCartModel::find($id);
        return view('admin.product_cart.edit', $data);
    }

    public function admin_product_update($id, Request $request)
    {
        $save = ProductCartModel::find($id);
        $save->name = trim($request->name);
        $save->description = trim($request->description);
        $save->price = trim($request->price);

        if (!empty($request->file('image'))) {
            $file = $request->file('image');
            $randomStr = Str::random(30);
            $filename = $randomStr . '.' . $file->getClientOriginalExtension();
            $file->move('product/', $filename);
            $save->image = $filename;
        }
        $save->save();
        return redirect('admin/product_cart')->with('success', "Product Successfully Updated!");
    }

    public function admin_product_delete($id)
    {
        $recordDelete = ProductCartModel::find($id);
        $recordDelete->delete();

        return redirect('admin/product_cart')->with('success', "Product Successfully Deleted From Cart.");
    }
}
