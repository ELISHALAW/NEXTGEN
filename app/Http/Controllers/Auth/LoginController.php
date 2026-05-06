<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * Display the login form
     */
    public function index()
    {
        return view('auth.login');
    }

    /**
     * Handle user login
     */
    public function store(Request $request)
    {
        $validator = \Illuminate\Support\Facades\Validator::make($request->all(), [
            'email'    => ['required', 'string', 'email'],
            'password' => ['required', 'string'],
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Attempt to login
        if (Auth::attempt([
            'email'    => $request->email,
            'password' => $request->password,
        ], $request->boolean('remember'))) {

            $request->session()->regenerate();

            return redirect()->intended(route('home'))
                ->with('success', 'Welcome back!');
        }

        // Login failed
        return redirect()->back()
            ->withErrors(['email' => 'Invalid email or password.'])
            ->withInput();
    }

    /**
     * Logout the user
     */
    public function destroy()
    {
        Auth::logout();

        return redirect()->route('home')
            ->with('success', 'You have been logged out successfully.');
    }

    public function logout(Request $request)
    {
        // 1. Logs the user out of the application
        Auth::logout();

        // 2. Clears all session data for this user
        $request->session()->invalidate();

        // 3. Generates a new CSRF token to prevent "expired page" errors
        $request->session()->regenerateToken();

        // 4. Send them back to the homepage
        return redirect('/')->with('success', 'You have been logged out!');
    }
}
