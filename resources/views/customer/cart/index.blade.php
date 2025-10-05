<x-app-layout>
    <div class="min-h-screen bg-gradient-to-br from-purple-50 via-white to-blue-50">
        <!-- Enhanced Header -->
        <div class="bg-gradient-to-r from-purple-600 via-indigo-600 to-blue-600 text-white">
            <div class="max-w-7xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
                <div class="text-center">
                    <h1 class="text-3xl md:text-4xl font-bold mb-2 animate__animated animate__fadeInDown">
                        🛒 Shopping Cart
                    </h1>
                    <p class="text-lg text-white/90 animate__animated animate__fadeInUp">
                        Review your items and proceed to checkout
                    </p>
                </div>
            </div>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <!-- Alert Messages -->
            @if (session('success'))
                <div class="mb-6 bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded-r-xl shadow-lg animate__animated animate__fadeInDown">
                    <div class="flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                        </svg>
                        {{ session('success') }}
                    </div>
                </div>
            @endif

            @if (session('error'))
                <div class="mb-6 bg-red-100 border-l-4 border-red-500 text-red-700 p-4 rounded-r-xl shadow-lg animate__animated animate__fadeInDown">
                    <div class="flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path>
                        </svg>
                        {{ session('error') }}
                    </div>
                </div>
            @endif

            @if($cartItems->count() > 0)
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                    <!-- Cart Items -->
                    <div class="lg:col-span-2 space-y-4">
                        <div class="bg-white rounded-2xl shadow-lg p-6 animate__animated animate__fadeInLeft">
                            <h2 class="text-2xl font-bold text-gray-900 mb-6 flex items-center">
                                📦 Your Items 
                                <span class="ml-2 text-sm bg-purple-100 text-purple-800 px-3 py-1 rounded-full">
                                    {{ $cartItems->count() }} {{ Str::plural('item', $cartItems->count()) }}
                                </span>
                            </h2>
                            
                            <div class="space-y-4">
                                @foreach($cartItems as $index => $item)
                                    <div class="flex items-center space-x-4 p-4 border border-gray-200 rounded-xl hover:border-purple-300 hover:shadow-md transition-all duration-300 group animate__animated animate__fadeInUp"
                                         style="animation-delay: {{ $index * 0.1 }}s;">
                                        <!-- Product Image -->
                                        <div class="flex-shrink-0 w-20 h-20 rounded-lg overflow-hidden bg-gray-100 group-hover:scale-105 transition-transform duration-300">
                                            @if($item->product->image)
                                                <img src="{{ Storage::url($item->product->image) }}" 
                                                     alt="{{ $item->product->name }}" 
                                                     class="w-full h-full object-cover">
                                            @else
                                                <div class="w-full h-full bg-gradient-to-br from-purple-400 to-pink-400 flex items-center justify-center">
                                                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                                                    </svg>
                                                </div>
                                            @endif
                                        </div>

                                        <!-- Product Details -->
                                        <div class="flex-1 min-w-0">
                                            <h3 class="text-lg font-semibold text-gray-900 group-hover:text-purple-600 transition-colors">
                                                {{ $item->product->name }}
                                            </h3>
                                            <p class="text-sm text-gray-600 mt-1">
                                                {{ Str::limit($item->product->description, 60) }}
                                            </p>
                                            <div class="flex items-center mt-2 space-x-4">
                                                <span class="text-lg font-bold text-purple-600">
                                                    ${{ number_format($item->product->price, 2) }}
                                                </span>
                                                <span class="text-sm text-gray-500">
                                                    Stock: {{ $item->product->stock }}
                                                </span>
                                            </div>
                                        </div>

                                        <!-- Quantity Controls -->
                                        <div class="flex items-center space-x-3">
                                            <form action="{{ route('customer.cart.update', $item) }}" method="POST" class="flex items-center space-x-2">
                                                @csrf
                                                @method('PATCH')
                                                <label class="text-sm text-gray-600 font-medium">Qty:</label>
                                                <input type="number" name="quantity" value="{{ $item->quantity }}" 
                                                       min="1" max="{{ $item->product->stock }}"
                                                       class="w-16 px-2 py-1 text-center border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition-all">
                                                <button type="submit" 
                                                        class="bg-blue-500 text-white px-3 py-1 rounded-lg hover:bg-blue-600 transition-colors text-sm font-medium transform hover:scale-105">
                                                    Update
                                                </button>
                                            </form>
                                        </div>

                                        <!-- Subtotal and Remove -->
                                        <div class="text-right">
                                            <div class="text-lg font-bold text-gray-900 mb-2">
                                                ${{ number_format($item->subtotal(), 2) }}
                                            </div>
                                            <form action="{{ route('customer.cart.remove', $item) }}" method="POST" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" 
                                                        onclick="return confirm('Remove this item from cart?')"
                                                        class="text-red-500 hover:text-red-700 p-2 rounded-lg hover:bg-red-50 transition-all transform hover:scale-110">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                                    </svg>
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            <!-- Clear Cart Button -->
                            <div class="mt-6 pt-6 border-t border-gray-200">
                                <form action="{{ route('customer.cart.clear') }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                            onclick="return confirm('Are you sure you want to clear your entire cart?')"
                                            class="text-red-600 hover:text-red-800 text-sm font-medium border border-red-300 px-4 py-2 rounded-lg hover:bg-red-50 transition-all">
                                        🗑️ Clear Cart
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- Order Summary - Sticky on desktop -->
                    <div class="lg:col-span-1">
                        <div class="bg-white rounded-2xl shadow-lg p-6 sticky top-6 animate__animated animate__fadeInRight">
                            <h2 class="text-2xl font-bold text-gray-900 mb-6 flex items-center">
                                💰 Order Summary
                            </h2>
                            
                            <div class="space-y-4">
                                <!-- Subtotal Breakdown -->
                                @foreach($cartItems as $item)
                                    <div class="flex justify-between text-sm">
                                        <span class="text-gray-600">{{ $item->product->name }} x{{ $item->quantity }}</span>
                                        <span class="text-gray-900 font-medium">${{ number_format($item->subtotal(), 2) }}</span>
                                    </div>
                                @endforeach
                                
                                <div class="border-t border-gray-200 pt-4">
                                    <div class="flex justify-between text-base font-medium">
                                        <span class="text-gray-900">Subtotal</span>
                                        <span class="text-gray-900">${{ number_format($total, 2) }}</span>
                                    </div>
                                    <div class="flex justify-between text-sm text-gray-600 mt-2">
                                        <span>Shipping</span>
                                        <span>Free</span>
                                    </div>
                                    <div class="flex justify-between text-sm text-gray-600 mt-1">
                                        <span>Tax</span>
                                        <span>Calculated at checkout</span>
                                    </div>
                                </div>
                                
                                <div class="border-t border-gray-200 pt-4">
                                    <div class="flex justify-between text-xl font-bold text-purple-600">
                                        <span>Total</span>
                                        <span>${{ number_format($total, 2) }}</span>
                                    </div>
                                </div>
                            </div>

                            <!-- Checkout Button -->
                            <div class="mt-6">
                                <a href="{{ route('customer.orders.checkout') }}" 
                                   class="w-full bg-gradient-to-r from-purple-600 to-indigo-600 text-white py-4 px-6 rounded-xl hover:from-purple-700 hover:to-indigo-700 transition-all duration-300 transform hover:scale-105 shadow-lg hover:shadow-xl font-semibold text-center block">
                                    🚀 Proceed to Checkout
                                </a>
                            </div>

                            <!-- Security Badges -->
                            <div class="mt-6 pt-6 border-t border-gray-200">
                                <div class="flex items-center justify-center space-x-4 text-sm text-gray-500">
                                    <div class="flex items-center">
                                        <svg class="w-4 h-4 mr-1 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd"></path>
                                        </svg>
                                        Secure
                                    </div>
                                    <div class="flex items-center">
                                        <svg class="w-4 h-4 mr-1 text-blue-500" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                        </svg>
                                        Verified
                                    </div>
                                </div>
                            </div>

                            <!-- Continue Shopping -->
                            <div class="mt-4">
                                <a href="{{ route('customer.products.index') }}" 
                                   class="w-full bg-gray-100 text-gray-700 py-3 px-6 rounded-xl hover:bg-gray-200 transition-all duration-300 font-medium text-center block">
                                    ← Continue Shopping
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @else
                <!-- Empty Cart State -->
                <div class="text-center py-16 animate__animated animate__fadeIn">
                    <div class="max-w-md mx-auto">
                        <div class="mb-8">
                            <div class="w-32 h-32 mx-auto bg-gradient-to-br from-purple-100 to-blue-100 rounded-full flex items-center justify-center">
                                <svg class="w-16 h-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17M17 13v6a2 2 0 01-2 2H9a2 2 0 01-2-2v-6m8 0V9a2 2 0 00-2-2H9a2 2 0 00-2 2v4.01"></path>
                                </svg>
                            </div>
                        </div>
                        <h2 class="text-3xl font-bold text-gray-900 mb-4">Your Cart is Empty</h2>
                        <p class="text-lg text-gray-600 mb-8">
                            Looks like you haven't added any items to your cart yet. 
                            Start shopping to fill it up with amazing products!
                        </p>
                        <a href="{{ route('customer.products.index') }}" 
                           class="inline-flex items-center px-8 py-4 bg-gradient-to-r from-purple-600 to-indigo-600 text-white rounded-xl hover:from-purple-700 hover:to-indigo-700 transition-all duration-300 transform hover:scale-105 shadow-lg hover:shadow-xl font-semibold">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                            </svg>
                            Start Shopping Now
                        </a>
                        
                        <!-- Suggested Products -->
                        <div class="mt-12">
                            <h3 class="text-lg font-semibold text-gray-900 mb-4">🌟 You might like</h3>
                            <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                                <div class="bg-gradient-to-br from-purple-100 to-pink-100 p-4 rounded-xl text-center hover:shadow-md transition-all">
                                    <div class="text-2xl mb-2">🎧</div>
                                    <p class="text-sm font-medium">Electronics</p>
                                </div>
                                <div class="bg-gradient-to-br from-blue-100 to-indigo-100 p-4 rounded-xl text-center hover:shadow-md transition-all">
                                    <div class="text-2xl mb-2">👕</div>
                                    <p class="text-sm font-medium">Fashion</p>
                                </div>
                                <div class="bg-gradient-to-br from-green-100 to-teal-100 p-4 rounded-xl text-center hover:shadow-md transition-all">
                                    <div class="text-2xl mb-2">🏠</div>
                                    <p class="text-sm font-medium">Home & Garden</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>

    <!-- Add animate.css for better animations -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    
    <style>
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translate3d(0, 40px, 0);
            }
            to {
                opacity: 1;
                transform: translate3d(0, 0, 0);
            }
        }
        
        .animate__fadeInUp {
            animation-name: fadeInUp;
            animation-duration: 0.6s;
            animation-fill-mode: both;
        }

        /* Quantity input animation */
        input[type="number"]:focus {
            transform: scale(1.05);
        }

        /* Smooth transitions for all elements */
        * {
            transition: all 0.2s ease;
        }

        /* Card hover effects */
        .group:hover {
            transform: translateY(-2px);
        }
    </style>
</x-app-layout>