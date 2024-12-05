<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DiscountCodeModel;
use App\Models\User;
use Auth;

class DiscountCodeController extends Controller
{
    public function discount_code()
    {
        // $data['getRecord'] = DiscountCodeModel::get();
        $data['getRecord'] = DiscountCodeModel::getAllRecord();
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

    public function discount_code_edit($id)
    {
        $data['getUser'] = User::get();
        $data['getRecord'] = DiscountCodeModel::find($id);
        return view('admin.discount_code.edit', $data);
    }

    public function discount_code_update($id, Request $request){
        $save = DiscountCodeModel::find($id);
        $save->user_id = $request->user_id;
        $save->discount_code = trim($request->discount_code);
        $save->discount_price = trim($request->discount_price);
        $save->expiry_date = $request->expiry_date;
        $save->type = $request->type;
        $save->usages = $request->usages;
        $save->save();

        return redirect('admin/discount_code')->with('success', 'Discount Code Successfully Updated!');
    }
}
