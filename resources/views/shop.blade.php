@extends('layouts.app')

@section('title', 'Shop - Gimas Studio')

@section('content')
    <main class="flex-1 flex flex-col items-center justify-start w-full px-6 py-12 bg-[#1a1a1a]">
        <div class="w-full max-w-6xl">

            <h1 class="text-4xl font-extrabold mb-12 flex items-center justify-center gap-4 text-center text-white">
                <i class="fa-solid fa-bag-shopping text-amber-500"></i>
                Our Collection
            </h1>

            {{-- START LOOP --}}
            @foreach ($products as $product)
                <div class="bg-[#252525] p-10 rounded-3xl shadow-2xl border border-white/5 mx-auto mb-16">
                    <div class="flex flex-col lg:flex-row gap-12">

                        <div class="lg:w-[520px] flex-shrink-0">
                            <div
                                class="h-full min-h-[620px] bg-[#1a1a1a] rounded-3xl overflow-hidden shadow-inner border border-white/5">
                                @if ($product->image)
                                    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}"
                                        class="w-full h-full object-cover object-center hover:scale-110 transition-transform duration-700 opacity-90">
                                @else
                                    <div
                                        class="w-full h-full flex items-center justify-center bg-neutral-800 text-gray-500">
                                        <i class="fa-solid fa-image text-6xl"></i>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="flex-1 flex flex-col">
                            <div class="flex justify-between items-start">
                                <div>
                                    <h3 class="font-extrabold text-6xl uppercase tracking-tighter text-white">
                                        {{ $product->brand ?? 'Premium' }}
                                    </h3>
                                    <h4 class="font-extrabold text-5xl uppercase tracking-tight text-gray-400 -mt-2">
                                        {{ $product->name }}
                                    </h4>
                                </div>
                                <div class="text-right">
                                    <p class="font-black text-5xl text-amber-500">${{ number_format($product->price, 2) }}
                                    </p>
                                </div>
                            </div>

                            <div class="mt-8">
                                <p class="text-sm font-bold text-gray-500 uppercase tracking-widest mb-3">Select Size</p>
                                <div class="flex gap-3">
                                    @foreach (['M', 'L', 'XL'] as $size)
                                        <button
                                            onclick="updateSelection('size', '{{ $size }}', this, {{ $product->id }})"
                                            class="size-btn-{{ $product->id }} {{ $size == 'M' ? 'active bg-amber-500 text-black border-amber-500' : 'text-white border-white/10' }} px-8 py-3 border-2 rounded-2xl text-lg font-bold transition-all">
                                            {{ $size }}
                                        </button>
                                    @endforeach
                                </div>
                            </div>

                            <div class="mt-8">
                                <p class="text-sm font-bold text-gray-500 uppercase tracking-widest mb-3">Select Color</p>
                                <div class="flex gap-3">
                                    <button onclick="updateSelection('color', 'Natural', this, {{ $product->id }})"
                                        class="color-btn-{{ $product->id }} active px-6 py-3 border-2 border-amber-500 bg-amber-500 text-black rounded-2xl text-lg font-bold transition-all">Natural</button>
                                    <button onclick="updateSelection('color', 'Black', this, {{ $product->id }})"
                                        class="color-btn-{{ $product->id }} px-6 py-3 border-2 border-white/10 text-white rounded-2xl text-lg font-bold hover:border-amber-500 transition-all">Black</button>
                                </div>
                            </div>

                            <p class="text-gray-500 mt-6 text-lg">
                                Size: <span id="selected-size-{{ $product->id }}"
                                    class="text-amber-500 font-bold">M</span> |
                                Color: <span id="selected-color-{{ $product->id }}"
                                    class="text-amber-500 font-bold">Natural</span>
                            </p>

                            <div class="mt-auto pt-12 flex flex-col sm:flex-row justify-between items-end gap-8">
                                <div>
                                    <label
                                        class="block text-xs font-bold text-gray-500 uppercase tracking-widest mb-3">Quantity</label>
                                    <div
                                        class="flex items-center border-2 border-white/5 rounded-2xl bg-[#1a1a1a] overflow-hidden">
                                        <button onclick="changeQty(-1, {{ $product->id }})"
                                            class="px-8 py-4 hover:bg-white/5 transition-colors text-white font-bold text-2xl">-</button>
                                        <span id="qty-display-{{ $product->id }}"
                                            class="px-12 py-4 font-black text-white bg-[#252525] border-x-2 border-white/5 text-2xl">1</span>
                                        <button onclick="changeQty(1, {{ $product->id }})"
                                            class="px-8 py-4 hover:bg-white/5 transition-colors text-white font-bold text-2xl">+</button>
                                    </div>
                                </div>

                                <div>
                                    <span
                                        class="text-base font-bold text-emerald-400 bg-emerald-500/10 border border-emerald-500/20 px-8 py-4 rounded-full uppercase tracking-wider">
                                        <i class="fa-solid fa-circle-check mr-2"></i> In Stock
                                    </span>
                                </div>
                            </div>

                            <form action="{{ route('cart.add') }}" method="POST" class="mt-10">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                <input type="hidden" name="size" id="input-size-{{ $product->id }}" value="M">
                                <input type="hidden" name="color" id="input-color-{{ $product->id }}" value="Natural">
                                <input type="hidden" name="quantity" id="input-qty-{{ $product->id }}" value="1">

                                <button type="submit"
                                    class="w-full bg-white hover:bg-amber-500 text-black hover:text-white font-black text-xl py-6 rounded-2xl transition-all active:scale-95 flex items-center justify-center gap-3 shadow-xl">
                                    <i class="fa-solid fa-cart-plus"></i>
                                    ADD TO CART
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
            {{-- END LOOP --}}

        </div>
    </main>

    <script>
        // Updated to handle specific product IDs so clicking one card doesn't change others
        function updateSelection(type, value, element, productId) {
            document.getElementById('selected-' + type + '-' + productId).innerText = value;
            document.getElementById('input-' + type + '-' + productId).value = value;

            const btnClass = type === 'size' ? '.size-btn-' + productId : '.color-btn-' + productId;
            document.querySelectorAll(btnClass).forEach(btn => {
                btn.classList.remove('active', 'bg-amber-500', 'text-black', 'border-amber-500');
                btn.classList.add('text-white', 'border-white/10');
            });

            element.classList.add('active', 'bg-amber-500', 'text-black', 'border-amber-500');
            element.classList.remove('text-white', 'border-white/10');
        }

        function changeQty(amt, productId) {
            const display = document.getElementById('qty-display-' + productId);
            const input = document.getElementById('input-qty-' + productId);
            let current = parseInt(display.innerText);

            if (current + amt >= 1) {
                display.innerText = current + amt;
                input.value = current + amt;
            }
        }
    </script>
@endsection
