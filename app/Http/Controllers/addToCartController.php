<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class addToCartController extends Controller implements HasMiddleware
{
    /**
     * Get the middleware that should be assigned to the controller.
     */
    public static function middleware(): array
    {
        return [
            new Middleware('auth', except: ['index']),
        ];
    }

    /**
     * Display the shop page (Public)
     */
    public function index()
    {
        return view('shop');
    }

    /**
     * Store a newly created resource in storage (Protected)
     */
    public function store(Request $request)
    {
        // User is guaranteed to be authenticated here

        return redirect()->back()->with('success', 'Item added to cart!');
    }
}
