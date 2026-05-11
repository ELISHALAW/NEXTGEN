<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class VerificationController extends Controller
{
    public function showRequestForm()
    {
        return view('auth.verify-email  '); // Make sure this matches your file path
    }

    public function sendLink(Request $request)
    {
        $request->validate(['email' => 'required|email|exists:users,email']);

        $user = User::where('email', $request->email)->first();

        if ($user->hasVerifiedEmail()) {
            return back()->with('status', 'This email is already verified.');
        }

        $user->sendEmailVerificationNotification();

        return back()->with('status', 'Verification link sent! Please check your inbox.');
    }
}