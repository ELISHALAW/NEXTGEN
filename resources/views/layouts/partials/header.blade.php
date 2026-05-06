<div class="bg-[#111111]">
    <header id="main-header" class="bg-[#111111] sticky top-0 z-50 py-6">
        <nav class="max-w-7xl mx-auto px-8 flex justify-between items-center">

            <!-- Logo (Left) -->
            <a href="{{ url('/') }}" class="flex items-center">
                <img src="{{ asset('images/white.png') }}" class="h-10 w-auto" alt="Gimas Studio">
            </a>

            <!-- Right Side Links -->
            <div class="flex items-center gap-10">
                <ul class="flex items-center gap-10 text-white font-bold uppercase tracking-widest text-xs">

                    {{-- Logic: Only show "Back to Shop" and "Bag" on Shop-related pages --}}
                    @if (Request::routeIs('shop') || Request::routeIs('addToCart') || Request::is('cart*'))

                        {{-- Back to Shop --}}
                        <li>
                            <a href="{{ url('/shop') }}"
                                class="hover:opacity-70 transition-opacity flex items-center gap-2">
                                <i class="fa-solid fa-arrow-left"></i>
                                Back to Shop
                            </a>
                        </li>

                        {{-- Bag --}}
                        <li>
                            <a href="{{ url('/cart') }}"
                                class="flex items-center gap-2 hover:opacity-70 transition-opacity relative">
                                <i class="fa-solid fa-bag-shopping"></i>
                                Bag

                                {{-- Simple Counter --}}
                                @php $cartCount = count((array) session('cart')); @endphp
                                @if ($cartCount > 0)
                                    <span class="ml-1 text-amber-500">({{ $cartCount }})</span>
                                @endif
                            </a>
                        </li>
                    @else
                        {{-- Normal Menu for Home Page --}}
                        <div class="flex items-center gap-8">
                            <a href="{{ route('/') }}"
                                class="text-white hover:text-amber-500 transition-colors font-semibold text-sm tracking-widest flex items-center gap-2">
                                <i class="fa-solid fa-arrow-left text-xs"></i> BACK TO SHOP
                            </a>

                            <!-- Bag with Counter -->
                            <a href="bag.html"
                                class="relative flex items-center gap-2 text-white hover:text-amber-500 transition-colors font-medium group">
                                <i class="fa-solid fa-bag-shopping text-xl"></i>
                                <span class="hidden md:inline">Bag</span>
                                <span id="bag-count"
                                    class="absolute -top-2 -right-2 bg-amber-500 text-white text-[10px] font-bold px-1.5 py-0.5 rounded-full border-2 border-[#1A1A1A] hidden">
                                    0
                                </span>
                            </a>
                        </div>
                    @endif
                </ul>

                {{-- Account/Login icon placed after the list --}}
                @auth
                    <a href="/profile" class="text-white hover:opacity-70 transition-opacity">
                        <i class="fa-solid fa-circle-user text-lg"></i>
                    </a>
                @else
                    <a href=""
                        class="text-white hover:opacity-70 transition-opacity text-xs font-bold uppercase tracking-widest">
                        Login
                    </a>
                @endauth
            </div>

        </nav>
    </header>
</div>
