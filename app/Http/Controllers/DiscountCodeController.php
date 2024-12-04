<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DiscountCodeModel;
use Auth;

class DiscountCodeController extends Controller
{
    public function discount_code()
    {
        $data['getRecord'] = DiscountCodeModel::get();
        return view('admin.discount_code.list', $data);
    }

    public function discount_code_add()
    {
        return view('admin.discount_code.add');
    }

    public function discount_code_store(Request $request)
    {
        $save = new DiscountCodeModel;
        $save->user_id = Auth::user()->id;
        $save->discount_code = trim($request->discount_code);
        $save->discount_price = trim($request->discount_price);
        $save->expiry_date = $request->expiry_date;
        $save->type = $request->type;
        $save->usages = $request->usages;
        $save->save();

        return redirect('admin/discount_code')->with('success', 'Discount Code Successfully Saved!');
    }
}
