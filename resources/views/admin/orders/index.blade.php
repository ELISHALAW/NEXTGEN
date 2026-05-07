@extends('layouts.admin') {{-- Or wherever your main layout is --}}

@section('content')
    <div class="flex h-screen bg-slate-50">

        {{-- Sidebar --}}

        <div class="flex-1 flex flex-col overflow-hidden">

            {{-- Header --}}

            <main class="flex-1 overflow-x-hidden overflow-y-auto p-8">
                <div class="max-w-7xl mx-auto">

                    <div class="flex justify-between items-center mb-8">
                        <div>
                            <h1 class="text-2xl font-bold text-slate-900">Order Management</h1>
                            <p class="text-sm text-slate-500">Monitor and update customer transactions.</p>
                        </div>
                        <div class="flex gap-3">
                            <button
                                class="flex items-center gap-2 bg-white border border-slate-200 text-slate-700 px-4 py-2 rounded-lg text-sm font-medium hover:bg-slate-50 transition shadow-sm">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                                </svg>
                                Export Report
                            </button>
                        </div>
                    </div>

                    <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
                        <table class="w-full text-left">
                            <thead class="bg-slate-50 border-b border-slate-200">
                                <tr>
                                    <th class="px-6 py-4 text-[11px] font-bold uppercase tracking-wider text-slate-500">
                                        Order ID</th>
                                    <th class="px-6 py-4 text-[11px] font-bold uppercase tracking-wider text-slate-500">User
                                        ID</th>
                                    <th class="px-6 py-4 text-[11px] font-bold uppercase tracking-wider text-slate-500">
                                        Amount</th>
                                    <th class="px-6 py-4 text-[11px] font-bold uppercase tracking-wider text-slate-500">
                                        Status</th>
                                    <th class="px-6 py-4 text-[11px] font-bold uppercase tracking-wider text-slate-500">
                                        Payment</th>
                                    <th
                                        class="px-6 py-4 text-[11px] font-bold uppercase tracking-wider text-slate-500 text-right">
                                        Actions</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-100">
                                @foreach ($orders as $order)
                                    <tr class="hover:bg-slate-50/50 transition">
                                        <td class="px-6 py-4">
                                            <div class="text-sm font-bold text-indigo-600 font-mono">
                                                {{ $order->order_number }}</div>
                                            <div class="text-[11px] text-slate-400 mt-0.5">{{ $order->created_at }}</div>
                                        </td>
                                        <td class="px-6 py-4">
                                            <span
                                                class="inline-flex items-center px-2 py-1 rounded bg-slate-100 text-slate-600 text-xs font-medium">
                                                ID: {{ $order->user_id }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="text-sm font-semibold text-slate-900">RM
                                                {{ number_format($order->total_amount, 2) }}</div>
                                        </td>
                                        <td class="px-6 py-4">
                                            {{-- Inline status update style --}}
                                            <span
                                                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold {{ $order->status == 'pending' ? 'bg-amber-100 text-amber-700' : 'bg-blue-100 text-blue-700' }} uppercase tracking-wide">
                                                {{ $order->status }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4">
                                            @if ($order->payment_status == 'paid')
                                                <span
                                                    class="text-emerald-600 flex items-center gap-1 text-xs font-bold uppercase">
                                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                                        <path fill-rule="evenodd"
                                                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                                            clip-rule="evenodd"></path>
                                                    </svg>
                                                    Paid
                                                </span>
                                            @else
                                                <span class="text-slate-400 text-xs font-bold uppercase">Unpaid</span>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 text-right">
                                            <div class="flex justify-end gap-2">
                                                <a href="{{ route('admin.orders.show', $order->id) }}"
                                                    class="p-2 text-slate-400 hover:text-indigo-600 transition">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                                                        </path>
                                                    </svg>
                                                </a>
                                                <button class="p-2 text-slate-400 hover:text-red-600 transition">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                                        </path>
                                                    </svg>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                </div>
            </main>
        </div>
    </div>
@endsection
