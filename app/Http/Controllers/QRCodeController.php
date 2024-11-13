<?php

namespace App\Http\Controllers;

use App\Models\ProductModel;
use Illuminate\Http\Request;

class QRCodeController extends Controller
{
    public function list(Request $request)
    {
        $data['getRecord'] = ProductModel::get();
        return view('admin.qrcode.list', $data);
    }

    public function add_qrcode(Request $request)
    {
        return view('admin.qrcode.add');
    }

    public function store_qrcode(Request $request)
    {
        // dd($request->all());
        $randNum = mt_rand(999999999, 11111111111);
        $save = new ProductModel;
        $save->title = trim($request->title);
        $save->price = trim($request->price);
        $save->product_code = $randNum;
        $save->description = trim($request->description);
        $save->save();

        return redirect('admin/qrcode')->with('success', "QRCode Successfully Added");
    }
}
