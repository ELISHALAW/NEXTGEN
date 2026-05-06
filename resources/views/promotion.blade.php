@extends('layouts.app')

@section('title', 'Gimas Studio')

@section('content')
    <style>
        @keyframes gradientShift {
            0% {
                background-position: 0% 50%;
            }

            100% {
                background-position: 100% 50%;
            }
        }
    </style>

    <section id="promotion" class="relative overflow-hidden py-16 lg:py-24 bg-white">
        <div class="max-w-7xl mx-auto px-6">

            <!-- Main Banner -->
            <div class="relative bg-zinc-950 rounded-[3rem] overflow-hidden shadow-2xl border border-white/10">

                <!-- Background Glow -->
                <div class="absolute -top-10 -left-10 w-72 h-72 bg-blue-500/20 blur-[120px] rounded-full"></div>
                <div class="absolute top-0 right-0 w-96 h-96 bg-cyan-500/10 rounded-full blur-3xl -mt-20 -mr-20"></div>
                <div class="absolute bottom-0 left-0 w-96 h-96 bg-blue-500/10 rounded-full blur-3xl -mb-20 -ml-20"></div>

                <div class="grid grid-cols-1 lg:grid-cols-2 min-h-[640px] lg:min-h-[700px]">

                    <!-- LEFT: Content -->
                    <div class="p-10 lg:p-16 xl:p-20 flex flex-col justify-center relative z-10">

                        <!-- Badge -->
                        <div
                            class="inline-flex items-center px-6 py-2.5 mb-10 text-sm font-bold tracking-widest text-cyan-400 bg-cyan-950/70 border border-cyan-400/30 rounded-full">
                            <span class="relative flex h-3 w-3 mr-3">
                                <span
                                    class="animate-ping absolute inline-flex h-full w-full rounded-full bg-cyan-400 opacity-75"></span>
                                <span class="relative inline-flex rounded-full h-3 w-3 bg-cyan-400"></span>
                            </span>
                            LIMITED TIME OFFER
                        </div>

                        <!-- Headline -->
                        <div class="flex flex-col lg:flex-row lg:items-end gap-6 lg:gap-4 xl:gap-6 mb-10 relative">
                            <!-- Glow Behind Text -->
                            <div class="absolute -top-10 -left-10 w-72 h-72 bg-blue-500/20 blur-[120px] rounded-full"></div>

                            <!-- NEVER GIVE UP -->
                            <div>
                                <h2
                                    class="text-6xl md:text-7xl lg:text-8xl font-black 
                                           text-white leading-[0.85] tracking-[-0.05em]
                                           drop-shadow-[0_5px_20px_rgba(255,255,255,0.15)]">
                                    NEVER
                                </h2>

                                <h2 class="text-7xl font-black tracking-[-0.05em] -mt-4"
                                    style="
        background: linear-gradient(to right, #3b82f6, #818cf8, #a855f7);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    ">
                                    GIVE UP
                                </h2>
                            </div>

                            <!-- 20% OFF -->
                            <div class="lg:mb-2 lg:-ml-4 xl:-ml-1">
                                <span
                                    class="block text-7xl xl:text-[5.5rem] font-black text-white tracking-[-3px] leading-none">
                                    20%
                                </span>
                                <span
                                    class="block text-6xl lg:text-7xl font-black text-white tracking-tighter leading-none -mt-4">
                                    OFF
                                </span>
                            </div>
                        </div>

                        <!-- Description -->
                        <p class="text-zinc-400 text-lg lg:text-xl max-w-md leading-relaxed mb-12">
                            Upgrade your style with our premium performance gear.
                            Designed for comfort, built for the grind.
                        </p>

                        <!-- CTA Button -->
                        <a href="{{ route('Shop.index') }}"
                            class="inline-block px-10 py-4 bg-white text-black font-bold text-lg rounded-2xl 
                                  hover:bg-white/90 transition-all active:scale-95 shadow-lg shadow-white/10">
                            Shop Now →
                        </a>

                        <!-- Footer -->
                        <div class="mt-auto pt-12 flex items-center gap-3 text-sm text-zinc-400">
                            <span class="w-2 h-2 bg-emerald-500 rounded-full animate-pulse"></span>
                            Offer ends in <span class="text-emerald-400 font-semibold">12 hours</span>.
                            Free shipping included.
                        </div>
                    </div>

                    <!-- RIGHT: Image -->
                    <div class="relative group overflow-hidden min-h-[400px] lg:min-h-full">
                        <img src="{{ asset('images/minglong3.jpeg') }}" alt="Model wearing premium streetwear"
                            class="absolute inset-0 w-full h-full object-cover transition-all duration-700 group-hover:scale-110">

                        <div
                            class="absolute inset-0 bg-gradient-to-t from-black via-black/50 to-transparent lg:bg-gradient-to-l lg:from-black/90 lg:via-black/30">
                        </div>

                        <!-- Shirt Text -->
                        <div
                            class="absolute bottom-10 right-10 text-white/80 text-right text-sm font-mono tracking-widest leading-tight hidden lg:block">
                            ONE<br>AT A<br>TIME
                        </div>
                    </div>

                </div>
            </div>

            <!-- Trust Bar -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-12">
                @foreach ([['icon' => 'truck-fast', 'title' => 'Fast Delivery', 'desc' => '2-3 business days'], ['icon' => 'shield-check', 'title' => 'Secure Payment', 'desc' => 'SSL Encrypted'], ['icon' => 'rotate-left', 'title' => 'Free Returns', 'desc' => '30-day money back']] as $item)
                    <div
                        class="bg-zinc-900/70 border border-white/5 hover:border-white/10 rounded-3xl p-8 flex items-center gap-6 transition-all hover:-translate-y-1">
                        <div
                            class="w-16 h-16 bg-gradient-to-br from-cyan-500/10 to-blue-500/10 rounded-2xl flex items-center justify-center text-3xl text-cyan-400">
                            <i class="fa-solid fa-{{ $item['icon'] }}"></i>
                        </div>
                        <div>
                            <h4 class="font-semibold text-white">{{ $item['title'] }}</h4>
                            <p class="text-zinc-500 text-sm">{{ $item['desc'] }}</p>
                        </div>
                    </div>
                @endforeach
            </div>

        </div>
    </section>
@endsection
