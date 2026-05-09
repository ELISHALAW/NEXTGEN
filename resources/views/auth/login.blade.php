@extends('layouts.app')

@section('content')
    <div class="min-h-screen bg-[#0a0a0a] flex overflow-hidden">

        <!-- Left Side: Cinematic Background -->
        <div class="hidden lg:flex lg:w-1/2 relative bg-[#111111] items-center justify-center">
            <!-- Background Image/Overlay -->
            <div class="absolute inset-0 z-0">
                <img src="https://images.unsplash.com/photo-1497215728101-856f4ea42174?auto=format&fit=crop&q=80"
                    class="w-full h-full object-cover opacity-40 grayscale" alt="Studio Background">
                <div class="absolute inset-0 bg-gradient-to-r from-transparent to-[#0a0a0a]"></div>
            </div>

            <!-- Floating Content on Image -->
            <div class="relative z-10 px-12">
                <div class="space-y-4">
                    <img src="{{ asset('images/white.png') }}" class="h-12 w-auto mb-8" alt="Gimas Studio">
                    <h1 class="text-6xl font-black text-white leading-tight uppercase italic tracking-tighter">
                        Crafting <span class="text-amber-500">Digital</span><br>Excellence.
                    </h1>
                    <p class="text-gray-400 max-w-md text-lg font-medium leading-relaxed">
                        Join our community of creators and turn your vision into reality with Gimas Studio's premium tools.
                    </p>
                </div>
            </div>

            <!-- Bottom Left Badge -->
            <div class="absolute bottom-10 left-12 z-10">
                <div class="flex items-center space-x-3 text-xs tracking-widest text-gray-500 uppercase font-bold">
                    <span class="w-8 h-[1px] bg-amber-500"></span>
                    <span>Est. 2024</span>
                </div>
            </div>
        </div>

        <!-- Right Side: Login Form -->
        <div class="w-full lg:w-1/2 flex flex-col justify-center px-8 sm:px-16 lg:px-24 bg-[#0a0a0a] relative">

            <!-- Mobile Logo (Hidden on Desktop) -->
            <div class="lg:hidden absolute top-8 left-8">
                <img src="{{ asset('images/white.png') }}" class="h-8 w-auto" alt="Gimas Studio">
            </div>

            <div class="max-w-md w-full mx-auto space-y-10">
                <!-- Header -->
                <div>
                    <h2 class="text-4xl font-black text-white uppercase italic tracking-tight">
                        Welcome back
                    </h2>
                    <p class="mt-3 text-gray-400 font-medium">
                        New here?
                        <a href="{{ route('register') }}"
                            class="text-amber-500 hover:text-amber-400 underline underline-offset-4 decoration-amber-500/30 transition-all">
                            Create an account
                        </a>
                    </p>
                </div>

                <!-- Error Messages -->
                @if ($errors->any())
                    <div
                        class="p-4 rounded-xl bg-red-500/10 border border-red-500/20 text-red-400 text-sm animate-in fade-in slide-in-from-top-2 duration-300">
                        <ul class="list-disc list-inside space-y-1 font-medium">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form class="space-y-6" action="{{ route('login') }}" method="POST">
                    @csrf

                    <div class="space-y-4">
                        <!-- Email -->
                        <div>
                            <label for="email"
                                class="block text-xs font-bold uppercase tracking-[0.2em] text-gray-500 mb-2 ml-1">Email
                                address</label>
                            <input id="email" name="email" type="email" autocomplete="email" required
                                class="block w-full px-5 py-4 border border-white/5 rounded-2xl bg-white/5 text-white placeholder-gray-600 focus:outline-none focus:ring-2 focus:ring-amber-500/50 focus:bg-white/10 transition-all duration-300"
                                placeholder="name@company.com" value="{{ old('email') }}">
                        </div>

                        <!-- Password -->
                        <div>
                            <div class="flex items-center justify-between mb-2 ml-1">
                                <label for="password"
                                    class="block text-xs font-bold uppercase tracking-[0.2em] text-gray-500">Password</label>
                                <a href="{{ route('auth.forgot-password') }}"
                                    class="text-xs font-bold text-amber-500/80 hover:text-amber-400">Forgot?</a>
                            </div>
                            <input id="password" name="password" type="password" required
                                class="block w-full px-5 py-4 border border-white/5 rounded-2xl bg-white/5 text-white placeholder-gray-600 focus:outline-none focus:ring-2 focus:ring-amber-500/50 focus:bg-white/10 transition-all duration-300">
                        </div>
                    </div>

                    <!-- Remember Me -->
                    <div class="flex items-center">
                        <input id="remember_me" name="remember" type="checkbox"
                            class="h-4 w-4 text-amber-500 focus:ring-amber-500/50 border-white/10 bg-white/5 rounded cursor-pointer">
                        <label for="remember_me" class="ml-3 block text-sm text-gray-400 font-medium cursor-pointer">
                            Remember session
                        </label>
                    </div>

                    <!-- Action Button -->
                    <button type="submit"
                        class="w-full py-4 bg-white hover:bg-amber-500 text-black hover:text-white text-sm font-black uppercase tracking-[0.2em] rounded-2xl transition-all duration-300 active:scale-[0.98] shadow-lg shadow-white/5 hover:shadow-amber-500/20">
                        Sign In
                    </button>
                </form>

                <!-- Divider -->
                <div class="relative">
                    <div class="absolute inset-0 flex items-center">
                        <div class="w-full border-t border-white/5"></div>
                    </div>
                    <div class="relative flex justify-center text-xs uppercase tracking-widest">
                        <span class="px-4 bg-[#0a0a0a] text-gray-600 font-bold">Or continue with</span>
                    </div>
                </div>

                <!-- Social -->
                <a href="#"
                    class="w-full flex justify-center items-center py-4 border border-white/5 bg-white/5 rounded-2xl text-sm font-bold text-white hover:bg-white/10 transition-all duration-300">
                    <i class="fa-brands fa-google mr-3 text-amber-500"></i>
                    Google Account
                </a>

                <!-- Footer -->
                <p class="text-center text-[10px] text-gray-700 uppercase tracking-[0.4em] pt-4">
                    &copy; {{ date('Y') }} Gimas Studio &bull; Privacy Policy
                </p>
            </div>
        </div>
    </div>
@endsection
