@extends('layouts.admin')

@section('content')
    <div class="max-w-4xl mx-auto">
        <div class="mb-6 flex justify-between items-center">
            <h1 class="text-2xl font-bold text-slate-800">Edit Product: {{ $product->name }}</h1>
            <a href="{{ route('admin.products.index') }}" class="text-slate-500 hover:text-blue-600">
                <i class="fas fa-arrow-left mr-2"></i> Back to List
            </a>
        </div>

        <form action="{{ route('admin.products.update', $product) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT') {{-- Required for Update routes --}}

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <div class="lg:col-span-2 space-y-6">
                    <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-200">
                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-semibold mb-1">Product Name</label>
                                <input type="text" name="name" value="{{ $product->name }}"
                                    class="w-full px-4 py-2 border rounded-xl" required>
                            </div>
                            <div>
                                <label class="block text-sm font-semibold mb-1">Description</label>
                                <textarea name="description" rows="5" class="w-full px-4 py-2 border rounded-xl">{{ $product->description }}</textarea>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="space-y-6">
                    <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-200">
                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-semibold mb-1">Price ($)</label>
                                <input type="number" step="0.01" name="price" value="{{ $product->price }}"
                                    class="w-full px-4 py-2 border rounded-xl" required>
                            </div>
                            <div>
                                <label class="block text-sm font-semibold mb-1">Stock Quantity</label>
                                <input type="number" name="stock" value="{{ $product->stock }}"
                                    class="w-full px-4 py-2 border rounded-xl" required>
                            </div>
                            <div>
                                <label class="block text-sm font-semibold mb-1">Update Image</label>
                                @if ($product->image)
                                    <img src="{{ asset('storage/' . $product->image) }}"
                                        class="w-20 h-20 object-cover rounded-lg mb-2">
                                @endif
                                <input type="file" name="image" class="w-full text-xs">
                            </div>
                            <div class="flex items-center">
                                <input type="checkbox" name="is_active" value="1"
                                    {{ $product->is_active ? 'checked' : '' }} class="w-4 h-4 text-blue-600 rounded">
                                <label class="ml-2 text-sm text-gray-700">Active</label>
                            </div>
                        </div>
                    </div>
                    <button type="submit"
                        class="w-full py-3 bg-blue-600 text-white font-bold rounded-xl hover:bg-blue-700 transition shadow-lg shadow-blue-200">
                        Update Changes
                    </button>
                </div>
            </div>
        </form>
    </div>
@endsection
