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
        // Check if the email is already stored in the session
        $email = $request->session()->get('email');

        // If the email is not provided in the session or it's different from the one in the request, use the one from the request
        if (!$email || $request->filled('email')) {
            $incomingFields = $request->validate([
                'email' => 'required|email',
            ]);

            $email = $incomingFields['email'];

            // Update the session with the new email
            $request->session()->put('email', $email);

            // Set a flash message indicating that the OTP has been resent
            $request->session()->flash('otp_resent_message', '');
        } else {
            // If it's not a new email, set the flash message indicating that the OTP has been resent
            $request->session()->flash('otp_resent_message', 'OTP has been resent');
        }


        // Check if the user with this email exists
        $existingUser = User::where('email', $email)->first();

        // Generate a new OTP
        $otp = str_pad(rand(0000, 9999), 4, '0', STR_PAD_LEFT);

        // Set OTP expiry to 60 seconds from now
        $otpExpiry = Carbon::now()->addSeconds(300);

        // Create a new OTP record with is_active initially set to 1
        Otp::create([
            'user_email' => $email,
            'otp' => Hash::make($otp),
            'otp_expiry' => $otpExpiry,
        ]);

        if (!$existingUser) {
            // User with this email doesn't exist, create a new user
            User::create([
                'email' => $email,
            ]);

            // Send OTP to the user's email
            Mail::to($email)->send(new OtpMail($otp));
        } else {
            // User with this email already exists, proceed to the next step
            // You may want to handle this case based on your application's logic

            // Send OTP to the existing user's email            
            Mail::to($email)->send(new OtpMail($otp));
        }



        // Render the verification Blade template with the email
        return view('verification', [
            'email' => $email,

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

        // Get the email from the session or wherever you stored it during registration
        $email = $request->session()->get('email');

        // Find the OTP record in the database
        $otpRecord = Otp::where('user_email', $email)->latest()->first();

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
                    $user = User::where('email', $email)->first();
                    Auth::login($user);

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
