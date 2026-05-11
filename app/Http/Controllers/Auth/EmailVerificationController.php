<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class EmailVerificationController extends Controller
{
    public function resend(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email', 'exists:users,email'],
        ]);

        $user = User::where('email', $request->email)->firstOrFail();

        if ($user->hasVerifiedEmail()) {
            return back()->with('status', 'Your email is already verified.');
        }

        $user->sendEmailVerificationNotification();

        return back()
            ->with('status', 'A new verification link has been sent to your email address.');
    }
}