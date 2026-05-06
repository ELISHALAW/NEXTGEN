@extends('layouts.app')

@section('content')
    <div class="min-h-screen bg-[#1a1a1a] flex flex-col justify-center py-12 px-6 lg:px-8">
        <div class="sm:mx-auto sm:w-full sm:max-w-md">
            <!-- Logo -->
            <a href="{{ route('home') }}" class="flex justify-center mb-6">
                <img src="{{ asset('images/white.png') }}" class="h-14 w-auto" alt="Gimas Studio">
            </a>
            <h2 class="text-center text-3xl font-extrabold text-white tracking-tight">
                Create your account
            </h2>
            <p class="mt-2 text-center text-sm text-gray-400">
                Or
                <a href="{{ route('login') }}" class="font-medium text-amber-500 hover:text-amber-400 transition-colors">
                    sign in to your existing account
                </a>
            </p>
        </div>

        <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md">
            <div class="bg-[#252525] py-8 px-6 shadow-2xl border border-white/5 rounded-2xl sm:px-10">
                <form class="space-y-6" action="{{ route('register') }}" method="POST">
                    @csrf

                    <!-- Name -->
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-300">Full Name</label>
                        <div class="mt-1">
                            <input id="name" name="name" type="text" required
                                class="appearance-none block w-full px-3 py-3 border border-white/10 rounded-xl bg-[#1a1a1a] text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-transparent sm:text-sm transition-all"
                                placeholder="John Doe">
                        </div>
                    </div>

                    <!-- Email Address -->
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-300">Email address</label>
                        <div class="mt-1">
                            <input id="email" name="email" type="email" autocomplete="email" required
                                class="appearance-none block w-full px-3 py-3 border border-white/10 rounded-xl bg-[#1a1a1a] text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-transparent sm:text-sm transition-all"
                                placeholder="you@example.com">
                        </div>
                    </div>

                    <!-- Phone Number - NEW FIELD -->
                    <div>
                        <label for="phone" class="block text-sm font-medium text-gray-300">Phone Number</label>
                        <div class="mt-1">
                            <input id="phone" name="phone_number" type="tel" autocomplete="tel" required
                                class="appearance-none block w-full px-3 py-3 border border-white/10 rounded-xl bg-[#1a1a1a] text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-transparent sm:text-sm transition-all"
                                placeholder="+60 12-345 6789">
                        </div>
                    </div>

                    <!-- Password -->
                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-300">Password</label>
                        <div class="mt-1">
                            <input id="password" name="password" type="password" required
                                class="appearance-none block w-full px-3 py-3 border border-white/10 rounded-xl bg-[#1a1a1a] text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-transparent sm:text-sm transition-all">
                        </div>
                    </div>

                    <!-- Confirm Password -->
                    <div>
                        <label for="password_confirmation" class="block text-sm font-medium text-gray-300">Confirm
                            Password</label>
                        <div class="mt-1">
                            <input id="password_confirmation" name="password_confirmation" type="password" required
                                class="appearance-none block w-full px-3 py-3 border border-white/10 rounded-xl bg-[#1a1a1a] text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-transparent sm:text-sm transition-all">
                        </div>
                    </div>

                    <!-- Terms -->
                    <div class="flex items-center">
                        <input id="terms" name="terms" type="checkbox" required
                            class="h-4 w-4 text-amber-500 focus:ring-amber-500 border-white/10 bg-[#1a1a1a] rounded">
                        <label for="terms" class="ml-2 block text-sm text-gray-400">
                            I agree to the <a href="#" class="text-amber-500 hover:underline">Terms</a> and <a
                                href="#" class="text-amber-500 hover:underline">Privacy Policy</a>
                        </label>
                    </div>

                    <!-- Submit Button -->
                    <div>
                        <button type="submit"
                            class="w-full flex justify-center py-3 px-4 border border-transparent rounded-xl shadow-sm text-sm font-bold uppercase tracking-widest text-black bg-white hover:bg-amber-500 hover:text-white focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-amber-500 transition-all duration-300">
                            Register Account
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
