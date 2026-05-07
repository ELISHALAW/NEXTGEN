<header class="bg-white border-b border-gray-200 h-16 flex items-center justify-between px-8 sticky top-0 z-10">
    <div class="relative w-96 hidden lg:block">
        <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-400">
            <i class="fas fa-search"></i>
        </span>
        <input type="text"
            class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-lg bg-gray-50 placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-blue-500 sm:text-sm"
            placeholder="Search analytics...">
    </div>

    <div class="flex items-center space-x-6">
        <button class="text-gray-400 hover:text-gray-600 relative">
            <i class="fas fa-bell text-xl"></i>
            <span
                class="absolute -top-1 -right-1 bg-red-500 text-white text-[10px] font-bold px-1 rounded-full">3</span>
        </button>

        <div class="relative group h-16 flex items-center">
            <div class="flex items-center space-x-3 border-l pl-6 border-gray-200 cursor-pointer">
                <div class="text-right hidden sm:block">
                    <p class="text-sm font-bold text-gray-800 leading-none">{{ Auth::user()->name }}</p>
                    <p class="text-xs font-medium text-blue-600 mt-1 uppercase">{{ Auth::user()->role }}</p>
                </div>
                <div class="relative">
                    <img class="h-10 w-10 rounded-xl object-cover ring-2 ring-gray-100"
                        src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=0D8ABC&color=fff"
                        alt="Avatar">
                    <div class="absolute bottom-0 right-0 h-3 w-3 bg-green-500 border-2 border-white rounded-full">
                    </div>
                </div>
                <i
                    class="fas fa-chevron-down text-xs text-gray-400 transition-transform duration-200 group-hover:rotate-180"></i>
            </div>

            <div
                class="absolute right-0 top-full w-48 bg-white rounded-xl shadow-xl py-2 border border-gray-100 z-50 
                        invisible opacity-0 translate-y-2 transition-all duration-200 
                        group-hover:visible group-hover:opacity-100 group-hover:translate-y-0">
                <a href="#" class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-blue-50 transition">
                    <i class="fas fa-user-circle mr-3"></i> Profile
                </a>
                <hr class="my-1 border-gray-50">
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit"
                        class="w-full text-left flex items-center px-4 py-2 text-sm text-red-600 hover:bg-red-50 transition">
                        <i class="fas fa-sign-out-alt mr-3"></i> Logout
                    </button>
                </form>
            </div>
        </div>
    </div>
</header>
