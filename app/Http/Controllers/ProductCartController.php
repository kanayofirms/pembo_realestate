<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProductCartModel;
use Str;

class ProductCartController extends Controller
{
    public function admin_product_cart(Request $request)
    {
        return view('admin.product_cart.list');
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
}
