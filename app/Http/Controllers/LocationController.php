<?php

namespace App\Http\Controllers;

use App\Models\StateModel;
use Illuminate\Http\Request;
use App\Models\CountriesModel;
use App\Models\CityModel;

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
        $data['getRecord'] = StateModel::select('state.*', 'countries.country_name')
            ->join('countries', 'countries.id', '=', 'state.countries_id')
            ->orderBy('state.state_name', 'desc')  // Optional: ordering states alphabetically
            ->get();

        return view('admin.state.list', $data);
    }

    public function state_add(Request $request)
    {
        $data['getCountries'] = CountriesModel::get();
        return view('admin.state.add', $data);
    }

    public function state_store(Request $request)
    {
        $save = new StateModel;
        $save->countries_id = trim($request->countries_id);
        $save->state_name = trim($request->state_name);
        $save->save();

        return redirect('admin/state')->with('success', "State Successfully Added!");
    }

    public function state_edit($id)
    {
        $data['getCountries'] = CountriesModel::get();
        $data['getRecord'] = StateModel::find($id);
        return view('admin.state.edit', $data);
    }

    public function state_update($id, Request $request)
    {
        $save = StateModel::find($id);
        $save->countries_id = trim($request->countries_id);
        $save->state_name = trim($request->state_name);
        $save->save();

        return redirect('admin/state')->with('success', "State Successfully Updated!");
    }

    public function state_delete($id)
    {
        $recordDelete = StateModel::find($id);
        $recordDelete->delete();

        return redirect('admin/state')->with('success', 'Record Successfully Deleted!');
    }

    // City start
    public function city_list()
    {
        $data['getRecord'] = CityModel::getRecordJoin();
        return view('admin.city.list', $data);
    }

    public function city_add(Request $request)
    {
        $data['getCountries'] = CountriesModel::get();
        return view('admin.city.add', $data);
    }

    public function city_store(Request $request)
    {
        // dd($request->all());
        $save = new CityModel;
        $save->countries_id = trim($request->countries_id);
        $save->state_id = trim($request->state_id);
        $save->city_name = trim($request->city_name);

        $save->save();

        return redirect('admin/city')->with('success', "City Successfully Added!");
    }

    public function get_state_name($countryId, Request $request)
    {
        $states = StateModel::where('countries_id', $countryId)->get();
        return response()->json($states);
    }
}
