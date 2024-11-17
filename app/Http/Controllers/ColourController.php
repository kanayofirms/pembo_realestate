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

    public function edit_colour($id)
    {
        $data['getRecord'] = ColourModel::find($id);
        return view('admin.colour.edit', $data);
    }

    public function update_colour($id, Request $request)
    {
        $save = ColourModel::find($id);
        $save->name = trim($request->name);
        $save->save();

        return redirect('admin/colour')->with("success", "Colour Successfully Updated!");
    }

    public function delete_colour($id, Request $request)
    {
        $save = ColourModel::find($id);
        $save->delete();

        return redirect('admin/colour')->with("success", "Colour Successfully Deleted!");
    }
}
