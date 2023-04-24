<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Twilio\Rest\Client;

class UserController extends Controller
{
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
                'phone' => ['required', 'string'],
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
            $user->phone_verified_at = now();
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
}
