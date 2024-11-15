<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ColourModel;

class ColourController extends Controller
{
    public function colour_list(Request $request)
    {
        $data['getRecord'] = ColourModel::get();
        return view('admin.colour.list', $data);
    }

    public function add_colour(Request $request)
    {
        return view('admin.colour.add');
    }

    public function store_colour(Request $request)
    {
        $save = new ColourModel;
        $save->name = trim($request->name);
        $save->save();

        return redirect('admin/colour')->with("success", "Colour Successfully Added!");
    }
}
