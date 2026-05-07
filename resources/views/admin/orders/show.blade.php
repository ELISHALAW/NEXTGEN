@extends('layouts.admin')

@section('content')
    <div class="flex h-screen bg-slate-50">

        {{-- 1. Ensure Sidebar is included --}}

        <div class="flex-1 flex flex-col overflow-hidden w-full">

            {{-- 2. Ensure Header is included --}}

            <main class="flex-1 overflow-x-hidden overflow-y-auto p-8">
                <div class="max-w-4xl mx-auto">

                    {{-- Back Link & Print Action --}}
                    <div class="flex justify-between items-center mb-6">
                        <a href="{{ route('admin.orders.index') }}"
                            class="text-sm text-indigo-600 hover:text-indigo-800 font-medium flex items-center gap-1 transition">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7">
                                </path>
                            </svg>
                            Back to Orders
                        </a>
                        <div class="flex gap-2">
                            <button onclick="window.print()"
                                class="px-4 py-2 bg-white border border-slate-200 text-slate-700 rounded-lg text-sm font-medium hover:bg-slate-50 shadow-sm transition">
                                Print Invoice
                            </button>
                        </div>
                    </div>

                    {{-- Order Main Card --}}
                    <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden mb-6">
                        <div class="p-6 border-b border-slate-100 flex justify-between items-start bg-white">
                            <div>
                                <h2 class="text-xl font-bold text-slate-900">Order {{ $order->order_number }}</h2>
                                <p class="text-sm text-slate-500">Placed on {{ $order->created_at->format('d M Y, h:i A') }}
                                </p>
                            </div>
                            <div class="text-right">
                                <span
                                    class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-indigo-100 text-indigo-700 uppercase tracking-wider">
                                    {{ $order->status }}
                                </span>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 p-8">
                            {{-- Customer Info --}}
                            <div>
                                <h3 class="text-[11px] font-bold uppercase text-slate-400 tracking-widest mb-3">Customer
                                    Information</h3>
                                <div class="space-y-2">
                                    <div class="flex items-center gap-2">
                                        <span class="text-xs text-slate-500">User ID:</span>
                                        <span class="text-sm font-semibold text-slate-800">#{{ $order->user_id }}</span>
                                    </div>
                                    <div class="flex items-center gap-2">
                                        <span class="text-xs text-slate-500">Payment:</span>
                                        <span
                                            class="text-sm {{ $order->payment_status == 'paid' ? 'text-emerald-600' : 'text-rose-600' }} font-bold uppercase">
                                            {{ $order->payment_status }}
                                        </span>
                                    </div>
                                </div>
                            </div>

                            {{-- Update Status Form --}}
                            <div class="bg-slate-50 p-4 rounded-xl border border-slate-100">
                                <h3 class="text-[11px] font-bold uppercase text-slate-400 tracking-widest mb-3">Update Order
                                    Status</h3>
                                <form action="{{ route('admin.orders.update', $order->id) }}" method="POST"
                                    class="flex gap-2">
                                    @csrf
                                    @method('PUT')
                                    <select name="status"
                                        class="flex-1 text-sm border-slate-200 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                                        <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Pending
                                        </option>
                                        <option value="processing" {{ $order->status == 'processing' ? 'selected' : '' }}>
                                            Processing</option>
                                        <option value="shipped" {{ $order->status == 'shipped' ? 'selected' : '' }}>Shipped
                                        </option>
                                        <option value="completed" {{ $order->status == 'completed' ? 'selected' : '' }}>
                                            Completed</option>
                                        <option value="cancelled" {{ $order->status == 'cancelled' ? 'selected' : '' }}>
                                            Cancelled</option>
                                    </select>
                                    <button type="submit"
                                        class="bg-indigo-600 text-white px-4 py-2 rounded-lg text-sm font-medium hover:bg-indigo-700 transition shadow-sm">
                                        Save
                                    </button>
                                </form>
                            </div>
                        </div>

                        {{-- Totals Table --}}
                        <div class="p-8 pt-0">
                            <div class="border border-slate-100 rounded-xl overflow-hidden shadow-inner">
                                <table class="w-full text-left">
                                    <thead class="bg-slate-50/80">
                                        <tr>
                                            <th
                                                class="px-6 py-3 text-[11px] font-bold text-slate-500 uppercase tracking-wider">
                                                Description</th>
                                            <th
                                                class="px-6 py-3 text-[11px] font-bold text-slate-500 uppercase tracking-wider text-right">
                                                Price</th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-slate-100 bg-white">
                                        <tr>
                                            <td class="px-6 py-4 text-sm text-slate-700 font-medium">Order Total (Item
                                                processing)</td>
                                            <td class="px-6 py-4 text-sm font-bold text-slate-900 text-right">RM
                                                {{ number_format($order->total_amount, 2) }}</td>
                                        </tr>
                                    </tbody>
                                    <tfoot class="bg-slate-50/50">
                                        <tr>
                                            <td class="px-6 py-4 text-sm font-bold text-slate-900 uppercase tracking-tight">
                                                Total Charged</td>
                                            <td class="px-6 py-4 text-xl font-black text-indigo-600 text-right">RM
                                                {{ number_format($order->total_amount, 2) }}</td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>

                    {{-- Admin Notes --}}
                    <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-200">
                        <h3 class="text-sm font-bold text-slate-900 mb-2">Internal Admin Notes</h3>
                        <p class="text-xs text-slate-500 italic">This order was created via the system on
                            {{ $order->created_at->format('d/m/Y') }}. No internal notes recorded.</p>
                    </div>

                </div>
            </main>
        </div>
    </div>
@endsection
