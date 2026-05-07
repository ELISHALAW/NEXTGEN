@extends('layouts.admin')

@section('content')
    <div class="max-w-4xl mx-auto">
        <div class="mb-6">
            <h1 class="text-2xl font-bold text-slate-800">Add New User</h1>
            <p class="text-slate-500">System Access & User Management</p>
        </div>

        <form action="{{ route('admin.users.store') }}" method="POST">
            @csrf
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <div class="lg:col-span-2 space-y-6">
                    <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-200">
                        <div class="grid gap-4">
                            <div>
                                <label class="block text-sm font-semibold mb-1">Full Name</label>
                                <input type="text" name="name" id="name"
                                    class="w-full px-4 py-2 border rounded-xl" placeholder="John Doe" required>
                            </div>
                            <div>
                                <label class="block text-sm font-semibold mb-1">Email Address</label>
                                <input type="email" name="email" class="w-full px-4 py-2 border rounded-xl"
                                    placeholder="john@example.com" required>
                            </div>
                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-sm font-semibold mb-1">Password</label>
                                    <input type="password" name="password" class="w-full px-4 py-2 border rounded-xl"
                                        required>
                                </div>
                                <div>
                                    <label class="block text-sm font-semibold mb-1">Confirm Password</label>
                                    <input type="password" name="password_confirmation"
                                        class="w-full px-4 py-2 border rounded-xl" required>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="space-y-6">
                    <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-200">
                        <div class="grid gap-4">
                            <div>
                                <label class="block text-sm font-semibold mb-1">Role</label>
                                <select name="role" class="w-full px-4 py-2 border rounded-xl bg-white" required>
                                    <option value="user">User</option>
                                    <option value="admin">Admin</option>
                                    <option value="staff">Staff</option>
                                </select>
                            </div>
                            <div>
                                <label class="block text-sm font-semibold mb-1">Phone Number</label>
                                <input type="text" name="phone_number" class="w-full px-4 py-2 border rounded-xl"
                                    placeholder="+60...">
                            </div>
                        </div>
                    </div>

                    <button type="submit"
                        class="w-full py-3 bg-blue-600 text-white font-bold rounded-xl hover:bg-blue-700 transition">
                        Create User Account
                    </button>

                    <a href="{{ route('admin.users.index') }}"
                        class="block text-center text-sm text-slate-500 hover:text-slate-800">
                        Cancel and Go Back
                    </a>
                </div>
            </div>
        </form>
    </div>
@endsection
