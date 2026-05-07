@extends('layouts.admin')

@section('content')
    <div class="max-w-6xl mx-auto px-4 py-8">
        <!-- Sophisticated Header -->
        <div class="flex items-center justify-between mb-10">
            <div>
                <h2
                    class="text-4xl font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-slate-900 to-slate-600 tracking-tight">
                    Staff & Users
                </h2>
                <p class="text-slate-500 font-medium mt-1">Manage platform permissions and account security.</p>
            </div>
            <a href="{{ route('admin.users.create') }}"
                class="bg-slate-900 text-white px-6 py-3 rounded-full font-bold hover:bg-blue-600 transition-all duration-300 flex items-center gap-2 shadow-xl shadow-slate-200">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd"
                        d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z"
                        clip-rule="evenodd" />
                </svg>
                Add Account
            </a>
        </div>

        <!-- Minimalist Search & Filter Bar -->
        <div class="flex flex-wrap items-center gap-4 mb-6">
            <div class="relative flex-1 min-w-[300px]">
                <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-slate-400">
                    <i class="fa-solid fa-magnifying-glass text-sm"></i>
                </span>
                <input type="text" placeholder="Search by name or email..."
                    class="w-full pl-10 pr-4 py-3 bg-white border border-slate-200 rounded-2xl focus:ring-2 focus:ring-blue-500 focus:border-transparent outline-none transition-all shadow-sm">
            </div>
            <div class="flex gap-2">
                <button
                    class="px-5 py-3 bg-white border border-slate-200 rounded-2xl text-slate-600 font-semibold hover:bg-slate-50 transition shadow-sm">
                    Filter
                </button>
                <button
                    class="px-5 py-3 bg-white border border-slate-200 rounded-2xl text-slate-600 font-semibold hover:bg-slate-50 transition shadow-sm text-sm">
                    Export <i class="fa-solid fa-download ml-1 text-xs"></i>
                </button>
            </div>
        </div>

        <!-- The "Glass-Table" Design -->
        <div
            class="bg-white/70 backdrop-blur-md rounded-[2.5rem] border border-slate-100 shadow-2xl shadow-slate-200/50 overflow-hidden">
            <table class="w-full text-left">
                <thead>
                    <tr class="text-slate-400 text-xs font-bold uppercase tracking-[0.2em] border-b border-slate-50">
                        <th class="px-8 py-6">Identity</th>
                        <th class="px-8 py-6">Security Role</th>
                        <th class="px-8 py-6 text-center">Contact Status</th>
                        <th class="px-8 py-6 text-right">Settings</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-50">
                    @foreach ($users as $user)
                        <tr class="group hover:bg-slate-50/80 transition-all duration-300">
                            <td class="px-8 py-6">
                                <div class="flex items-center gap-4">
                                    <div class="relative">
                                        <div
                                            class="w-12 h-12 rounded-2xl bg-gradient-to-br from-slate-100 to-slate-200 flex items-center justify-center font-bold text-slate-500 text-lg group-hover:from-blue-500 group-hover:to-blue-600 group-hover:text-white transition-all duration-500 shadow-inner">
                                            {{ strtoupper(substr($user->name, 0, 1)) }}
                                        </div>
                                        <div
                                            class="absolute -bottom-1 -right-1 w-4 h-4 bg-green-500 border-2 border-white rounded-full">
                                        </div>
                                    </div>
                                    <div>
                                        <h4 class="font-bold text-slate-800 tracking-tight">{{ $user->name }}</h4>
                                        <span class="text-xs font-medium text-slate-400">{{ $user->email }}</span>
                                    </div>
                                </div>
                            </td>
                            <td class="px-8 py-6">
                                @if ($user->role === 'admin')
                                    <div
                                        class="inline-flex items-center px-3 py-1 bg-indigo-50 text-indigo-600 rounded-lg text-[11px] font-bold uppercase tracking-wider border border-indigo-100">
                                        <span class="w-1.5 h-1.5 bg-indigo-500 rounded-full mr-2"></span>
                                        Administrator
                                    </div>
                                @else
                                    <div
                                        class="inline-flex items-center px-3 py-1 bg-slate-100 text-slate-500 rounded-lg text-[11px] font-bold uppercase tracking-wider border border-slate-200">
                                        <span class="w-1.5 h-1.5 bg-slate-400 rounded-full mr-2"></span>
                                        Standard User
                                    </div>
                                @endif
                            </td>
                            <td class="px-8 py-6 text-center">
                                <span class="text-sm font-semibold text-slate-600">{{ $user->phone_number ?? '—' }}</span>
                            </td>
                            <td class="px-8 py-6">
                                <div class="flex justify-end items-center gap-3">
                                    <a href="{{ route('admin.users.edit', $user->id) }}"
                                        class="w-10 h-10 flex items-center justify-center rounded-xl text-slate-400 hover:bg-white hover:text-blue-600 hover:shadow-md transition-all">
                                        <i class="fa-solid fa-sliders text-sm"></i>
                                    </a>

                                    <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST"
                                        onsubmit="return confirm('Archive this user?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="w-10 h-10 flex items-center justify-center rounded-xl text-slate-400 hover:bg-white hover:text-red-500 hover:shadow-md transition-all">
                                            <i class="fa-solid fa-trash-can text-sm"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <!-- Pagination Placeholder -->
            <div class="p-6 bg-slate-50/50 border-t border-slate-100 flex justify-between items-center">
                <p class="text-xs font-bold text-slate-400 uppercase tracking-widest">Showing {{ $users->count() }} records
                </p>
                <div class="flex gap-2">
                    <button
                        class="p-2 w-8 h-8 rounded-lg bg-white border border-slate-200 flex items-center justify-center text-slate-400 hover:text-slate-800 transition">
                        <i class="fa-solid fa-chevron-left text-[10px]"></i>
                    </button>
                    <button
                        class="p-2 w-8 h-8 rounded-lg bg-white border border-slate-200 flex items-center justify-center text-slate-400 hover:text-slate-800 transition">
                        <i class="fa-solid fa-chevron-right text-[10px]"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
@endsection
