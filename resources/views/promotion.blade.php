@extends('layouts.app')

@section('title', 'Gimas Studio')


@section('content')

    <section id="promotion" class="relative overflow-hidden py-16 lg:py-24">
        <div class="max-w-7xl mx-auto px-6">

            <!-- Main Banner Card -->
            <div class="relative bg-zinc-950 rounded-[3rem] overflow-hidden shadow-2xl">

                <!-- Background Decorative Blobs -->
                <div class="absolute top-0 right-0 -mt-20 -mr-20 w-96 h-96 bg-blue-600 rounded-full blur-[140px] opacity-20">
                </div>
                <div
                    class="absolute bottom-0 left-0 -mb-20 -ml-20 w-96 h-96 bg-purple-600 rounded-full blur-[140px] opacity-20">
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-2 items-center">

                    <!-- LEFT SIDE: Text Content (FULLY CENTERED) -->
                    <div class="p-10 lg:p-20 relative z-10 flex flex-col items-center text-center">
                        <!-- Centered Badge -->
                        <span
                            class="inline-flex items-center gap-2 px-4 py-1.5 mb-8 text-xs font-bold tracking-widest text-blue-400 uppercase bg-blue-400/10 rounded-full border border-blue-400/20">
                            <span class="relative flex h-2 w-2">
                                <span
                                    class="animate-ping absolute inline-flex h-full w-full rounded-full bg-blue-400 opacity-75"></span>
                                <span class="relative inline-flex rounded-full h-2 w-2 bg-blue-500"></span>
                            </span>
                            Limited Time Offer
                        </span>

                        <h2
                            class="text-7xl lg:text-8xl font-black text-white leading-tight mb-8 flex flex-col items-center">
                            <span class="w-full">NEVER</span>
                            <span
                                class="text-transparent bg-clip-text bg-gradient-to-r from-blue-400 to-purple-500 lg:text-8xl">
                                GIVE UP
                            </span>
                        </h2>

                        <p class="text-gray-400 text-lg lg:text-xl mb-10 max-w-md leading-relaxed mx-auto">
                            Upgrade your style with our premium performance gear. Designed for comfort, built for the grind.
                        </p>

                        <!-- CTA Area -->
                        <div class="flex flex-col sm:flex-row gap-6 items-center justify-center">
                            <a href="{{ route('addToCart.index') }}"
                                class="w-full sm:w-auto text-center px-10 py-4 bg-white text-black font-bold rounded-xl hover:bg-blue-50 transition-all duration-300 hover:scale-105 shadow-xl">
                                Shop Now
                            </a>
                            <div class="flex flex-col items-center sm:items-start">
                                <span class="text-3xl font-bold text-white tracking-tighter">40% OFF</span>
                                <span class="text-gray-500 line-through text-sm">RRP $120</span>
                            </div>
                        </div>

                        <!-- Trust Signal -->
                        <p class="mt-8 text-sm text-gray-500 flex items-center justify-center gap-2">
                            <span class="w-2 h-2 bg-green-500 rounded-full animate-pulse"></span>
                            Offer ends in 12 hours. Free shipping included.
                        </p>
                    </div>

                    <!-- RIGHT SIDE: Image -->
                    <div
                        class="relative h-96 lg:h-full min-h-[500px] bg-zinc-800 flex items-center justify-center group overflow-hidden">
                        <img src="images/minglong3.jpeg" alt="Promotion Image"
                            class="absolute inset-0 w-full h-full object-cover mix-blend-luminosity group-hover:mix-blend-normal transition-all duration-1000 group-hover:scale-110">
                        <!-- Dark Gradient Overlay -->
                        <div
                            class="absolute inset-0 bg-gradient-to-t from-zinc-950 via-transparent to-transparent lg:bg-gradient-to-l lg:from-zinc-950">
                        </div>
                    </div>

                </div>
            </div>

            <!-- Bottom Mini-Promos -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mt-12">
                <div
                    class="p-8 bg-white border border-gray-100 rounded-3xl flex items-center gap-5 hover:shadow-xl transition-all duration-300 hover:-translate-y-1">
                    <div class="w-14 h-14 bg-blue-50 rounded-2xl flex items-center justify-center text-blue-600 text-2xl">
                        <i class="fa-solid fa-truck-fast"></i>
                    </div>
                    <div>
                        <h4 class="font-bold text-zinc-900">Fast Delivery</h4>
                        <p class="text-sm text-gray-500 font-medium">2-3 business days</p>
                    </div>
                </div>

                <div
                    class="p-8 bg-white border border-gray-100 rounded-3xl flex items-center gap-5 hover:shadow-xl transition-all duration-300 hover:-translate-y-1">
                    <div
                        class="w-14 h-14 bg-purple-50 rounded-2xl flex items-center justify-center text-purple-600 text-2xl">
                        <i class="fa-solid fa-shield-check"></i>
                    </div>
                    <div>
                        <h4 class="font-bold text-zinc-900">Secure Payment</h4>
                        <p class="text-sm text-gray-500 font-medium">SSL Encrypted</p>
                    </div>
                </div>

                <div
                    class="p-8 bg-white border border-gray-100 rounded-3xl flex items-center gap-5 hover:shadow-xl transition-all duration-300 hover:-translate-y-1">
                    <div class="w-14 h-14 bg-green-50 rounded-2xl flex items-center justify-center text-green-600 text-2xl">
                        <i class="fa-solid fa-rotate-left"></i>
                    </div>
                    <div>
                        <h4 class="font-bold text-zinc-900">Free Returns</h4>
                        <p class="text-sm text-gray-500 font-medium">30-day money back</p>
                    </div>
                </div>
            </div>

        </div>
    </section>
@endsection
