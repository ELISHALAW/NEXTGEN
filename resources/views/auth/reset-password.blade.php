@extends('layouts.app')

@section('title', 'Reset Password')

@section('content')
    <div class="min-h-screen bg-gray-50 flex items-center justify-center p-6">
        <div class="max-w-md w-full bg-white shadow-xl rounded-3xl p-8">
            <h2 class="text-3xl font-bold text-center mb-2">Set New Password</h2>
            <p class="text-gray-600 text-center mb-8">Please create a new password for your account.</p>

            <form method="POST" action="{{ route('password.update') }}">
                @csrf

                <input type="hidden" name="token" value="{{ $token ?? request()->route('token') }}">

                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Email Address</label>
                    <input type="email" name="email" value="{{ old('email', request()->email) }}"
                        class="w-full px-4 py-3 border border-gray-300 rounded-2xl focus:ring-2 focus:ring-blue-500 outline-none"
                        readonly>
                </div>

                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-2">New Password</label>
                    <input type="password" name="password"
                        class="w-full px-4 py-3 border border-gray-300 rounded-2xl focus:ring-2 focus:ring-blue-500 outline-none"
                        required>
                </div>

                <div class="mb-8">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Confirm Password</label>
                    <input type="password" name="password_confirmation"
                        class="w-full px-4 py-3 border border-gray-300 rounded-2xl focus:ring-2 focus:ring-blue-500 outline-none"
                        required>
                </div>

                <button type="submit"
                    class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-4 rounded-2xl transition">
                    Reset Password
                </button>
            </form>
        </div>
    </div>
@endsection
