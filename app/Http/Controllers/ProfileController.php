<?php

namespace App\Http\Controllers;

use App\Models\Donation;
use App\Models\Profile;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class ProfileController extends Controller
{
    public function index()
    {
        $latest_donation = Donation::where('user_id', Auth::user()->id)->where('hidden', false)->latest()->take(3)->get();
        $profile = Profile::where('user_id', Auth::user()->id)->first();
        if ($profile) {
            return view('auth.profile.index', compact('profile', 'latest_donation'));
        } else {
            return redirect()->route('profile.add');
        }
    }
    public function add()
    {
        if (Auth::user()->profile) {
            return redirect()->route('profile.index');
        } else {
            return view('auth.profile.add');
        }
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
            $request->validate([
                'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);
            $profile->image = $request->image->store('uploads/profile', 'public');
        }
        if ($request->hasFile('cover_image')) {
            $request->validate([
                'cover_image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);
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

    public function edit($id)
    {
        $profile = Profile::find($id)->where('user_id', Auth::user()->id)->first();
        // dd($profile);
        if ($profile) {
            return view('auth.profile.edit', compact('profile'));
        } else {
            return redirect()->route('profile.create');
        }
    }

    public function update(Request $request)
    {
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
        $profile = Profile::where('user_id', Auth::user()->id)->first();
        // $profile->user_id = Auth::user()->id;
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
            $request->validate([
                'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);
            $profile->image = $request->image->store('uploads/profile', 'public');
        }
        if ($request->hasFile('cover_image')) {
            $request->validate([
                'cover_image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);
            $profile->cover_image = $request->cover_image->store('uploads/covers', 'public');
        }
        $profile->save();
        // dd($profile);
        return redirect()->route('profile.index')->with('success', 'Profile updated successfully.');
    }

    public function receiverList()
    {
        $profiles = Profile::all();
        return view('admin.user.receiver', compact('profiles'));
    }


}
