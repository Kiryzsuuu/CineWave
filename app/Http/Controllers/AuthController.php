<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Otp;
use App\Mail\WelcomeMail;
use App\Mail\OtpMail;
use App\Mail\ForgotPasswordMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;

class AuthController extends Controller
{
    public function showLogin()
    {
        if (Auth::check()) {
            return redirect()->route('home');
        }
        return view('auth.login');
    }

    public function showRegister()
    {
        if (Auth::check()) {
            return redirect()->route('home');
        }
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // Generate OTP
        $otp = str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);
        
        // Store user data in session temporarily
        session([
            'registration_data' => [
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ],
            'email' => $request->email
        ]);

        // Delete old OTP for this email
        Otp::where('email', $request->email)->delete();

        // Create new OTP
        Otp::create([
            'email' => $request->email,
            'otp' => $otp,
            'type' => 'register',
            'expires_at' => Carbon::now()->addMinutes(10),
            'verified' => false
        ]);

        // Send OTP email
        Mail::to($request->email)->send(new OtpMail($otp, $request->email));

        return redirect()->route('verify.otp.form')->with('success', 'Verification code sent to your email!');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($request->only('email', 'password'), $request->boolean('remember'))) {
            $request->session()->regenerate();

            // Check if user has selected a plan
            if (!session('user_plan')) {
                return redirect()->route('payment.plan');
            }

            return redirect()->intended('home');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/'); 
    }

    // OTP Verification Methods
    public function showVerifyOtp()
    {
        if (!session('email')) {
            return redirect()->route('register');
        }
        return view('auth.verify-otp');
    }

    public function verifyOtp(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'otp' => 'required|size:6',
        ]);

        $otpRecord = Otp::where('email', $request->email)
            ->where('otp', $request->otp)
            ->where('type', 'register')
            ->where('verified', false)
            ->where('expires_at', '>', Carbon::now())
            ->first();

        if (!$otpRecord) {
            return back()->with('error', 'Invalid or expired verification code.');
        }

        // Mark OTP as verified
        $otpRecord->update(['verified' => true]);

        // Get registration data from session
        $registrationData = session('registration_data');
        
        if (!$registrationData) {
            return redirect()->route('register')->with('error', 'Registration session expired. Please register again.');
        }

        // Create user
        $user = User::create($registrationData);

        // Send welcome email
        Mail::to($user->email)->send(new WelcomeMail($user));

        // Login user
        Auth::login($user);

        // Clear session data
        session()->forget(['registration_data', 'email']);

        return redirect()->route('payment.plan')->with('success', 'Email verified successfully!');
    }

    public function resendOtp(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        // Generate new OTP
        $otp = str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);

        // Delete old OTP
        Otp::where('email', $request->email)->delete();

        // Create new OTP
        Otp::create([
            'email' => $request->email,
            'otp' => $otp,
            'type' => 'register',
            'expires_at' => Carbon::now()->addMinutes(10),
            'verified' => false
        ]);

        // Send OTP email
        Mail::to($request->email)->send(new OtpMail($otp, $request->email));

        return back()->with('success', 'New verification code sent!');
    }

    // Forgot Password Methods
    public function showForgotPassword()
    {
        return view('auth.forgot-password');
    }

    public function sendForgotPasswordOtp(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
        ]);

        // Generate OTP
        $otp = str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);

        // Delete old OTP
        Otp::where('email', $request->email)->where('type', 'forgot')->delete();

        // Create new OTP
        Otp::create([
            'email' => $request->email,
            'otp' => $otp,
            'type' => 'forgot',
            'expires_at' => Carbon::now()->addMinutes(10),
            'verified' => false
        ]);

        // Send OTP email
        Mail::to($request->email)->send(new ForgotPasswordMail($otp, $request->email));

        return redirect()->route('reset.password.form')->with('success', 'Reset code sent to your email!');
    }

    public function showResetPassword()
    {
        return view('auth.reset-password');
    }

    public function verifyResetPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'otp' => 'required|size:6',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $otpRecord = Otp::where('email', $request->email)
            ->where('otp', $request->otp)
            ->where('type', 'forgot')
            ->where('verified', false)
            ->where('expires_at', '>', Carbon::now())
            ->first();

        if (!$otpRecord) {
            return back()->with('error', 'Invalid or expired verification code.');
        }

        // Mark OTP as verified
        $otpRecord->update(['verified' => true]);

        // Update user password
        $user = User::where('email', $request->email)->first();
        $user->update([
            'password' => Hash::make($request->password)
        ]);

        return redirect()->route('login')->with('success', 'Password reset successfully! You can now login.');
    }
}
