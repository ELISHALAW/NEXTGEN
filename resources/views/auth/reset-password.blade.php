@extends('layouts.app')

@section('title', 'Reset Your Password')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-gray-50 to-gray-100 flex items-center justify-center p-6">
    <div class="max-w-5xl w-full bg-white shadow-2xl rounded-3xl overflow-hidden border border-gray-100 flex flex-col lg:flex-row min-h-[620px]">
        
        <div class="w-full lg:w-5/12 bg-gradient-to-br from-blue-600 to-indigo-700 flex items-center justify-center p-12 text-white text-center">
            <div>
                <img src="{{ asset('images/white.png') }}" alt="Security" class="w-48 mx-auto mb-8">
                <h3 class="text-3xl font-bold mb-4">Security First</h3>
                <p class="opacity-90">Please enter your new credentials to secure your account.</p>
            </div>
        </div>

        <div class="w-full lg:w-7/12 p-10 lg:p-16">
            <h2 class="text-3xl font-bold text-gray-900 mb-8">Set New Password</h2>

            <!-- Show Email -->
            @if($email ?? old('email'))
                <div class="mb-8">
                    <p class="text-sm text-gray-600">Resetting password for:</p>
                    <p class="font-medium text-gray-900 text-lg">
                        {{ $email ?? old('email') }}
                    </p>
                </div>
            @endif

            @if ($errors->any())
                <div class="bg-red-100 text-red-700 p-4 rounded-lg mb-6">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('password.update') }}" class="space-y-6">
                @csrf
                <input type="hidden" name="token" value="{{ $token ?? request()->route('token') }}">
                <input type="hidden" name="email" value="{{ $email ?? old('email') }}">

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">New Password</label>
                    <input type="password" name="password" required 
                        class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-blue-500 outline-none transition-all">
                    @error('password') 
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p> 
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Confirm New Password</label>
                    <input type="password" name="password_confirmation" required 
                        class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-blue-500 outline-none transition-all">
                    @error('password_confirmation') 
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p> 
                    @enderror
                </div>

                <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-4 rounded-2xl shadow-lg transition-all">
                    Update Password
                </button>
            </form>
        </div>
    </div>
</div>
@endsection