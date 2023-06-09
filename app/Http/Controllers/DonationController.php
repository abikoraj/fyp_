<?php

namespace App\Http\Controllers;

use App\Models\Donation;
use App\Models\Profile;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Twilio\Rest\Client;
use Illuminate\Support\Facades\DB;

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

        if ($donation->save()) {
            try {
                $phone = "+9779825353558";
                $body = "New food donation is created in Waste-Not.";
                $message = $this->sendMessage($phone, $body);
                if ($message) {
                    return redirect()->back()->with('successer', 'Notification Sent.');
                } else {
                    return redirect()->back()->with('errorer', 'SMS not sent.');
                }
            } catch (\Throwable $th) {
                throw $th;
            }
            return redirect()->back()->with('success', 'Donation added successfully.');
        }else{
            return redirect()->back()->with('error', 'Something Went Wrong.');
        }
    }

    public function sendMessage($phone, $body)
    {
        $sid = env('TWILIO_SID');
        $token = env('TWILIO_TOKEN');
        $twilio = new Client($sid, $token);
        $message = $twilio->messages
            ->create($phone, // to
                array(
                    "from" => env('TWILIO_FROM'),
                    "body" => $body,
                )
            );
        // dd($message);
        return $message->sid;
    }

    public function myDonation()
    {
        $all = Donation::where('user_id', Auth::user()->id)->where('hidden', false)->orderBy('created_at', 'desc')->get();
        $active = Donation::where('user_id', Auth::user()->id)->where('status', [0, 1, 2])->where('hidden', false)->where('approval', 1)->orderBy('created_at', 'desc')->get();
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

        $latitude = $donation->latitude;
        $longitude = $donation->longitude;
        $radius = 10; // km

        $profile = Profile::selectRaw('*,
        ( 6371 * acos( cos( radians(?) ) *
                   cos( radians( latitude ) ) *
                   cos( radians( longitude ) - radians(?) ) +
                   sin( radians(?) ) *
                   sin( radians( latitude ) )
                 )
        ) AS distance', [$latitude, $longitude, $latitude])
        ->havingRaw("distance <= ?", [$radius])
        ->orderBy('distance', 'asc')
        ->get();
        // dd($profile->user->phone);
        foreach ($profile as $p) {
            if ($p->user->role == 1) {
                $phone = $p->user->phone;
                $body = "New food donation is available near you. Please check the app.";
                //  echo($p->user->phone . $p->user->role);
                $message = $this->sendMessage($phone, $body);
                if ($message) {
                    return redirect()->back()->with('success', 'Notification Sent.');
                } else {
                    return redirect()->back()->with('error', 'SMS not sent.');
                }
            }
        }
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
        $latitude = Auth::user()->profile->latitude;
        $longitude = Auth::user()->profile->longitude;
        $radius = 10; // km

        $donations = Donation::selectRaw('*,
            ( 6371 * acos( cos( radians(?) ) *
                       cos( radians( latitude ) ) *
                       cos( radians( longitude ) - radians(?) ) +
                       sin( radians(?) ) *
                       sin( radians( latitude ) )
                     )
            ) AS distance', [$latitude, $longitude, $latitude])
            ->where('status', '<>', 4)
            ->where('hidden', false)
            ->havingRaw("distance <= ?", [$radius])
            ->orderBy('distance', 'asc')
            ->get();

        // $user = Auth::user();
        // $profile = Profile::where('user_id', $user->id)->first();
        // $latitude = $profile->latitude;
        // $longitude = $profile->longitude;

        return view('receiver.nearme', compact('donations'));
    }
    public function nearMeDetails($id)
    {
        $donation = Donation::findOrFail($id);
        $profile = Profile::where('user_id', $donation->user_id)->first();
        return view('receiver.nearmeDetails', compact('donation', 'profile'));
    }
}
