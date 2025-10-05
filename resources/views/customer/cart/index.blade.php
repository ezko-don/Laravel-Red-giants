<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Shopping Cart') }}
            </h2>
            <a href="{{ route('customer.products.index') }}" class="text-blue-600 hover:text-blue-800">
                Continue Shopping
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            @if (session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                    {{ session('error') }}
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    @if($cartItems->isEmpty())
                        <div class="text-center py-12">
                            <div class="text-gray-400 text-6xl mb-4">🛒</div>
                            <h3 class="text-lg font-medium text-gray-900 mb-2">Your cart is empty</h3>
                            <p class="text-gray-600 mb-6">Add some products to get started!</p>
                            <a href="{{ route('customer.products.index') }}" 
                               class="inline-flex items-center px-6 py-3 bg-blue-500 text-white rounded-lg hover:bg-blue-600">
                                Shop Now
                            </a>
                        </div>
                    @else
                        <div class="space-y-4">
                            @foreach($cartItems as $item)
                                <div class="flex items-center space-x-4 p-4 border border-gray-200 rounded-lg">
                                    @if($item->product->image)
                                        <img src="{{ Storage::url($item->product->image) }}" 
                                             alt="{{ $item->product->name }}" 
                                             class="w-16 h-16 object-cover rounded">
                                    @else
                                        <div class="w-16 h-16 bg-gray-200 rounded flex items-center justify-center">
                                            <span class="text-gray-400 text-xs">No Image</span>
                                        </div>
                                    @endif

                                    <div class="flex-1">
                                        <h4 class="font-medium text-gray-900">{{ $item->product->name }}</h4>
                                        <p class="text-sm text-gray-600">${{ number_format($item->product->price, 2) }} each</p>
                                    </div>

                                    <form method="POST" action="{{ route('customer.cart.update', $item) }}" class="flex items-center space-x-2">
                                        @csrf
                                        @method('PATCH')
                                        <select name="quantity" onchange="this.form.submit()" 
                                                class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded text-sm">
                                            @for ($i = 1; $i <= min(10, $item->product->stock); $i++)
                                                <option value="{{ $i }}" {{ $item->quantity == $i ? 'selected' : '' }}>
                                                    {{ $i }}
                                                </option>
                                            @endfor
                                        </select>
                                    </form>

                                    <div class="text-right">
                                        <p class="font-medium text-gray-900">
                                            ${{ number_format($item->quantity * $item->product->price, 2) }}
                                        </p>
                                        <form method="POST" action="{{ route('customer.cart.remove', $item) }}" class="mt-1">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-800 text-sm">
                                                Remove
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            @endforeach

                            <!-- Cart Summary -->
                            <div class="border-t pt-4 mt-6">
                                <div class="flex justify-between items-center mb-4">
                                    <span class="text-lg font-medium text-gray-900">Total:</span>
                                    <span class="text-2xl font-bold text-green-600">${{ number_format($total, 2) }}</span>
                                </div>

                                <div class="flex justify-between items-center space-x-4">
                                    <form method="POST" action="{{ route('customer.cart.clear') }}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                onclick="return confirm('Are you sure you want to clear your cart?')"
                                                class="text-red-600 hover:text-red-800">
                                            Clear Cart
                                        </button>
                                    </form>

                                    <a href="{{ route('customer.orders.checkout') }}" 
                                       class="bg-green-500 text-white px-8 py-3 rounded-lg hover:bg-green-600 font-medium">
                                        Proceed to Checkout
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
