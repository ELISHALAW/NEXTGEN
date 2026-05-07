<?php

namespace App\Http\Controllers;

use App\Models\Order; // Use the singular 'Order' model
use App\Models\OrderItem;
use App\Models\Orders;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str; // Ensure correct Str import

class AddToCartController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            new Middleware('auth', except: ['index']),
        ];
    }

    public function index()
    {
        $products = Product::all();
        return view('shop', compact('products'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'product_id' => 'required|exists:products,id',
            'size'       => 'required|string',
            'color'      => 'required|string',
            'quantity'   => 'required|integer|min:1',
        ]);

        $product = Product::findOrFail($validated['product_id']);
        $cart = session()->get('cart', []);
        $cartKey = "{$product->id}_{$validated['size']}_{$validated['color']}";

        if (isset($cart[$cartKey])) {
            $cart[$cartKey]['quantity'] += $validated['quantity'];
        } else {
            $cart[$cartKey] = [
                "id"       => $product->id,
                "name"     => $product->name,
                "quantity" => $validated['quantity'],
                "price"    => $product->price,
                "image"    => $product->image,
                "size"     => $validated['size'],
                "color"    => $validated['color']
            ];
        }

        session()->put('cart', $cart);
        return redirect()->back()->with('success', 'Item added to bag!');
    }

    public function viewCart()
    {
        $cart = session()->get('cart', []);
        return view('cart', compact('cart'));
    }

    public function remove(Request $request)
    {
        if ($request->id) {
            $cart = session()->get('cart');
            if (isset($cart[$request->id])) {
                unset($cart[$request->id]);
                session()->put('cart', $cart);
            }
        }
        return redirect()->back()->with('success', 'Item removed!');
    }

    public function checkout(Request $request)
    {
        $cart = session()->get('cart');

        if (!$cart) {
            return redirect()->back()->with('error', 'Your bag is empty!');
        }

        $total = collect($cart)->sum(fn($item) => $item['price'] * $item['quantity']);

        DB::transaction(function () use ($cart, $total) {
            // MODIFICATION: Set payment_status to 'paid'
            $order = Orders::create([
                'user_id' => auth()->id(),
                'order_number' => 'ORD-' . strtoupper(Str::random(10)),
                'total_amount' => $total,
                'status' => 'pending',
                'payment_status' => 'paid', // Changed from 'unpaid' to 'paid'
            ]);

            foreach ($cart as $details) {
                OrderItem::create([
                    'order_id'   => $order->id,
                    'product_id' => $details['id'],
                    'quantity'   => $details['quantity'],
                    'price'      => $details['price'],
                    'size'       => $details['size'],
                    'color'      => $details['color'],
                ]);
            }
        });

        session()->forget('cart');

        // Ensure this route name matches your web.php (lowercase 'shop' is standard)
        return redirect()->route('Shop.index')->with('success', 'Order placed and paid successfully!');
    }
}
