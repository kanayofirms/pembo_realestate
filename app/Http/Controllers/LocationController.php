<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CountriesModel;

class LocationController extends Controller
{
    public function countries_index(Request $request)
    {
        $data['getRecord'] = CountriesModel::get();
        return view('admin.location.list', $data);
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
}
