<?php

namespace App\Http\Controllers;

use App\Models\OrganizationType;
use Illuminate\Http\Request;

class OrganizationTypeController extends Controller
{
    public function index()
    {
        return view('admin.orgType.app');
    }

    public function submit(Request $request)
    {
        $request->validate([
            'name' => 'required'
        ]);
        // return $request->all();
        $orgType = new OrganizationType();
        $orgType->name = $request->name;
        // dd($orgType);
        $orgType->save();
        return back()->with('success', 'Organization Type Added Successfully!');
    }

    public function update(Request $request, OrganizationType $ogt)
    {
        $request->validate([
            'name' => 'required'
        ]);
        // return $request->all();
        $ogt->name = $request->name;
        // dd($ogt);
        $ogt->save();
        return back()->with('success', 'Organization Type Updated Successfully!');
    }

    public function delete(OrganizationType $ogt)
    {
        $ogt->delete();
        return back()->with('success', 'Organization Type Deleted Successfully!');
    }
}
