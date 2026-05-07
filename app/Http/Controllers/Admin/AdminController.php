<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function index()
    {
        // Fetch all users from the database
        $users = User::all();

        // Return the view and pass the users data
        return view('admin.dashboard', compact('users'));
    }


    public function create()
    {
        return view('admin.users.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'         => 'required|string|max:255',
            'email'        => 'required|string|email|max:255|unique:users',
            'role'         => 'required|in:user,admin',
            'password'     => 'required|string|min:8',
            'phone_number' => 'nullable|string|max:20', // Matches your DB structure
        ]);

        \App\Models\User::create([
            'name'         => $request->name,
            'email'        => $request->email,
            'role'         => $request->role,
            'password'     => \Illuminate\Support\Facades\Hash::make($request->password),
            'phone_number' => $request->phone_number,
        ]);

        return redirect()->route('admin.dashboard')->with('success', 'User created successfully!');
    }
}
