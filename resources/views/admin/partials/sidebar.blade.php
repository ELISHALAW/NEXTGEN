<aside class="w-64 bg-slate-900 text-white flex-shrink-0 hidden md:flex flex-col shadow-xl">
    <div class="p-6 flex items-center space-x-3 border-b border-slate-800">
        <div class="bg-blue-500 p-2 rounded-lg">
            <i class="fas fa-layer-group text-white"></i>
        </div>
        <span class="text-xl font-bold tracking-wider">CORE<span class="text-blue-400">ADMIN</span></span>
    </div>

    <nav class="flex-1 mt-6 px-4 space-y-1 overflow-y-auto">
        <p class="text-xs font-semibold text-slate-500 uppercase px-4 mb-2">Main Menu</p>

        <a href="{{ route('admin.dashboard') }}"
            class="flex items-center py-3 px-4 rounded-xl transition duration-200 {{ request()->routeIs('admin.dashboard') ? 'bg-blue-600 text-white shadow-lg shadow-blue-900/50' : 'text-slate-400 hover:bg-slate-800 hover:text-white' }}">
            <i class="fas fa-chart-pie mr-3 w-5 text-center"></i>
            <span class="font-medium">Dashboard</span>
        </a>

        <a href="{{ route('admin.users.index') }}" {{-- Update this route if you have a specific users.index --}}
            class="flex items-center py-3 px-4 rounded-xl transition duration-200 {{ request()->is('admin/users*') ? 'bg-blue-600 text-white' : 'text-slate-400 hover:bg-slate-800 hover:text-white' }}">
            <i class="fas fa-users mr-3 w-5 text-center"></i>
            <span class="font-medium">User Management</span>
        </a>

        <div class="pt-4">
            <p class="text-xs font-semibold text-slate-500 uppercase px-4 mb-2">Inventory</p>

            <a href="{{ route('admin.products.index') }}"
                class="flex items-center py-3 px-4 rounded-xl transition duration-200 {{ request()->routeIs('admin.products.index') ? 'bg-blue-600 text-white shadow-lg shadow-blue-900/50' : 'text-slate-400 hover:bg-slate-800 hover:text-white' }}">
                <i class="fas fa-boxes mr-3 w-5 text-center"></i>
                <span class="font-medium">Product List</span>
            </a>

            <a href="{{ route('admin.products.create') }}"
                class="flex items-center py-3 px-4 rounded-xl transition duration-200 {{ request()->routeIs('admin.products.create') ? 'bg-blue-600 text-white shadow-lg shadow-blue-900/50' : 'text-slate-400 hover:bg-slate-800 hover:text-white' }}">
                <i class="fas fa-plus-circle mr-3 w-5 text-center"></i>
                <span class="font-medium">Create Product</span>
            </a>
        </div>

        <div class="pt-4">
            <p class="text-xs font-semibold text-slate-500 uppercase px-4 mb-2">Sales</p>
            <a href="{{ route('admin.orders.index') }}"
                class="flex items-center py-3 px-4 rounded-xl text-slate-400 hover:bg-slate-800 hover:text-white transition duration-200  {{ request()->routeIs('admin.orders.index') ? 'bg-blue-600 text-white shadow-lg shadow-blue-900/50' : 'text-slate-400 hover:bg-slate-800 hover:text-white' }}">
                <i class="fas fa-shopping-bag mr-3 w-5 text-center"></i>
                <span class="font-medium">Orders</span>
            </a>
        </div>

        <div class="pt-4">
            <p class="text-xs font-semibold text-slate-500 uppercase px-4 mb-2">Settings</p>
            <a href="#"
                class="flex items-center py-3 px-4 rounded-xl text-slate-400 hover:bg-slate-800 hover:text-white transition duration-200">
                <i class="fas fa-cog mr-3 w-5 text-center"></i>
                <span class="font-medium">System Settings</span>
            </a>
        </div>
    </nav>

    <div class="p-4 border-t border-slate-800">
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit"
                class="w-full flex items-center py-3 px-4 rounded-xl text-red-400 hover:bg-red-500/10 transition duration-200">
                <i class="fas fa-sign-out-alt mr-3 w-5 text-center"></i>
                <span class="font-medium">Logout</span>
            </button>
        </form>
    </div>
</aside>
