<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class QRCodeController extends Controller
{
    public function list(Request $request)
    {
        return view('admin.qrcode.list');
    }

    public function add_qrcode(Request $request)
    {
        return view('admin.qrcode.add');
    }
}
