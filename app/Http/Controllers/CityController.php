<?php

namespace App\Http\Controllers;

use App\Models\City;
use Illuminate\Http\Request;

class CityController extends Controller
{
    public function index()
    {
        return view('admin.city.app');
    }

    public function submit(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'state' => 'required'
        ]);
        // return $request->all();
        $city = new City();
        $city->state = $request->state;
        $city->name = $request->name;
        // dd($city);
        $city->save();
        return back()->with('success', 'City Added Successfully!');
    }

    public function update(Request $request, City $city)
    {
        $request->validate([
            'name' => 'required',
            'state' => 'required'
        ]);
        // return $request->all();
        $city->state = $request->state;
        $city->name = $request->name;
        // dd($city);
        $city->save();
        return back()->with('success', 'City Updated Successfully!');
    }

    public function delete(City $city)
    {
        $city->delete();
        return back()->with('success', 'City Deleted Successfully!');
    }
}
