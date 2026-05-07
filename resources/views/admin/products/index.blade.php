@extends('layouts.admin')

@section('content')
    <div class="mb-6 flex justify-between items-center">
        <div>
            <h1 class="text-2xl font-bold text-slate-800">Inventory Management</h1>
            <p class="text-slate-500 text-sm">Review and update your product listings.</p>
        </div>
        <a href="{{ route('admin.products.create') }}"
            class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2.5 rounded-xl text-sm font-bold shadow-lg shadow-blue-200 transition-all flex items-center">
            <i class="fas fa-plus mr-2"></i> New Product
        </a>
    </div>

    <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
        <table class="min-w-full divide-y divide-slate-200">
            <thead class="bg-slate-50">
                <tr>
                    <th class="px-6 py-4 text-left text-xs font-bold text-slate-500 uppercase tracking-wider">Product</th>
                    <th class="px-6 py-4 text-left text-xs font-bold text-slate-500 uppercase tracking-wider">Status</th>
                    <th class="px-6 py-4 text-left text-xs font-bold text-slate-500 uppercase tracking-wider">Price</th>
                    <th class="px-6 py-4 text-left text-xs font-bold text-slate-500 uppercase tracking-wider">Stock</th>
                    <th class="px-6 py-4 text-right text-xs font-bold text-slate-500 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-slate-200">
                @forelse ($products as $product)
                    <tr class="hover:bg-slate-50/50 transition-colors">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="h-12 w-12 flex-shrink-0">
                                    @if ($product->image)
                                        <img class="h-12 w-12 rounded-lg object-cover border border-slate-100"
                                            src="{{ asset('storage/' . $product->image) }}" alt="">
                                    @else
                                        <div
                                            class="h-12 w-12 rounded-lg bg-slate-100 flex items-center justify-center text-slate-400">
                                            <i class="fas fa-image"></i>
                                        </div>
                                    @endif
                                </div>
                                <div class="ml-4">
                                    <div class="text-sm font-bold text-slate-900">{{ $product->name }}</div>
                                    <div class="text-xs text-slate-500">{{ $product->slug }}</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            @if ($product->is_active)
                                <span
                                    class="px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-700 border border-green-200">
                                    Active
                                </span>
                            @else
                                <span
                                    class="px-2.5 py-0.5 rounded-full text-xs font-medium bg-slate-100 text-slate-600 border border-slate-200">
                                    Hidden
                                </span>
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span
                                class="text-sm font-semibold text-slate-700">${{ number_format($product->price, 2) }}</span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            @if ($product->stock <= 5)
                                <div class="flex items-center text-red-600 font-bold text-sm">
                                    <i class="fas fa-exclamation-triangle mr-1.5"></i>
                                    {{ $product->stock }} <span
                                        class="ml-1 font-normal text-xs uppercase tracking-tighter">Low Stock</span>
                                </div>
                            @else
                                <span class="text-sm text-slate-600 font-medium">{{ $product->stock }} units</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                            <div class="flex justify-end items-center space-x-3">
                                <a href="{{ route('admin.products.edit', $product) }}"
                                    class="text-slate-400 hover:text-blue-600 transition-colors p-1" title="Edit Product">
                                    <i class="fas fa-edit text-lg"></i>
                                </a>

                                <form action="{{ route('admin.products.destroy', $product) }}" method="POST"
                                    class="inline">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="text-slate-400 hover:text-red-600 transition-colors p-1"
                                        onclick="return confirm('Permanently delete {{ $product->name }}?')">
                                        <i class="fas fa-trash-alt text-lg"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-6 py-12 text-center">
                            <div class="flex flex-col items-center">
                                <i class="fas fa-boxes text-slate-200 text-5xl mb-4"></i>
                                <p class="text-slate-500 font-medium">No products found in your inventory.</p>
                                <a href="{{ route('admin.products.create') }}"
                                    class="text-blue-600 text-sm font-bold mt-2 hover:underline">
                                    Add your first product &rarr;
                                </a>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
