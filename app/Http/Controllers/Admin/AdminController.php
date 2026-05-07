<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    // Display the list of all users
    public function index()
    {
        $users = User::all();
        return view('admin.users.index', compact('users'));
    }

    // Display the main admin dashboard (Overview)
    public function dashboard()
    {
        $users = User::all();
        // You can pass stats here, like total users or recent orders
        $userCount = User::count();
        return view('admin.dashboard', compact('userCount', 'users'));
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

        User::create([
            'name'         => $request->name,
            'email'        => $request->email,
            'role'         => $request->role,
            'password'     => \Illuminate\Support\Facades\Hash::make($request->password),
            'phone_number' => $request->phone_number,
        ]);

        return redirect()->route('admin.dashboard')->with('success', 'User created successfully!');
    }
}
