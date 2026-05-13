@extends('layouts.app')

@section('title', 'Reset Your Password')

@section('content')
    <div class="min-h-screen bg-gradient-to-br from-gray-50 to-gray-100 flex items-center justify-center p-6">
        <div class="max-w-5xl w-full bg-white shadow-2xl rounded-3xl overflow-hidden border border-gray-100 flex flex-col lg:flex-row min-h-[620px]">

            <div class="w-full lg:w-5/12 bg-gradient-to-br from-blue-600 to-indigo-700 relative overflow-hidden flex items-center justify-center">
                <div class="absolute inset-0 bg-[radial-gradient(at_center,#ffffff15_1px,transparent_1px)] [background-size:20px_20px]"></div>
                <div class="relative z-10 w-full h-full flex items-center justify-center p-8 text-center">
                    <div>
                        <img src="{{ asset('images/white.png') }}" alt="Security" class="w-full max-w-md h-auto object-contain rounded-3xl shadow-2xl border border-white/20 mb-8">
                        <h3 class="text-3xl font-bold mb-3 text-white">Security First</h3>
                        <p class="text-blue-100 text-lg leading-relaxed">
                            Update your credentials to regain access to your account securely.
                        </p>
                    </div>
                </div>
            </div>

            <div class="w-full lg:w-7/12 p-10 lg:p-16 flex items-center">
                <div class="w-full max-w-md mx-auto">
                    <div class="mb-10">
                        <h2 class="text-3xl font-bold text-gray-900">Reset Password</h2>
                        <p class="text-gray-600 mt-3 text-[17px]">
                            Please enter your new password below.
                        </p>
                    </div>

                    <form method="POST" action="{{ route('password.update') }}" class="space-y-5">
                        @csrf
                        
                        {{-- Update these two lines in your form --}}
                    <input type="hidden" name="token" value="{{ $token ?? request()->route('token') }}">
                    <input type="hidden" name="email" value="{{ $email ?? request()->query('email') }}">

                        <div>
                            <label for="password" class="block text-sm font-medium text-gray-700 mb-1">New Password</label>
                            <input id="password" type="password" name="password" required 
                                class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all outline-none"
                                placeholder="••••••••">
                            @error('password')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-1">Confirm New Password</label>
                            <input id="password_confirmation" type="password" name="password_confirmation" required 
                                class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all outline-none"
                                placeholder="••••••••">
                        </div>

                        <button type="submit"
                            class="w-full bg-blue-600 hover:bg-blue-700 active:bg-blue-800 transition-all duration-200 text-white font-semibold py-4 px-8 rounded-2xl text-lg shadow-lg shadow-blue-500/30">
                            Update Password
                        </button>
                    </form>

                    <div class="pt-6 mt-6 border-t border-gray-100">
                        <a href="{{ route('login') }}" class="text-sm font-medium text-gray-500 hover:text-blue-600 transition-colors flex items-center justify-center">
                            ← Back to Login
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection