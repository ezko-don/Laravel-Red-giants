<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <div>
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    {{ __('Shopping Cart') }}
                </h2>
                <p class="text-gray-600 text-sm mt-1">Review your items before checkout</p>
            </div>
            <a href="{{ route('customer.products.index') }}" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 transition-colors duration-200 flex items-center space-x-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16l-4-4m0 0l4-4m-4 4h18"></path>
                </svg>
                <span>Continue Shopping</span>
            </a>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            @if (session('success'))
                <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded-r-lg shadow-sm animate-pulse">
                    <div class="flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                        </svg>
                        {{ session('success') }}
                    </div>
                </div>
            @endif

            @if (session('error'))
                <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded-r-lg shadow-sm">
                    <div class="flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path>
                        </svg>
                        {{ session('error') }}
                    </div>
                </div>
            @endif

            @if($cartItems->isEmpty())
                <div class="bg-white rounded-xl shadow-sm text-center py-16">
                    <div class="max-w-md mx-auto">
                        <svg class="mx-auto h-24 w-24 text-gray-300 mb-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                        </svg>
                        <h3 class="text-2xl font-semibold text-gray-900 mb-2">Your cart is empty</h3>
                        <p class="text-gray-600 mb-8">Looks like you haven't added anything to your cart yet. Start shopping to fill it up!</p>
                        <a href="{{ route('customer.products.index') }}" 
                           class="inline-flex items-center px-8 py-3 bg-gradient-to-r from-blue-500 to-blue-600 text-white font-medium rounded-lg hover:from-blue-600 hover:to-blue-700 transition-all duration-200 transform hover:scale-105 shadow-lg">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                            </svg>
                            Start Shopping
                        </a>
                    </div>
                </div>
            @else
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                    <!-- Cart Items -->
                    <div class="lg:col-span-2 space-y-4">
                        @foreach($cartItems as $item)
                            <div class="bg-white rounded-xl shadow-sm hover:shadow-md transition-shadow duration-200 p-6 border border-gray-100">
                                <div class="flex items-start space-x-4">
                                    <div class="flex-shrink-0">
                                        @if($item->product->image)
                                            <img src="{{ Storage::url($item->product->image) }}" 
                                                 alt="{{ $item->product->name }}" 
                                                 class="w-20 h-20 rounded-lg object-cover border border-gray-200">
                                        @else
                                            <div class="w-20 h-20 bg-gradient-to-br from-gray-100 to-gray-200 rounded-lg flex items-center justify-center border border-gray-200">
                                                <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                                </svg>
                                            </div>
                                        @endif
                                    </div>

                                    <div class="flex-1 min-w-0">
                                        <h4 class="text-lg font-semibold text-gray-900 mb-1">{{ $item->product->name }}</h4>
                                        <p class="text-gray-600 text-sm mb-2">{{ Str::limit($item->product->description, 80) }}</p>
                                        <div class="flex items-center space-x-4">
                                            <span class="text-lg font-bold text-green-600">${{ number_format($item->product->price, 2) }}</span>
                                            <span class="text-sm text-gray-500">each</span>
                                        </div>
                                    </div>

                                    <div class="flex flex-col items-end space-y-3">
                                        <!-- Quantity Selector -->
                                        <form method="POST" action="{{ route('customer.cart.update', $item) }}" class="flex items-center">
                                            @csrf
                                            @method('PATCH')
                                            <label class="text-sm text-gray-600 mr-2">Qty:</label>
                                            <select name="quantity" onchange="this.form.submit()" 
                                                    class="bg-white border border-gray-300 rounded-lg px-3 py-1 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                                @for ($i = 1; $i <= min(10, $item->product->stock); $i++)
                                                    <option value="{{ $i }}" {{ $item->quantity == $i ? 'selected' : '' }}>
                                                        {{ $i }}
                                                    </option>
                                                @endfor
                                            </select>
                                        </form>

                                        <!-- Subtotal -->
                                        <div class="text-right">
                                            <p class="text-xl font-bold text-gray-900">
                                                ${{ number_format($item->quantity * $item->product->price, 2) }}
                                            </p>
                                            <p class="text-xs text-gray-500">{{ $item->quantity }} × ${{ number_format($item->product->price, 2) }}</p>
                                        </div>

                                        <!-- Remove Button -->
                                        <form method="POST" action="{{ route('customer.cart.remove', $item) }}">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" 
                                                    onclick="return confirm('Remove this item from cart?')"
                                                    class="text-red-500 hover:text-red-700 text-sm font-medium transition-colors duration-200 flex items-center space-x-1">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                                </svg>
                                                <span>Remove</span>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- Order Summary -->
                    <div class="lg:col-span-1">
                        <div class="bg-white rounded-xl shadow-sm border border-gray-100 sticky top-6">
                            <div class="p-6">
                                <h3 class="text-lg font-semibold text-gray-900 mb-4">Order Summary</h3>
                                
                                <div class="space-y-3 mb-6">
                                    <div class="flex justify-between text-sm">
                                        <span class="text-gray-600">Items ({{ $cartItems->sum('quantity') }})</span>
                                        <span class="text-gray-900">${{ number_format($total, 2) }}</span>
                                    </div>
                                    <div class="flex justify-between text-sm">
                                        <span class="text-gray-600">Shipping</span>
                                        <span class="text-green-600 font-medium">FREE</span>
                                    </div>
                                    <div class="flex justify-between text-sm">
                                        <span class="text-gray-600">Tax</span>
                                        <span class="text-gray-900">$0.00</span>
                                    </div>
                                    <div class="border-t pt-3">
                                        <div class="flex justify-between">
                                            <span class="text-lg font-semibold text-gray-900">Total</span>
                                            <span class="text-2xl font-bold text-green-600">${{ number_format($total, 2) }}</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="space-y-3">
                                    <a href="{{ route('customer.orders.checkout') }}" 
                                       class="block w-full bg-gradient-to-r from-green-500 to-green-600 text-white text-center py-3 px-6 rounded-lg hover:from-green-600 hover:to-green-700 transition-all duration-200 transform hover:scale-105 font-semibold shadow-lg">
                                        Proceed to Checkout
                                    </a>
                                    
                                    <form method="POST" action="{{ route('customer.cart.clear') }}" class="w-full">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                onclick="return confirm('Are you sure you want to clear your entire cart?')"
                                                class="w-full text-red-600 hover:text-red-800 py-2 text-sm font-medium transition-colors duration-200">
                                            Clear Entire Cart
                                        </button>
                                    </form>
                                </div>

                                <!-- Security Badge -->
                                <div class="mt-6 pt-6 border-t border-gray-100">
                                    <div class="flex items-center justify-center space-x-2 text-sm text-gray-500">
                                        <svg class="w-4 h-4 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                                        </svg>
                                        <span>Secure Checkout</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Continue Shopping -->
                        <div class="mt-6 bg-blue-50 rounded-xl p-6 border border-blue-100">
                            <h4 class="font-semibold text-blue-900 mb-2">Need something else?</h4>
                            <p class="text-sm text-blue-700 mb-4">Continue browsing our collection of amazing products.</p>
                            <a href="{{ route('customer.products.index') }}" 
                               class="inline-flex items-center text-blue-600 hover:text-blue-800 text-sm font-medium">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16l-4-4m0 0l4-4m-4 4h18"></path>
                                </svg>
                                Continue Shopping
                            </a>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
