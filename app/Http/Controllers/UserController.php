<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Otp;
use App\Models\User;
use App\Mail\OtpMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{
    public function home()
    {

        return view('home');
    }

    public function registerReturn()
    {
        return view('verification');
    }



    public function register(Request $request)
    {
        // Get the stored email or mobile number from the session
        $email = $request->session()->get('email');
        $mobileNumber = $request->session()->get('mobile_number');

        // Check if the email or mobile number is provided in the request
        if ($request->filled('identifier')) {
            $incomingFields = $request->validate([
                'identifier' => 'required|string',
            ]);

            $identifier = $incomingFields['identifier'];

            // Initialize variables for email and mobile number
            $email = null;
            $mobileNumber = null;

            // Check if the input matches the email format
            if (filter_var($identifier, FILTER_VALIDATE_EMAIL)) {
                $email = $identifier;
                $request->session()->put('email', $email);
                $request->session()->forget('mobile_number'); // Reset mobile_number session
            } elseif (preg_match('/^[0-9]{10}$/', $identifier)) {
                // Check if the input matches the mobile number format (e.g., 1234567890)
                $mobileNumber = $identifier;
                $request->session()->put('mobile_number', $mobileNumber);
                $request->session()->forget('email'); // Reset email session
            } else {
                // Neither email nor mobile number format matches, return an error
                return redirect()->back()->withErrors(['identifier' => 'Invalid email or mobile number format.'])->withInput();
            }
        }


        // Check if the user with this email or mobile number exists
        $existingUser = null;
        if ($email) {
            $existingUser = User::where('email', $email)->first();
        } elseif ($mobileNumber) {
            $existingUser = User::where('mobile_number', $mobileNumber)->first();
        }

        // If the user does not exist, create a new user and retrieve their ID
        if (!$existingUser) {
            $newUserAttributes = [
                'email' => $email,
                'mobile_number' => $mobileNumber,
            ];

            $newUser = User::create($newUserAttributes);

            // Retrieve the ID of the newly created user
            $userId = $newUser->id;
        } else {
            // If the user already exists, retrieve their ID
            $userId = $existingUser->id;
        }

        // Generate a new OTP
        $otp = str_pad(rand(0000, 9999), 4, '0', STR_PAD_LEFT);

        // Set OTP expiry to 60 seconds from now
        $otpExpiry = Carbon::now()->addSeconds(300);

        // Create a new OTP record with user_id instead of user_email
        Otp::create([
            'user_id' => $userId,
            'otp' => Hash::make($otp),
            'otp_expiry' => $otpExpiry,
        ]);

        // Initialize $resentMessage to null
        $resentMessage = null;

        // Check if the user clicked the resend button

        // Send OTP to the user's email or mobile number
        if ($email) {
            Mail::to($email)->send(new OtpMail($otp));
            if ($request->has('resend')) {
                $resentMessage = "OTP has been resent to your email.";
            }
        } elseif ($mobileNumber) {
            if ($request->has('resend')) {
                // Send OTP to the user's mobile number (you will need to implement this)
                $resentMessage = "OTP has been resent to your mobile number.";
            }
        }

        // Render the verification Blade template with the email or mobile number
        return view('verification', [
            'resentMessage' => $resentMessage ?? null,
        ]);
    }




    public function verifyOtpReturn(Request $request)
    {
        return redirect('/');
    }


    public function verifyOtp(Request $request)
    {
        // Validate incoming fields
        $incomingFields = $request->validate([
            'digit1' => 'required|string|min:1|max:1',
            'digit2' => 'required|string|min:1|max:1',
            'digit3' => 'required|string|min:1|max:1',
            'digit4' => 'required|string|min:1|max:1',
        ]);

        $enteredOtp = $incomingFields['digit1'] . $incomingFields['digit2'] . $incomingFields['digit3'] . $incomingFields['digit4'];

        // Get the email ans mobile from the session 
        $email = $request->session()->get('email');
        $mobileNumber = $request->session()->get('mobile_number');

        // Find the OTP record in the database based on either email or mobile number
        $otpRecord = null;

        if ($email) {
            $otpRecord = Otp::whereHas('user', function ($query) use ($email) {
                $query->where('email', $email);
            })->latest()->first();
        } elseif ($mobileNumber) {
            $otpRecord = Otp::whereHas('user', function ($query) use ($mobileNumber) {
                $query->where('mobile_number', $mobileNumber);
            })->latest()->first();
        }



        if ($otpRecord) {
            // Check if the entered OTP matches the hashed OTP stored in the database
            if (Hash::check($enteredOtp, $otpRecord->otp)) {
                // Check if the OTP is still valid
                if ($otpRecord->is_active && now()->lt($otpRecord->otp_expiry)) {
                    // OTP is correct and still valid
                    // Perform any other actions (e.g., log in the user)

                    // Clear the OTP record from the database if needed
                    // $otpRecord->delete();

                    // Update the is_active field to false
                    $otpRecord->update(['is_active' => false]);

                    // Authenticate the user
                    $user = null;
                    if ($email) {
                        $user = User::where('email', $email)->first();
                    } elseif ($mobileNumber) {
                        $user = User::where('mobile_number', $mobileNumber)->first();
                    }

                    if ($user) {
                        Auth::login($user);
                        // Return success JSON response
                        return response()->json(['message' => 'OTP verification successful']);
                    }

                    // Return success JSON response
                    return response()->json(['message' => 'OTP verification successful']);
                }
            }
        }

        // OTP verification failed
        // Return error JSON response
        return response()->json(['error' => 'Invalid OTP. Please try again.'], 422);
    }
}
