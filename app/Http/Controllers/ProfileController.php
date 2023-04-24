<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class ProfileController extends Controller
{
    public function add()
    {
        return view('auth.profile.add');
    }

    public function submit(Request $request)
    {
        // dd($request->all());
        $request->validate([
            // 'type' => ['required', 'string', Rule::in([1, 2])],
            'city_id' => 'required',
            'organization_id' => 'required',
            'email' => 'nullable|email',
            'address' => 'required',
        ]);
        if (Auth::user()->role == 1) {
            $request->validate([
                'type' => 'required',
            ]);
        }
        $profile = new Profile();
        $profile->user_id = Auth::user()->id;
        $profile->city_id = $request->city_id;
        $profile->organization_type_id = $request->organization_id;
        $profile->contact = $request->contact;
        $profile->address = $request->address;
        $profile->bio = $request->bio;
        $profile->email = $request->email;
        $profile->type = $request->type;
        $profile->latitude = $request->latitude;
        $profile->longitude = $request->longitude;
        if ($request->hasFile('image')) {
            $profile->image = $request->image->store('uploads/profile', 'public');
        }
        if ($request->hasFile('cover_image')) {
            $profile->cover_image = $request->cover_image->store('uploads/covers', 'public');
        }
        $profile->save();
        // dd($profile);
        if (Auth::user()->role == 1) {
            return redirect()->route('receiver.dashboard');
        } elseif (Auth::user()->role == 2) {
            return redirect()->route('donor.dashboard');
        }else {
            return redirect()->back()->with('error', 'Something went wrong. Please try again later.');
        }
    }
}
