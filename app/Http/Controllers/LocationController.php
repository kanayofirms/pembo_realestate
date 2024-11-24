<?php

namespace App\Http\Controllers;

use App\Models\StateModel;
use Illuminate\Http\Request;
use App\Models\CountriesModel;

class LocationController extends Controller
{
    public function countries_index(Request $request)
    {
        $data['getRecord'] = CountriesModel::get();
        return view('admin.countries.list', $data);
    }

    public function countries_add()
    {
        return view('admin.countries.add');
    }

    public function countries_store(Request $request)
    {
        $save = new CountriesModel;
        $save->country_name = trim($request->country_name);
        $save->save();

        return redirect('admin/countries')->with('success', "Country Successfully Added!");
    }

    public function countries_edit($id)
    {
        $data['getRecord'] = CountriesModel::find($id);
        return view('admin.countries.edit', $data);
    }

    public function countries_update($id, Request $request)
    {
        $save = CountriesModel::find($id);
        $save->country_name = trim($request->country_name);
        $save->save();

        return redirect('admin/countries')->with('success', "Country Successfully Updated!");
    }

    public function countries_delete($id)
    {
        $recordDelete = CountriesModel::find($id);
        $recordDelete->delete();

        return redirect('admin/countries')->with('success', "Record Successfully Deleted!");
    }

    public function state_list()
    {
        $data['getRecord'] = StateModel::get();
        return view('admin.state.list', $data);
    }

    public function state_add(Request $request)
    {
        return view('admin.state.add');
    }
}
