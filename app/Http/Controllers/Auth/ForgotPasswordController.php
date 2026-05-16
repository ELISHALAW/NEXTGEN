<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Auth\Events\PasswordReset;

class ForgotPasswordController extends Controller
{
    /**
     * Display the form to request a password reset link.
     */
    public function index()
    {
        return view('auth.forgot-password');
    }

    /**
     * Send a reset link to the given user.
     * THIS WAS MISSING AND CAUSING YOUR ERROR.
     */
    public function sendResetLink(Request $request)
    {
        // 1. Validate that the email is required and exists in the system
        $request->validate([
            'email' => 'required|email|exists:users,email',
        ]);

        // 2. Attempt to send the password reset link via Laravel's Password Broker
        $status = Password::sendResetLink(
            $request->only('email')
        );

        // 3. If successfully sent, redirect back with a status message.
        // Otherwise, redirect back with an error message.
        return $status === Password::RESET_LINK_SENT
            ? back()->with('status', __($status))
            : back()->withErrors(['email' => [__($status)]]);
    }

    /**
     * Reset the user's password.
     * Renamed to 'store' as requested.
     */
    public function store(Request $request) 
    {
        // 1. Validate the incoming request
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed',
        ]);

        // 2. Attempt to reset the password
        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                // This callback runs only if the token/email are valid
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->setRememberToken(Str::random(60));

                $user->save();

                event(new PasswordReset($user));
            }
        );

        // 3. Redirect based on the result
        return $status === Password::PASSWORD_RESET
            ? redirect()->route('login')->with('status', __($status))
            : back()->withErrors(['email' => [__($status)]]);
    }
}