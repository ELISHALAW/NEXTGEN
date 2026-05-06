@extends('layouts.app')

@section('title', 'Gimas Studio')


@section('content')

    <main class="flex-1 flex flex-col items-center justify-start w-full px-6 py-12">
        <div class="w-full max-w-6xl">

            <h1 class="text-4xl font-extrabold mb-12 flex items-center justify-center gap-4 text-center">
                <i class="fa-solid fa-bag-shopping text-amber-500"></i>
                Your Shopping Bag
            </h1>

            <!-- Item Card -->
            <div class="bg-white p-10 rounded-3xl shadow-sm border border-gray-100 mx-auto">

                <div class="flex flex-col lg:flex-row gap-12">

                    <!-- IMAGE -->
                    <div class="lg:w-[520px] flex-shrink-0">
                        <div class="h-full min-h-[620px] bg-gray-50 rounded-3xl overflow-hidden shadow-inner">
                            <img src="https://images.unsplash.com/photo-1521572163474-6864f9cf17ab?q=80&w=800&h=800&fit=crop"
                                alt="Product"
                                class="w-full h-full object-cover object-center hover:scale-105 transition-transform duration-500">
                        </div>
                    </div>

                    <!-- DETAILS RIGHT -->
                    <div class="flex-1 flex flex-col">
                        <div class="flex justify-between items-start">
                            <div>
                                <h3 class="font-extrabold text-6xl uppercase tracking-tighter text-gray-900">Premium</h3>
                                <h4 class="font-extrabold text-5xl uppercase tracking-tight text-gray-800 -mt-2">Cotton Tee
                                </h4>
                            </div>
                            <div class="text-right">
                                <p class="font-black text-5xl text-amber-600">$45.00</p>
                            </div>
                        </div>

                        <!-- Size -->
                        <div class="mt-8">
                            <p class="text-sm font-bold text-gray-500 uppercase tracking-widest mb-3">Size</p>
                            <div class="flex gap-3">
                                <button onclick="selectSize(this)"
                                    class="option-btn active px-6 py-3 border-2 border-gray-300 rounded-2xl text-lg font-semibold">M</button>
                                <button onclick="selectSize(this)"
                                    class="option-btn px-6 py-3 border-2 border-gray-300 rounded-2xl text-lg font-semibold">L</button>
                            </div>
                        </div>

                        <!-- Color -->
                        <div class="mt-8">
                            <p class="text-sm font-bold text-gray-500 uppercase tracking-widest mb-3">Color</p>
                            <div class="flex gap-3">
                                <button onclick="selectColor(this)"
                                    class="option-btn active px-6 py-3 border-2 border-gray-300 rounded-2xl text-lg font-semibold">Natural</button>
                                <button onclick="selectColor(this)"
                                    class="option-btn px-6 py-3 border-2 border-gray-300 rounded-2xl text-lg font-semibold">Black</button>
                            </div>
                        </div>

                        <p id="selection" class="text-gray-500 mt-6 text-lg">
                            Size: <span class="text-gray-700 font-medium">M</span> |
                            Color: <span class="text-gray-700 font-medium">Natural</span>
                        </p>

                        <div class="mt-auto pt-12 flex flex-col sm:flex-row justify-between items-end gap-8">
                            <div>
                                <label
                                    class="block text-xs font-bold text-gray-400 uppercase tracking-widest mb-3">Quantity</label>
                                <div
                                    class="flex items-center border-2 border-gray-100 rounded-2xl bg-gray-50 overflow-hidden">
                                    <button
                                        class="px-8 py-4 hover:bg-white transition-colors text-gray-500 font-bold text-2xl">-</button>
                                    <span
                                        class="px-12 py-4 font-black text-gray-800 bg-white border-x-2 border-gray-100 text-2xl">1</span>
                                    <button
                                        class="px-8 py-4 hover:bg-white transition-colors text-gray-500 font-bold text-2xl">+</button>
                                </div>
                            </div>

                            <div>
                                <span
                                    class="text-base font-bold text-green-600 bg-green-100 px-8 py-4 rounded-full uppercase tracking-wider">In
                                    Stock</span>
                            </div>
                        </div>

                        <!-- ADD TO CART BUTTON -->
                        <button onclick="addToCart()"
                            class="mt-10 w-full bg-[#1A1A1A] hover:bg-black text-white font-bold text-xl py-6 rounded-2xl transition-all active:scale-95 flex items-center justify-center gap-3">
                            <i class="fa-solid fa-cart-plus"></i>
                            ADD TO CART
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
