<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DiscountCodeController extends Controller
{
    public function discount_code()
    {
        return view('admin.discount_code.list');
    }

    public function discount_code_add()
    {
        return view('admin.discount_code.add');
    }
}
