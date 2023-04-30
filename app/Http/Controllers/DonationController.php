<?php

namespace App\Http\Controllers;

use App\Models\Donation;
use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DonationController extends Controller
{
    public function add()
    {
        return view('donation.add');
    }

    public function submit(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'city_id' => 'required',
            'food_category_id' => 'required',
            // 'desc'=>'required',
            'quantity' => 'required',
            'unit' => 'required',
            'prepared_at' => 'required',
            'expires_at' => 'required',
            'contact' => 'required',
            'address' => 'required',
        ]);

        $donation = new Donation();
        $donation->user_id = Auth::user()->id;
        $donation->name = $request->name;
        $donation->city_id = $request->city_id;
        $donation->food_category_id = $request->food_category_id;
        $donation->desc = $request->desc;
        $donation->quantity = $request->quantity;
        $donation->unit = $request->unit;
        $donation->prepared_at = $request->prepared_at;
        $donation->expires_at = $request->expires_at;
        $donation->contact = $request->contact;
        $donation->address = $request->address;
        $donation->latitude = $request->latitude;
        $donation->longitude = $request->longitude;
        $donation->status = 0;
        $donation->approval = 0;
        $donation->hidden = false;
        if ($request->hasFile('image')) {
            $donation->image = $request->image->store('uploads/donation', 'public');
        }

        $donation->save();
        // dd($donation);
        return redirect()->back()->with('success', 'Donation added successfully.');
    }

    public function myDonation()
    {
        $all = Donation::where('user_id', Auth::user()->id)->where('hidden', false)->orderBy('created_at', 'desc')->get();
        $active = Donation::where('user_id', Auth::user()->id)->whereIn('status', [0, 1, 2])->where('hidden', false)->where('approval', 1)->orderBy('created_at', 'desc')->get();
        $closed = Donation::where('user_id', Auth::user()->id)->where('status', [3, 4])->where('hidden', false)->where('approval', 1)->orderBy('created_at', 'desc')->get();
        $hidden = Donation::where('user_id', Auth::user()->id)->where('hidden', true)->orderBy('created_at', 'desc')->get();
        return view('donation.mydonation', compact('all', 'active', 'closed', 'hidden'));
    }

    public function status(Request $request, $id)
    {
        $donation = Donation::findOrFail($id);
        $donation->status = $request->status;
        // dd($donation);
        $donation->save();
        return redirect()->back()->with('success', 'Donation Status updated successfully.');
    }

    public function hide($id)
    {
        $donation = Donation::findOrFail($id);
        if ($donation->status == 0) {
            $donation->hidden = true;
            // $donation->approval = 2;
            $donation->save();
            return redirect()->back()->with('success', 'Donation Hidden.');
        } else {
            return redirect()->back()->with('error', 'This donation cannot be hidden.');
        }
    }

    public function details($id)
    {
        $donation = Donation::findOrFail($id);
        $profile = Profile::where('user_id', $donation->user_id)->first();
        return view('donation.details', compact('donation', 'profile'));
    }

    public function approvedDonation()
    {
        $donations = Donation::where('hidden', false)->where('approval', 1)->orderBy('created_at', 'desc')->get();
        return view('admin.donation.approved', compact('donations'));
    }
    public function pendingDonation()
    {
        $donations = Donation::where('hidden', false)->where('approval', 0)->orderBy('created_at', 'desc')->get();
        return view('admin.donation.pending', compact('donations'));
    }
    public function rejectedDonation()
    {
        $donations = Donation::where('hidden', false)->where('approval', 2)->orderBy('created_at', 'desc')->get();
        return view('admin.donation.rejected', compact('donations'));
    }
    public function hiddenDonation()
    {
        $donations = Donation::where('hidden', true)->orderBy('created_at', 'desc')->get();
        return view('admin.donation.hidden', compact('donations'));
    }
    public function detailDonation($id)
    {
        $donation = Donation::find($id);
        return view('admin.donation.details', compact('donation'));
    }
    public function approveDonation($id)
    {
        $donation = Donation::find($id);
        $donation->approval = 1;
        // dd($donation);
        $donation->save();
        return redirect()->back()->with('success', 'Donation Approved.');
    }
    public function rejectDonation($id)
    {
        $donation = Donation::find($id);
        $donation->approval = 2;
        // dd($donation);
        $donation->save();
        return redirect()->back()->with('success', 'Donation Rejected.');
    }
    public function hideDonation($id)
    {
        $donation = Donation::findOrFail($id);
        if ($donation->status != 4) {
            $donation->hidden = true;
            // $donation->approval = 2;
            $donation->save();
            return redirect()->back()->with('success', 'Donation Hidden.');
        } else {
            return redirect()->back()->with('error', 'This donation cannot be hidden.');
        }
    }

    public function listDonations()
    {
        $donations = Donation::where('approval', 1)->where('hidden', false)->orderBy('created_at', 'desc')->get();
        return view('receiver.donations', compact('donations'));
    }

    public function nearMe()
    {
        $donations = Donation::where('approval', 1)->where('hidden', false)
            ->where('status', [0, 1, 2])->orderBy('created_at', 'desc')->get();
        return view('receiver.nearme', compact('donations'));
    }
}
