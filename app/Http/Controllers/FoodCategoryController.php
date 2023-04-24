<?php

namespace App\Http\Controllers;

use App\Models\FoodCategory;
use Illuminate\Http\Request;

class FoodCategoryController extends Controller
{
    public function index()
    {
        return view('admin.FoodCategory.app');
    }

    public function submit(Request $request)
    {
        $request->validate([
            'name' => 'required'
        ]);
        // return $request->all();
        $foodCategory = new FoodCategory();
        $foodCategory->name = $request->name;
        // dd($foodCategory);
        $foodCategory->save();
        return back()->with('success', 'Food Category Added Successfully!');
    }

    public function update(Request $request, FoodCategory $foodCat)
    {
        $request->validate([
            'name' => 'required'
        ]);
        // return $request->all();
        $foodCat->name = $request->name;
        // dd($foodCat);
        $foodCat->save();
        return back()->with('success', 'Food Category Updated Successfully!');
    }

    public function delete(FoodCategory $foodCat)
    {
        $foodCat->delete();
        return back()->with('success', 'Food Category Deleted Successfully!');
    }
}
