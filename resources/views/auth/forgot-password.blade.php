@extends('layouts.app')

@section('title', 'Verify Your Account')

@section('content')
    <div class="min-h-screen bg-gradient-to-br from-gray-50 to-gray-100 flex items-center justify-center p-6">
        <div class="max-w-5xl w-full bg-white shadow-2xl rounded-3xl overflow-hidden border border-gray-100 flex flex-col lg:flex-row">

            <!-- LEFT SIDE: Visual -->
            <div class="w-full lg:w-5/12 bg-gradient-to-br from-blue-600 to-indigo-700 p-12 flex flex-col items-center justify-center text-white relative overflow-hidden">
                <div class="absolute inset-0 bg-[radial-gradient(at_center,#ffffff15_1px,transparent_1px)] [background-size:20px_20px]"></div>
                
                <div class="relative z-10 text-center">
                    <!-- Better SVG Illustration -->
                    <div class="w-40 h-40 mx-auto mb-8 bg-white/10 backdrop-blur-xl rounded-2xl flex items-center justify-center border border-white/20">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-24 h-24" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.75">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2.01 2.01 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 11v8a2 2 0 01-2 2H7a2 2 0 01-2-2v-8" />
                            <circle cx="12" cy="15" r="2" fill="currentColor"/>
                        </svg>
                    </div>

                    <h3 class="text-3xl font-bold mb-4">Security First</h3>
                    <p class="text-blue-100 max-w-xs mx-auto leading-relaxed">
                        Verifying your email helps protect your account and ensures you never miss important updates.
                    </p>
                </div>
            </div>

            <!-- RIGHT SIDE: Form -->
            <div class="w-full lg:w-7/12 p-10 lg:p-16 flex items-center">
                <div class="w-full max-w-md mx-auto">
                    <div class="mb-10">
                        <h2 class="text-3xl font-bold text-gray-900">Check your inbox</h2>
                        <p class="text-gray-600 mt-3 text-[17px]">
                            Enter the email address you used to register. We'll send you a fresh verification link.
                        </p>
                    </div>

                    @if (session('status'))
                        <div class="mb-8 bg-green-50 border border-green-200 text-green-700 px-5 py-4 rounded-2xl text-sm flex items-start gap-3">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mt-0.5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            <span>{{ session('status') }}</span>
                        </div>
                    @endif

                    <form action="{{ route('verification.resend') }}" method="POST" class="space-y-6">
                        @csrf

                        <div>
                            <label for="email" class="block text-sm font-semibold text-gray-700 mb-2">
                                Email Address
                            </label>
                            <input 
                                id="email"
                                type="email" 
                                name="email" 
                                required 
                                autofocus
                                value="{{ old('email') }}"
                                placeholder="you@example.com"
                                class="w-full px-6 py-4 border border-gray-300 rounded-2xl focus:ring-4 focus:ring-blue-100 focus:border-blue-500 outline-none transition-all duration-200 text-base">
                            @error('email')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <button type="submit"
                            class="w-full bg-blue-600 hover:bg-blue-700 active:bg-blue-800 transition-all duration-200 text-white font-semibold py-4 px-8 rounded-2xl text-lg shadow-lg shadow-blue-500/30 flex items-center justify-center gap-2">
                            <span>Send Verification Link</span>
                        </button>
                    </form>

                    <div class="mt-10 text-center space-y-4 text-sm">
                        <p class="text-gray-600">
                            Didn't receive the email? 
                            <button type="button" 
                                    onclick="this.form.submit()" 
                                    class="font-medium text-blue-600 hover:text-blue-700 hover:underline">
                                Resend
                            </button>
                        </p>
                        
                        <a href="{{ route('login') }}" 
                           class="inline-block text-gray-500 hover:text-gray-700 transition-colors">
                            ← Back to login
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection