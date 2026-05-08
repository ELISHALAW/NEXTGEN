@extends('layouts.app')

@section('title', 'Verify Your Account')

@section('content')
    <div
        class="max-w-4xl mx-auto my-12 bg-white shadow-xl rounded-2xl overflow-hidden border border-gray-100 flex flex-col md:flex-row">

        <!-- LEFT SIDE: Illustrative Image Section -->
        <div class="w-full md:w-1/2 bg-gray-50 flex flex-col items-center justify-center p-10 text-center">
            <!-- SVG Illustration (Lightweight and clear) -->
            <svg class="w-48 h-48 mb-6 text-blue-500" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"
                stroke-linecap="round" stroke-linejoin="round">
                <path d="M22 17V7a2 2 0 0 0-2-2H4a2 2 0 0 0-2 2v10a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2z" />
                <polyline points="22,7 12,14 2,7" />
                <path d="M16 19a4 4 0 0 1-8 0v-1h8v1z" />
            </svg>
            <h3 class="text-2xl font-semibold text-gray-800">Security First</h3>
            <p class="text-gray-600 mt-2 max-w-sm">We take security seriously. Verifying your email is a quick step that
                keeps your account safe from unauthorized access.</p>
        </div>

        <!-- RIGHT SIDE: The Form Section -->
        <div class="w-full md:w-1/2 p-10 md:p-14 flex items-center">
            <div class="w-full">
                <div class="text-center mb-10">
                    <h2 class="text-3xl font-extrabold text-gray-900">Check your inbox</h2>
                    <p class="text-gray-500 mt-3 text-lg">Enter the email you used to register. We’ll send you a link to
                        activate your account.</p>
                </div>

                <!-- Note: Remember to add @csrf and handle potential session errors -->
                <form action="/send-verification" method="POST">
                    @csrf <!-- Required for Laravel forms -->

                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Email Address</label>
                        <input type="email" name="email" required autofocus placeholder="you@example.com"
                            class="w-full px-5 py-3.5 border border-gray-300 rounded-xl focus:ring-4 focus:ring-blue-100 focus:border-blue-500 outline-none transition duration-150">
                    </div>

                    <button type="submit"
                        class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-4 rounded-xl transition duration-150 shadow-sm">
                        Send Verification Link
                    </button>
                </form>

                <div class="mt-8 text-center text-sm">
                    <p class="text-gray-600">
                        Didn't get an email? <a href="#" class="font-medium text-blue-600 hover:underline">Resend
                            activation</a>
                    </p>
                    <a href="/login"
                        class="inline-block mt-5 text-gray-500 hover:text-gray-700 underline underline-offset-2">
                        Back to login
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
