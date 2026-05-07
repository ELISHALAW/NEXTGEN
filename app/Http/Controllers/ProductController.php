<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    // List all products in the admin panel
    public function index()
    {
        $products = Product::latest()->get();
        return view('admin.products.index', compact('products'));
    }

    // Show the form to create a product
    public function create()
    {
        return view('admin.products.create');
    }

    // Store the new product in the database
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // Auto-generate slug from name
        $validated['slug'] = Str::slug($request->name);

        // Handle image upload if present
        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('products', 'public');
        }

        Product::create($validated);

        return redirect()->route('admin.products.index')->with('success', 'Product created successfully!');
    }

    // Show the form to edit a specific product
    public function edit(Product $product)
    {
        return view('admin.products.edit', compact('product'));
    }

    // Update the product in the database
    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // Update slug only if name changed
        if ($product->name !== $request->name) {
            $validated['slug'] = \Illuminate\Support\Str::slug($request->name);
        }

        // Handle new image upload
        if ($request->hasFile('image')) {
            // Optional: Delete old image from storage here
            $validated['image'] = $request->file('image')->store('products', 'public');
        }

        $validated['is_active'] = $request->has('is_active');

        $product->update($validated);

        return redirect()->route('admin.products.index')->with('success', 'Product updated successfully!');
    }

    public function show($id)
    {
        // 1. Fetch the product from the database
        $product = Product::findOrFail($id);

        // 2. Pass it to your blade view (make sure the path matches your file)
        return view('products.show', compact('product'));
    }

    public function destroy(Product $product)
    {
        // Optional: Delete image from storage before deleting record
        if ($product->image) {
            \Illuminate\Support\Facades\Storage::disk('public')->delete($product->image);
        }

        $product->delete();

        return redirect()->route('admin.products.index')->with('success', 'Product deleted.');
    }

    public function addToCart(Request $request)
    {
        // For now, we will just validate and redirect back with a message
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'size' => 'required',
            'color' => 'required',
            'quantity' => 'required|integer|min:1',
        ]);

        // Logic to save to session or database cart table goes here

        return redirect()->back()->with('success', 'Product added to cart!');
    }
}
