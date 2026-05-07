@extends('layouts.admin')

@section('content')
    <div class="mb-8 flex flex-col md:flex-row md:items-center md:justify-between gap-4">
        <div>
            <h1 class="text-2xl font-bold text-slate-800">Dashboard Overview</h1>
            <p class="text-slate-500">Welcome back, {{ Auth::user()->name }}.</p>
        </div>
        <a href="{{ route('admin.users.create') }}"
            class="inline-flex items-center justify-center px-4 py-2 bg-blue-600 text-white text-sm font-bold rounded-xl hover:bg-blue-700 transition-all shadow-sm shadow-blue-200">
            <i class="fas fa-plus mr-2"></i> Add New User
        </a>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex items-center">
            <div class="p-3 rounded-xl bg-blue-50 text-blue-600 mr-4">
                <i class="fas fa-users text-2xl"></i>
            </div>
            <div>
                <p class="text-sm text-gray-500 font-medium">Total Users</p>
                <h3 class="text-2xl font-bold text-gray-800">{{ $users->count() }}</h3>
            </div>
        </div>

        <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex items-center">
            <div class="p-3 rounded-xl bg-purple-50 text-purple-600 mr-4">
                <i class="fas fa-user-shield text-2xl"></i>
            </div>
            <div>
                <p class="text-sm text-gray-500 font-medium">Admins</p>
                <h3 class="text-2xl font-bold text-gray-800">{{ $users->where('role', 'admin')->count() }}</h3>
            </div>
        </div>

        <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex items-center">
            <div class="p-3 rounded-xl bg-green-50 text-green-600 mr-4">
                <i class="fas fa-bolt text-2xl"></i>
            </div>
            <div>
                <p class="text-sm text-gray-500 font-medium">New Today</p>
                <h3 class="text-2xl font-bold text-gray-800">
                    {{ $users->where('created_at', '>=', now()->today())->count() }}</h3>
            </div>
        </div>

        <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex items-center">
            <div class="p-3 rounded-xl bg-orange-50 text-orange-600 mr-4">
                <i class="fas fa-server text-2xl"></i>
            </div>
            <div>
                <p class="text-sm text-gray-500 font-medium">System</p>
                <h3 class="text-2xl font-bold text-green-600 text-sm">Operational</h3>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <div class="lg:col-span-2 bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="p-6 border-b border-gray-100 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                <h3 class="text-lg font-bold text-gray-800">Recent Users</h3>

                <div class="relative">
                    <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-400">
                        <i class="fas fa-search text-xs"></i>
                    </span>
                    <input type="text"
                        class="block w-full sm:w-64 pl-9 pr-3 py-2 bg-gray-50 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 transition-all"
                        placeholder="Filter users...">
                </div>
            </div>

            <div class="overflow-x-auto">
                @include('admin.partials.user-table')
            </div>

            <div class="p-4 border-t border-gray-50 bg-gray-50/50">
                <button class="w-full text-sm text-blue-600 font-semibold hover:text-blue-700 transition-colors">
                    View Full User Report <i class="fas fa-arrow-right ml-1"></i>
                </button>
            </div>
        </div>

        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 flex flex-col">
            <div class="p-6 border-b border-gray-100">
                <h3 class="text-lg font-bold text-gray-800">Recent Activity</h3>
            </div>

            <div class="p-6 space-y-6 flex-1">
                @forelse($users->take(5) as $user)
                    <div class="flex items-start">
                        <div
                            class="h-8 w-8 rounded-full bg-blue-50 text-blue-600 flex items-center justify-center mr-3 mt-1 shrink-0">
                            <i class="fas fa-user-plus text-[10px]"></i>
                        </div>
                        <div>
                            <p class="text-sm text-gray-800">
                                <span class="font-bold">{{ $user->name }}</span> joined the platform.
                            </p>
                            <p class="text-xs text-gray-400">{{ $user->created_at->diffForHumans() }}</p>
                        </div>
                    </div>
                @empty
                    <p class="text-sm text-gray-500 text-center py-4">No recent activity.</p>
                @endforelse
            </div>
        </div>
    </div>
@endsection
