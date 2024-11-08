<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\WeekModel;

class UserTimeController extends Controller
{
    public function week_list(Request $request)
    {
        $data['getRecord'] = WeekModel::get();
        return view('admin.week.list', $data);
    }

    public function week_add(Request $request)
    {
        return view('admin.week.add');
    }

    public function week_store(Request $request)
    {
        // dd($request->all());
        $save = new WeekModel;
        $save->name = trim($request->name);
        $save->save();

        return redirect('admin/week')->with('success', "Week Added Successfully.");
    }
}
