<?php

namespace App\Http\Controllers;

use App\Models\Donation;
use App\Models\DonationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DonationRequestController extends Controller
{
    public function request($id)
    {
        $donation = Donation::find($id);
        $donation->status = 1;
        $donation->receiver_id = Auth::user()->id;

        $donationRequest = new DonationRequest();
        $donationRequest->donation_id = $donation->id;
        $donationRequest->user_id = Auth::user()->id;
        $donationRequest->status = 0;
        $donationRequest->save();
        $donation->save();

        return redirect()->back()->with('success', 'Donation request sent!');
    }
    public function cancel($id)
    {
        $donation = Donation::find($id);
        $donation->status = 0;
        $donation->receiver_id = null;

        $donationRequest = DonationRequest::find($id);
        $donationRequest->status = 1;
        $donationRequest->save();
        $donation->save();

        return redirect()->back()->with('success', 'Donation request sent!');
    }

    public function requestedDonation()
    {
        $donationRequest = DonationRequest::where('user_id', Auth::user()->id)->where('status','!=' , 2)->get();
        return view('receiver.requestedDonations', compact('donationRequest'));
    }


}
