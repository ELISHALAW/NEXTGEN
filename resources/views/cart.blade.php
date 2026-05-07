@extends('layouts.app')

@section('title', 'Your Shopping Bag')

@section('content')
    <div class="min-h-screen bg-[#1a1a1a] py-12 px-6">
        <div class="max-w-4xl mx-auto">
            <h1 class="text-4xl font-black text-white mb-8 flex items-center gap-4">
                <i class="fa-solid fa-bag-shopping text-amber-500"></i> Your Bag
            </h1>

            @if (session('cart') && count(session('cart')) > 0)
                <div class="bg-[#252525] rounded-3xl p-8 border border-white/5 shadow-2xl">
                    @foreach (session('cart') as $cartKey => $details)
                        <div
                            class="flex flex-col sm:flex-row items-center justify-between border-b border-white/5 py-6 last:border-0 gap-6">
                            <div class="flex items-center gap-6 w-full">
                                <div class="h-24 w-20 bg-[#1a1a1a] rounded-xl overflow-hidden flex-shrink-0">
                                    <img src="{{ asset('storage/' . $details['image']) }}" class="w-full h-full object-cover">
                                </div>
                                <div class="flex-1">
                                    <h3 class="text-white font-bold text-xl uppercase">{{ $details['name'] }}</h3>
                                    <p class="text-gray-400 text-sm">
                                        Size: <span class="text-amber-500">{{ $details['size'] }}</span> |
                                        Color: <span class="text-amber-500">{{ $details['color'] }}</span>
                                    </p>
                                    <p class="text-white font-black mt-1">
                                        ${{ number_format($details['price'], 2) }} x {{ $details['quantity'] }}
                                    </p>
                                </div>
                                <form action="{{ route('cart.remove') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $cartKey }}">
                                    <button type="submit" class="text-gray-500 hover:text-red-500 transition-colors p-2">
                                        <i class="fa-solid fa-trash-can text-xl"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endforeach

                    <div class="mt-8 pt-8 border-t border-white/5">
                        <div class="flex justify-between items-center mb-10">
                            <p class="text-gray-400 font-bold uppercase tracking-widest">Total Amount</p>
                            <p class="text-4xl font-black text-amber-500">
                                ${{ number_format(collect(session('cart'))->sum(fn($item) => $item['price'] * $item['quantity']), 2) }}
                            </p>
                        </div>

                        <form id="checkoutForm" action="{{ route('checkout.store') }}" method="POST">
                            @csrf
                            <button type="submit"
                                class="w-full bg-white hover:bg-amber-500 text-black font-black text-xl py-6 rounded-2xl transition-all shadow-xl uppercase">
                                Place Order Now
                            </button>
                        </form>
                    </div>
                </div>
            @else
                <div class="text-center py-20 bg-[#252525] rounded-3xl border border-white/5">
                    <p class="text-gray-500 text-xl font-bold mb-6">Your bag is empty.</p>
                    <a href="{{ route('Shop.index') }}"
                        class="bg-amber-500 text-black px-8 py-3 rounded-xl font-black uppercase">Go Shopping</a>
                </div>
            @endif
        </div>
    </div>

    <div id="tngModal" class="hidden fixed inset-0 z-50 flex items-center justify-center bg-black/90 backdrop-blur-sm p-6">
        <div
            class="bg-[#252525] p-8 rounded-3xl border border-amber-500/30 max-w-sm w-full text-center shadow-2xl relative overflow-hidden">

            <button id="closeModal" class="absolute top-4 right-4 text-gray-500 hover:text-white transition-colors">
                <i class="fa-solid fa-xmark text-2xl"></i>
            </button>

            {{-- Step 1: Scan Content --}}
            <div id="scanStep">
                <h2 class="text-2xl font-black text-white mb-2 uppercase tracking-tighter">Scan to Pay</h2>
                <p class="text-gray-400 text-xs mb-4 uppercase tracking-widest">Gimas Studio Official QR</p>

                <div class="bg-white p-4 rounded-2xl mb-6 shadow-inner">
                    <img src="{{ asset('images/tng-qr.jpeg') }}" alt="Touch n Go QR" class="w-full h-auto rounded-lg">
                </div>

                <button id="confirmBtn"
                    class="w-full bg-amber-500 text-black font-black py-4 rounded-xl uppercase hover:scale-105 transition-transform shadow-lg shadow-amber-500/20">
                    I Have Paid
                </button>
            </div>

            {{-- Step 2: Success Content (Hidden by default) --}}
            <div id="successStep" class="hidden py-10">
                <div
                    class="w-20 h-20 bg-green-500 rounded-full flex items-center justify-center mx-auto mb-6 shadow-[0_0_30px_rgba(34,197,94,0.4)]">
                    <i class="fa-solid fa-check text-4xl text-white"></i>
                </div>
                <h2 class="text-3xl font-black text-white mb-2 uppercase italic tracking-tighter">Paid!</h2>
                <p class="text-gray-400 font-bold uppercase text-xs tracking-widest">Redirecting to shop...</p>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('checkoutForm');
            const modal = document.getElementById('tngModal');
            const confirmBtn = document.getElementById('confirmBtn');
            const closeModal = document.getElementById('closeModal');

            const scanStep = document.getElementById('scanStep');
            const successStep = document.getElementById('successStep');

            // 1. Show Modal on Checkout Submit
            form.addEventListener('submit', function(e) {
                e.preventDefault();
                modal.classList.remove('hidden');
            });

            // 2. Close Modal on X Click
            closeModal.addEventListener('click', function() {
                modal.classList.add('hidden');
            });

            // 3. Handle "I Have Paid"
            confirmBtn.addEventListener('click', function() {
                // Hide X button so they can't cancel during the transition
                closeModal.classList.add('hidden');

                // Switch UI to Success
                scanStep.classList.add('hidden');
                successStep.classList.remove('hidden');

                // Wait 2 seconds to show the "Paid!" status, then submit form
                setTimeout(() => {
                    form.submit();
                }, 2000);
            });

            // 4. Close modal if user clicks outside the modal box
            modal.addEventListener('click', function(e) {
                if (e.target === modal) {
                    modal.classList.add('hidden');
                }
            });
        });
    </script>
@endsection
