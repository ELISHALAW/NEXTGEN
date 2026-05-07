@extends('layouts.admin')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="mb-6 flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold text-slate-800">Add New Product</h1>
            <p class="text-slate-500">Create a new item for your inventory.</p>
        </div>
        <a href="{{ route('admin.products.index') }}" class="text-slate-600 hover:text-slate-800 flex items-center">
            <i class="fas fa-arrow-left mr-2"></i> Back to List
        </a>
    </div>

    <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <div class="lg:col-span-2 space-y-6">
                <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-sm">
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-1">Product Name</label>
                            <input type="text" name="name" id="product_name" value="{{ old('name') }}" 
                                class="w-full px-4 py-2 rounded-xl border border-slate-300 focus:ring-2 focus:ring-blue-500 outline-none" required>
                        </div>
                        
                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-1">URL Slug</label>
                            <input type="text" name="slug" id="product_slug" value="{{ old('slug') }}" 
                                class="w-full px-4 py-2 rounded-xl border border-slate-300 bg-slate-50 outline-none" readonly required>
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-1">Description</label>
                            <textarea name="description" rows="5" 
                                class="w-full px-4 py-2 rounded-xl border border-slate-300 focus:ring-2 focus:ring-blue-500 outline-none">{{ old('description') }}</textarea>
                        </div>
                    </div>
                </div>
            </div>

            <div class="space-y-6">
                <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-sm">
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-1">Price ($)</label>
                            <input type="number" step="0.01" name="price" value="{{ old('price') }}" 
                                class="w-full px-4 py-2 rounded-xl border border-slate-300 focus:ring-2 focus:ring-blue-500 outline-none" required>
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-1">Stock Quantity</label>
                            <input type="number" name="stock" value="{{ old('stock', 0) }}" 
                                class="w-full px-4 py-2 rounded-xl border border-slate-300 focus:ring-2 focus:ring-blue-500 outline-none" required>
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-1">Product Image</label>
                            <input type="file" name="image" 
                                class="w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                        </div>

                        <div class="flex items-center pt-2">
                            <input type="checkbox" name="is_active" value="1" checked class="w-4 h-4 text-blue-600 border-slate-300 rounded focus:ring-blue-500">
                            <label class="ml-2 text-sm font-medium text-slate-700">Active and Visible</label>
                        </div>
                    </div>
                </div>

                <button type="submit" class="w-full py-3 bg-blue-600 text-white font-bold rounded-xl shadow-lg shadow-blue-200 hover:bg-blue-700 transition duration-200">
                    Publish Product
                </button>
            </div>
        </div>
    </form>
</div>

<script>
    // Simple script to generate slug automatically
    document.getElementById('product_name').addEventListener('input', function() {
        let name = this.value;
        let slug = name.toLowerCase().replace(/[^\w ]+/g, '').replace(/ +/g, '-');
        document.getElementById('product_slug').value = slug;
    });
</script>
@endsection