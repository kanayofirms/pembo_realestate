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
}
