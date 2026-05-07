@extends('layouts.app')

@section('content')
    <div class="min-h-screen bg-[#0a0a0a] flex overflow-hidden">

        <!-- Left Side: Cinematic Background -->
        <div class="hidden lg:flex lg:w-1/2 relative bg-[#111111] items-center justify-center">
            <!-- Background Image/Overlay -->
            <div class="absolute inset-0 z-0">
                <!-- Using a different artistic studio image for registration -->
                <img src="https://images.unsplash.com/photo-1558655146-d09347e92766?auto=format&fit=crop&q=80"
                    class="w-full h-full object-cover opacity-30 grayscale" alt="Creative Workspace">
                <div class="absolute inset-0 bg-gradient-to-r from-transparent to-[#0a0a0a]"></div>
            </div>

            <!-- Floating Content on Image -->
            <div class="relative z-10 px-12">
                <div class="space-y-4">
                    <img src="{{ asset('images/white.png') }}" class="h-12 w-auto mb-8" alt="Gimas Studio">
                    <h1 class="text-6xl font-black text-white leading-tight uppercase italic tracking-tighter">
                        Begin Your <br><span class="text-amber-500">Creative</span> Journey.
                    </h1>
                    <p class="text-gray-400 max-w-md text-lg font-medium leading-relaxed">
                        Access our full suite of professional tools and join a global network of elite digital creators.
                    </p>
                </div>
            </div>

            <!-- Bottom Left Badge -->
            <div class="absolute bottom-10 left-12 z-10">
                <div class="flex items-center space-x-3 text-xs tracking-widest text-gray-500 uppercase font-bold">
                    <span class="w-8 h-[1px] bg-amber-500"></span>
                    <span>Join the Studio</span>
                </div>
            </div>
        </div>

        <!-- Right Side: Register Form -->
        <div
            class="w-full lg:w-1/2 flex flex-col justify-center px-8 py-12 sm:px-16 lg:px-24 bg-[#0a0a0a] relative overflow-y-auto">

            <!-- Mobile Logo (Hidden on Desktop) -->
            <div class="lg:hidden absolute top-8 left-8">
                <img src="{{ asset('images/white.png') }}" class="h-8 w-auto" alt="Gimas Studio">
            </div>

            <div class="max-w-md w-full mx-auto space-y-8">
                <!-- Header -->
                <div>
                    <h2 class="text-4xl font-black text-white uppercase italic tracking-tight">
                        Create Account
                    </h2>
                    <p class="mt-3 text-gray-400 font-medium">
                        Already a member?
                        <a href="{{ route('login') }}"
                            class="text-amber-500 hover:text-amber-400 underline underline-offset-4 decoration-amber-500/30 transition-all">
                            Sign in here
                        </a>
                    </p>
                </div>

                <!-- Error Messages -->
                @if ($errors->any())
                    <div class="p-4 rounded-xl bg-red-500/10 border border-red-500/20 text-red-400 text-sm">
                        <ul class="list-disc list-inside space-y-1 font-medium">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form class="space-y-5" action="{{ route('register') }}" method="POST">
                    @csrf

                    <div class="grid grid-cols-1 gap-5">
                        <!-- Full Name -->
                        <div>
                            <label for="name"
                                class="block text-xs font-bold uppercase tracking-[0.2em] text-gray-500 mb-2 ml-1">Full
                                Name</label>
                            <input id="name" name="name" type="text" required
                                class="block w-full px-5 py-3.5 border border-white/5 rounded-2xl bg-white/5 text-white placeholder-gray-600 focus:outline-none focus:ring-2 focus:ring-amber-500/50 focus:bg-white/10 transition-all duration-300"
                                placeholder="John Doe" value="{{ old('name') }}">
                        </div>

                        <!-- Email -->
                        <div>
                            <label for="email"
                                class="block text-xs font-bold uppercase tracking-[0.2em] text-gray-500 mb-2 ml-1">Email
                                address</label>
                            <input id="email" name="email" type="email" autocomplete="email" required
                                class="block w-full px-5 py-3.5 border border-white/5 rounded-2xl bg-white/5 text-white placeholder-gray-600 focus:outline-none focus:ring-2 focus:ring-amber-500/50 focus:bg-white/10 transition-all duration-300"
                                placeholder="name@company.com" value="{{ old('email') }}">
                        </div>

                        <!-- Phone Number -->
                        <div>
                            <label for="phone"
                                class="block text-xs font-bold uppercase tracking-[0.2em] text-gray-500 mb-2 ml-1">Phone
                                Number</label>
                            <input id="phone" name="phone_number" type="tel" required
                                class="block w-full px-5 py-3.5 border border-white/5 rounded-2xl bg-white/5 text-white placeholder-gray-600 focus:outline-none focus:ring-2 focus:ring-amber-500/50 focus:bg-white/10 transition-all duration-300"
                                placeholder="+60 12-345 6789" value="{{ old('phone_number') }}">
                        </div>

                        <!-- Passwords Grid -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                            <div>
                                <label for="password"
                                    class="block text-xs font-bold uppercase tracking-[0.2em] text-gray-500 mb-2 ml-1">Password</label>
                                <input id="password" name="password" type="password" required
                                    class="block w-full px-5 py-3.5 border border-white/5 rounded-2xl bg-white/5 text-white focus:outline-none focus:ring-2 focus:ring-amber-500/50 focus:bg-white/10 transition-all duration-300">
                            </div>
                            <div>
                                <label for="password_confirmation"
                                    class="block text-xs font-bold uppercase tracking-[0.2em] text-gray-500 mb-2 ml-1">Confirm</label>
                                <input id="password_confirmation" name="password_confirmation" type="password" required
                                    class="block w-full px-5 py-3.5 border border-white/5 rounded-2xl bg-white/5 text-white focus:outline-none focus:ring-2 focus:ring-amber-500/50 focus:bg-white/10 transition-all duration-300">
                            </div>
                        </div>
                    </div>

                    <!-- Terms -->
                    <div class="flex items-start">
                        <div class="flex items-center h-5">
                            <input id="terms" name="terms" type="checkbox" required
                                class="h-4 w-4 text-amber-500 focus:ring-amber-500/50 border-white/10 bg-white/5 rounded cursor-pointer">
                        </div>
                        <div class="ml-3 text-sm">
                            <label for="terms" class="text-gray-400 font-medium">
                                I agree to the <a href="#" class="text-amber-500 hover:text-amber-400">Terms of
                                    Service</a> and <a href="#" class="text-amber-500 hover:text-amber-400">Privacy
                                    Policy</a>.
                            </label>
                        </div>
                    </div>

                    <!-- Action Button -->
                    <button type="submit"
                        class="w-full py-4 bg-white hover:bg-amber-500 text-black hover:text-white text-sm font-black uppercase tracking-[0.2em] rounded-2xl transition-all duration-300 active:scale-[0.98] shadow-lg shadow-white/5 hover:shadow-amber-500/20">
                        Register Account
                    </button>
                </form>

                <!-- Footer -->
                <p class="text-center text-[10px] text-gray-700 uppercase tracking-[0.4em] pt-4">
                    &copy; {{ date('Y') }} Gimas Studio &bull; Creative Excellence
                </p>
            </div>
        </div>
    </div>
@endsection
