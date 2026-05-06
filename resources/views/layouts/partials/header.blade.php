<div class="bg-[#252525]">
    <header id="main-header" class="bg-[#252525] shadow-xl border-b border-white/5 sticky top-0 z-50 py-4">
        <nav class="max-w-7xl mx-auto px-6 flex justify-between items-center">

            <!-- Logo -->
            <!-- Logo -->
            <a href="{{ route('home') }}" class="group flex items-center gap-2">
                <!-- Increased from h-10 to h-16 (64px) or h-20 (80px) -->
                <img src="{{ asset('images/white.png') }}"
                    class="h-16 w-auto group-hover:scale-105 transition-transform duration-300" alt="Gimas Studio">
            </a>

            <!-- Desktop Menu -->
            <ul
                class="hidden md:flex items-center gap-x-6 lg:gap-x-8 text-[11px] font-bold uppercase tracking-[0.15em] text-white/90">

                @if (Request::is('/'))
                    <li><a href="#home" class="hover:text-amber-400 transition-all flex items-center gap-2"><i
                                class="fa-regular fa-house"></i> Home</a></li>
                    <li><a href="#about" class="hover:text-amber-400 transition-all flex items-center gap-2"><i
                                class="fa-solid fa-users-gear"></i> About Us</a></li>
                    <li><a href="#promotion" class="hover:text-amber-400 transition-all flex items-center gap-2"><i
                                class="fa-solid fa-rectangle-ad"></i> Promotion</a></li>
                    <li><a href="#fashion" class="hover:text-amber-400 transition-all flex items-center gap-2"><i
                                class="fa-brands fa-cotton-bureau"></i> Fashion</a></li>
                    <li><a href="#contact" class="hover:text-amber-400 transition-all flex items-center gap-2"><i
                                class="fa-regular fa-address-book"></i> Contact Us</a></li>
                @else
                    <li>
                        <a href="{{ route('home') }}"
                            class="hover:text-amber-400 transition-colors flex items-center gap-2 group">
                            <i
                                class="fa-solid fa-arrow-left text-[10px] group-hover:-translate-x-1 transition-transform"></i>
                            Back to Shop
                        </a>
                    </li>
                @endif

                <!-- Bag Icon -->
                <li>
                    <a href="{{ url('/cart') }}"
                        class="relative flex items-center gap-2 group hover:text-amber-400 transition-colors">
                        <i class="fa-solid fa-bag-shopping text-base"></i>
                        <span>Bag</span>
                        @php $cartCount = count((array) session('cart')); @endphp
                        @if ($cartCount > 0)
                            <span
                                class="absolute -top-2 -right-3 bg-amber-500 text-[#252525] text-[9px] font-black h-4 w-4 flex items-center justify-center rounded-full">
                                {{ $cartCount }}
                            </span>
                        @endif
                    </a>
                </li>

                <!-- Profile Dropdown - Improved Design -->
                <li class="border-l border-white/20 pl-4 lg:pl-6 relative group">
                    @auth
                        <button class="flex items-center gap-2 hover:text-amber-400 transition-colors focus:outline-none">
                            <i class="fa-solid fa-circle-user text-2xl"></i>
                        </button>

                        <!-- Dropdown Menu -->
                        <div
                            class="absolute right-0 mt-3 w-56 bg-[#1f1f1f] border border-white/10 rounded-3xl shadow-2xl py-2 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 z-50 overflow-hidden">

                            <!-- User Info -->
                            <div class="px-5 py-4 border-b border-white/10">
                                <p class="text-white font-semibold text-base">{{ Auth::user()->name }}</p>
                                <p class="text-xs text-gray-400 mt-0.5">{{ Auth::user()->email }}</p>
                            </div>

                            <!-- Menu Items -->
                            <div class="py-1">
                                <a href="/profile"
                                    class="flex items-center gap-3 px-5 py-3 text-sm text-gray-200 hover:bg-white/5 hover:text-white transition-colors">
                                    <i class="fa-solid fa-user w-4"></i>
                                    <span>My Profile</span>
                                </a>
                            </div>

                            <!-- Logout -->
                            <div class="border-t border-white/10 pt-1 mt-1">
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button type="submit"
                                        class="flex items-center gap-3 px-5 py-3 text-sm text-red-400 hover:bg-white/5 hover:text-red-500 transition-colors w-full text-left">
                                        <i class="fa-solid fa-arrow-right-from-bracket w-4"></i>
                                        <span class="font-medium">Logout</span>
                                    </button>
                                </form>
                            </div>
                        </div>
                    @else
                        <a href="{{ route('login') }}"
                            class="flex items-center gap-2 hover:text-amber-400 transition-colors">
                            <i class="fa-solid fa-circle-user text-2xl"></i>
                        </a>
                    @endauth
                </li>
            </ul>

            <!-- Mobile Menu Button -->
            <button id="menu-open-button" class="md:hidden text-xl text-white hover:text-amber-400">
                <i class="fas fa-bars"></i>
            </button>
        </nav>
    </header>
</div>
