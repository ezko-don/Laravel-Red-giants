<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Checkout') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            @if (session('error'))
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                    {{ session('error') }}
                </div>
            @endif

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                <!-- Order Summary -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Order Summary</h3>
                        
                        <div class="space-y-3">
                            @foreach($cartItems as $item)
                                <div class="flex justify-between items-center py-2 border-b border-gray-100">
                                    <div class="flex-1">
                                        <h4 class="font-medium text-gray-900">{{ $item->product->name }}</h4>
                                        <p class="text-sm text-gray-600">
                                            ${{ number_format($item->product->price, 2) }} × {{ $item->quantity }}
                                        </p>
                                    </div>
                                    <span class="font-medium text-gray-900">
                                        ${{ number_format($item->quantity * $item->product->price, 2) }}
                                    </span>
                                </div>
                            @endforeach
                        </div>

                        <div class="border-t pt-4 mt-4">
                            <div class="flex justify-between items-center">
                                <span class="text-lg font-medium text-gray-900">Total:</span>
                                <span class="text-2xl font-bold text-green-600">${{ number_format($total, 2) }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Checkout Form -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Confirm Your Order</h3>
                        
                        <!-- Customer Information -->
                        <div class="mb-6">
                            <h4 class="font-medium text-gray-900 mb-2">Customer Information</h4>
                            <div class="bg-gray-50 p-4 rounded-lg">
                                <p class="text-gray-900 font-medium">{{ auth()->user()->name }}</p>
                                <p class="text-gray-600">{{ auth()->user()->email }}</p>
                            </div>
                        </div>

                        <!-- Order Confirmation -->
                        <div class="mb-6">
                            <h4 class="font-medium text-gray-900 mb-2">Order Details</h4>
                            <div class="bg-blue-50 p-4 rounded-lg">
                                <p class="text-blue-800">
                                    <strong>{{ $cartItems->count() }}</strong> items totaling 
                                    <strong>${{ number_format($total, 2) }}</strong>
                                </p>
                                <p class="text-blue-600 text-sm mt-1">
                                    Your order will be processed immediately and stock will be updated.
                                </p>
                            </div>
                        </div>

                        <!-- Actions -->
                        <div class="flex justify-between items-center space-x-4">
                            <a href="{{ route('customer.cart.index') }}" 
                               class="text-gray-600 hover:text-gray-900">
                                ← Back to Cart
                            </a>

                            <form method="POST" action="{{ route('customer.orders.store') }}">
                                @csrf
                                <button type="submit" 
                                        class="bg-green-500 text-white px-8 py-3 rounded-lg hover:bg-green-600 font-medium">
                                    Place Order
                                </button>
                            </form>
                        </div>

                        <!-- Disclaimer -->
                        <div class="mt-6 p-4 bg-yellow-50 rounded-lg">
                            <p class="text-yellow-800 text-sm">
                                <strong>Note:</strong> This is a demo checkout. No actual payment will be processed.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
