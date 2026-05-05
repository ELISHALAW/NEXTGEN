<!-- layouts/partials/header.blade.php -->

<div class="bg-[#252525]">
    <header id="main-header" class="bg-[#252525] shadow-xl sticky top-0 z-50 py-6 border-b border-gray-800">
        <nav class="max-w-7xl mx-auto px-6 flex justify-between items-center">

            <!-- Logo -->
            <a href="{{ url('/') }}" class="flex items-center">
                <img id="nav-logo" src="{{ asset('images/white.png') }}" class="h-16 w-auto object-contain"
                    alt="Gimas Studio">
            </a>

            <!-- Desktop Navigation -->
            <ul class="hidden md:flex items-center gap-8 text-white">
                <li><a href="#home"
                        class="hover:text-amber-400 transition-colors flex items-center gap-2 font-medium">
                        <i class="fa-solid fa-house"></i> Home
                    </a></li>
                <li><a href="#about"
                        class="hover:text-amber-400 transition-colors flex items-center gap-2 font-medium">
                        <i class="fa-solid fa-info-circle"></i> About
                    </a></li>
                <li><a href="#promotion"
                        class="hover:text-amber-400 transition-colors flex items-center gap-2 font-medium">
                        <i class="fa-solid fa-bullhorn"></i> Promotion
                    </a></li>
                <li><a href="#fashion"
                        class="hover:text-amber-400 transition-colors flex items-center gap-2 font-medium">
                        <i class="fa-solid fa-shirt"></i> Fashion
                    </a></li>
                <li><a href="#contact"
                        class="hover:text-amber-400 transition-colors flex items-center gap-2 font-medium">
                        <i class="fa-solid fa-envelope"></i> Contact
                    </a></li>

                <!-- Cart -->
                <li>
                    <a href="#"
                        class="relative flex items-center gap-2 hover:text-amber-400 transition-colors font-medium">
                        <i class="fa-solid fa-bag-shopping text-xl"></i>
                        <span>Bag</span>
                        <span id="bag-count"
                            class="absolute -top-1 -right-1 bg-amber-500 text-[10px] font-bold px-1.5 py-px rounded-full hidden">0</span>
                    </a>
                </li>
            </ul>

            <!-- Mobile Menu Button -->
            <button id="menu-open-button" class="md:hidden text-3xl text-white">
                <i class="fas fa-bars"></i>
            </button>
        </nav>
    </header>

    <!-- Mobile Menu -->
    <div id="menu-overlay"
        class="menu-overlay fixed inset-0 bg-black/70 opacity-0 pointer-events-none transition-all md:hidden z-[9999]">
    </div>

    <div
        class="nav-menu fixed top-0 right-0 h-full w-72 bg-[#252525] shadow-2xl translate-x-full transition-transform duration-300 p-6 md:hidden z-[9999]">
        <div class="flex justify-end mb-8">
            <button id="menu-close-button" class="text-3xl text-white">
                <i class="fas fa-xmark"></i>
            </button>
        </div>
        <ul class="space-y-6 text-white text-lg">
            <li><a href="#home" class="block nav-link">Home</a></li>
            <li><a href="#about" class="block nav-link">About Us</a></li>
            <li><a href="#promotion" class="block nav-link">Promotion</a></li>
            <li><a href="#fashion" class="block nav-link">Fashion</a></li>
            <li><a href="#contact" class="block nav-link">Contact Us</a></li>
        </ul>
    </div>
</div>
