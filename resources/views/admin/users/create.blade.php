@extends('layouts.admin')

@section('content')
    <div class="max-w-4xl mx-auto">
        <div class="mb-6">
            <h1 class="text-2xl font-bold text-slate-800">Add New Product</h1>
            <p class="text-slate-500">Inventory Management for Store</p>
        </div>

        <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <div class="lg:col-span-2 space-y-6">
                    <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-200">
                        <div class="grid gap-4">
                            <div>
                                <label class="block text-sm font-semibold mb-1">Product Name</label>
                                <input type="text" name="name" id="name"
                                    class="w-full px-4 py-2 border rounded-xl" required>
                            </div>
                            <div>
                                <label class="block text-sm font-semibold mb-1">Slug (URL)</label>
                                <input type="text" name="slug" id="slug"
                                    class="w-full px-4 py-2 border rounded-xl bg-gray-50" readonly required>
                            </div>
                            <div>
                                <label class="block text-sm font-semibold mb-1">Description</label>
                                <textarea name="description" rows="4" class="w-full px-4 py-2 border rounded-xl"></textarea>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="space-y-6">
                    <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-200">
                        <div class="grid gap-4">
                            <div>
                                <label class="block text-sm font-semibold mb-1">Price ($)</label>
                                <input type="number" step="0.01" name="price"
                                    class="w-full px-4 py-2 border rounded-xl" required>
                            </div>
                            <div>
                                <label class="block text-sm font-semibold mb-1">Stock Quantity</label>
                                <input type="number" name="stock" class="w-full px-4 py-2 border rounded-xl" required>
                            </div>
                            <div>
                                <label class="block text-sm font-semibold mb-1">Product Image</label>
                                <input type="file" name="image" class="w-full text-sm">
                            </div>
                            <div class="flex items-center">
                                <input type="checkbox" name="is_active" value="1" checked
                                    class="w-4 h-4 text-blue-600 rounded">
                                <label class="ml-2 text-sm text-gray-700">Set as Active</label>
                            </div>
                        </div>
                    </div>
                    <button type="submit"
                        class="w-full py-3 bg-blue-600 text-white font-bold rounded-xl hover:bg-blue-700 transition">
                        Save Product
                    </button>
                </div>
            </div>
        </form>
    </div>

    <script>
        // Auto-generate slug from name
        document.getElementById('name').addEventListener('input', function() {
            let slug = this.value.toLowerCase().replace(/[^\w ]+/g, '').replace(/ +/g, '-');
            document.getElementById('slug').value = slug;
        });
    </script>
@endsection
