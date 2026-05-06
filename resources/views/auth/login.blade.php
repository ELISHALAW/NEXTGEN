@extends('layouts.app')

@section('content')
    <div class="min-h-screen bg-[#1a1a1a] flex flex-col justify-center py-12 px-6 lg:px-8">
        <div class="sm:mx-auto sm:w-full sm:max-w-md">
            <!-- Logo -->
            <a href="{{ route('home') }}" class="flex justify-center mb-6">
                <img src="{{ asset('images/white.png') }}" class="h-14 w-auto" alt="Gimas Studio">
            </a>
            <h2 class="text-center text-3xl font-extrabold text-white tracking-tight">
                Welcome back
            </h2>
            <p class="mt-2 text-center text-sm text-gray-400">
                Don't have an account?
                <a href="{{ route('register') }}" class="font-medium text-amber-500 hover:text-amber-400 transition-colors">
                    Create a new account
                </a>
            </p>
        </div>

        <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md">
            <div class="bg-[#252525] py-8 px-6 shadow-2xl border border-white/5 rounded-2xl sm:px-10">

                <!-- Error Messages -->
                @if ($errors->any())
                    <div class="mb-6 p-4 rounded-xl bg-red-500/10 border border-red-500/50 text-red-400 text-sm">
                        <ul class="list-disc list-inside space-y-1">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form class="space-y-6" action="{{ route('login') }}" method="POST">
                    @csrf

                    <!-- Email Address -->
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-300">Email address</label>
                        <div class="mt-1">
                            <input id="email" name="email" type="email" autocomplete="email" required
                                class="appearance-none block w-full px-4 py-3 border @error('email') border-red-500 @else border-white/10 @enderror rounded-xl bg-[#1a1a1a] text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-transparent sm:text-sm transition-all"
                                placeholder="you@example.com" value="{{ old('email') }}">
                        </div>
                        @error('email')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Password -->
                    <div>
                        <div class="flex items-center justify-between">
                            <label for="password" class="block text-sm font-medium text-gray-300">Password</label>
                            <a href="#"
                                class="text-sm font-medium text-amber-500 hover:text-amber-400 transition-colors">
                                Forgot password?
                            </a>
                        </div>
                        <div class="mt-1">
                            <input id="password" name="password" type="password" required
                                class="appearance-none block w-full px-4 py-3 border @error('password') border-red-500 @else border-white/10 @enderror rounded-xl bg-[#1a1a1a] text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-transparent sm:text-sm transition-all">
                        </div>
                        @error('password')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Remember Me -->
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <input id="remember_me" name="remember" type="checkbox"
                                class="h-4 w-4 text-amber-500 focus:ring-amber-500 border-white/10 bg-[#1a1a1a] rounded">
                            <label for="remember_me" class="ml-2 block text-sm text-gray-400">
                                Remember me
                            </label>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div>
                        <button type="submit"
                            class="w-full flex justify-center py-3 px-4 border border-transparent rounded-xl shadow-sm text-sm font-bold uppercase tracking-widest text-black bg-white hover:bg-amber-500 hover:text-white focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-amber-500 transition-all duration-300">
                            Sign In
                        </button>
                    </div>
                </form>

                <!-- Social Login -->
                <div class="mt-6">
                    <div class="relative">
                        <div class="absolute inset-0 flex items-center">
                            <div class="w-full border-t border-white/10"></div>
                        </div>
                        <div class="relative flex justify-center text-sm">
                            <span class="px-2 bg-[#252525] text-gray-500">Or continue with</span>
                        </div>
                    </div>

                    <div class="mt-6 grid grid-cols-1 gap-3">
                        <a href="#"
                            class="w-full inline-flex justify-center py-2.5 px-4 rounded-xl border border-white/10 bg-[#1a1a1a] text-sm font-medium text-white hover:bg-white/5 transition-colors">
                            <i class="fa-brands fa-google mr-2 text-lg"></i> Continue with Google
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
