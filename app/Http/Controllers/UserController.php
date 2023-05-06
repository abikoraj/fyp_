<?php

namespace App\Http\Controllers;

use App\Models\Donation;
use App\Models\Profile;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Twilio\Rest\Client;

class UserController extends Controller
{
    public function dashboard()
    {
        // $receiver_count = User::where('role', 1)->where('isVerified', true)->count();
        $donor_count = User::where('role', 2)->where('isVerified', true)->count();
        $receiver_count = User::where('role', 1)->where('isVerified', true)->count();
        $user_count = $donor_count + $receiver_count;
        $unverified_count = User::where('isVerified', false)->count();

        $donation_count = Donation::where('hidden', false)->count();
        $active_count = Donation::where('hidden', false)->where('status', [0, 1, 2])->where('approval', 1)->count();
        $pending_count = Donation::where('hidden', false)->where('approval', 0)->count();
        $wasted_count = Donation::where('hidden', false)->where('status', 3)->count();

        $users = User::where('isVerified', true)->take(5)->latest()->get();
        return view('admin.dashboard', compact('users', 'receiver_count', 'donor_count', 'user_count', 'unverified_count', 'donation_count', 'active_count', 'pending_count', 'wasted_count'));
    }

    public function login(Request $request)
    {
        if ($request->getMethod() == "POST") {
            $phone = "+977" . $request->phone;
            if (!Auth::attempt(['phone' => $phone, 'password' => $request->password])) {
                return redirect()->back()->with('error', 'Wrong Phone or Password');
            } else {
                if (Auth::user()->isVerified == true) {
                    if (Auth::user()->role == 0) {
                        return redirect()->route('admin.dashboard');
                    } elseif (Auth::user()->role == 1) {
                        if (Auth::user()->profile == null) {
                            return redirect()->route('profile.add');
                        } else {
                            return redirect()->route('receiver.dashboard');
                        }
                    } elseif (Auth::user()->role == 2) {
                        if (Auth::user()->profile == null) {
                            return redirect()->route('profile.add');
                        } else {
                            return redirect()->route('donor.dashboard');
                        }
                    }
                } else {
                    Auth::logout();
                    $verification = $this->sendOTP($phone);
                    if ($verification) {
                        return redirect()->route('verify', ['phone' => $phone])
                            ->with('success', 'OTP has been sent to ' . $phone . 'Please verify your phone number to continue');
                    } else {
                        return redirect()->back()->with('error', 'Failed to send OTP. Please try again later.');
                    }
                }
            }
        } else {
            return view('auth.login');
        }
    }

    public function register(Request $request)
    {
        if ($request->getMethod() == "POST") {
            $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'phone' => ['required', 'integer', 'digits:10', 'starts_with:98,97'],
                'password' => ['required', 'string', 'min:8', 'confirmed'],
                'role' => ['required', 'string', Rule::in([1, 2])],
            ]);


            $phone_cc = "+977" . $request->phone;
            $user_check = DB::table('users')->select('id', 'phone', 'isVerified')->where('phone', $phone_cc)->first();

            if ($user_check) {
                if ($user_check->isVerified == false) {
                    $verification = $this->sendOTP($phone_cc);
                    if ($verification) {
                        return redirect()->route('verify', ['phone' => $phone_cc])
                            ->with('success', 'OTP has been sent to ' . $phone_cc);
                    } else {
                        return redirect()->back()->with('error', 'Failed to send OTP. Please try again later.');
                    }
                } else {
                    return redirect()->back()->with('error', 'Phone Number Already Exists.');
                }
            } else {
                $user = new User();
                $user->name = $request->name;
                $user->phone = $phone_cc;
                $user->role = $request->role;
                $user->isVerified = false;
                $user->password = bcrypt($request->password);
                // dd($user);

                $verification = $this->sendOTP($phone_cc);
                if ($verification) {
                    $user->save();
                    return redirect()->route('verify', ['phone' => $phone_cc])
                        ->with('success', 'OTP has been sent to ' . $phone_cc);
                } else {
                    return redirect()->back()->with('error', 'Failed to send OTP. Please try again later.');
                }
            }
        } else {
            return view('auth.register');
        }
    }

    public function verify($phone)
    {
        return view('auth.verify', compact('phone'));
    }

    // Verify OTP
    public function verified(Request $request)
    {
        $request->validate([
            'phone' => 'required',
            'code' => 'required',
        ]);
        $phone = $request->phone;
        $otp = $request->code;
        $sid = getenv("TWILIO_SID");
        $token = getenv("TWILIO_TOKEN");
        $vsid = getenv("TWILIO_VERIFICATION_SID");
        $twilio = new Client($sid, $token);
        $verification_check = $twilio->verify->v2->services($vsid)
            ->verificationChecks
            ->create(
                [
                    "to" => $phone,
                    "code" => $otp
                ]
            );
        if ($verification_check->valid) {
            $user = User::where('phone', $phone)->first();
            $user->isVerified = true;
            $user->phone_verified_at = now()->timezone('Asia/Kathmandu')->format('Y-m-d H:i:s');
            // dd($user->phone_verified_at);
            $user->save();
            return redirect()->route('login')->with('success', 'Your registration is successful. Please login to continue.');
        } else {
            return redirect()->back()->with('error', 'OTP is invalid');
        }
    }

    public function sendOTP($phone)
    {
        $sid = getenv("TWILIO_SID");
        $token = getenv("TWILIO_TOKEN");
        $vsid = getenv("TWILIO_VERIFICATION_SID");
        $twilio = new Client($sid, $token);
        $verification = $twilio->verify->v2->services($vsid)
            ->verifications
            ->create($phone, "sms");
        return $verification;
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }

    public function listDonor()
    {
        $users = User::where('role', 2)->where('isVerified', true)->get();
        return view('admin.user.donor', compact('users'));
    }
    public function listReceiver()
    {
        $users = User::where('role', 1)->where('isVerified', true)->get();
        return view('admin.user.receiver', compact('users'));
    }
    public function listUnverified()
    {
        $users = User::where('isVerified', false)->get();
        return view('admin.user.unverified', compact('users'));
    }

    public function delete($id)
    {
        $user = User::find($id);
        $profile = Profile::where('user_id', $id)->first();
        if ($profile) {
            $profile->delete();
        }
        $user->delete();
        return redirect()->back()->with('success', 'User Deleted Successfully');
    }

    public function details($id)
    {
        $user = User::find($id);
        // $profile = Profile::where('user_id', $id)->first();
        return view('admin.user.details', compact('user'));
    }
}
