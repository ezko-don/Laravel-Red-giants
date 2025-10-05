<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Order #{{ $order->id }}
            </h2>
            <a href="{{ route('customer.orders.index') }}" class="text-gray-600 hover:text-gray-900">
                ← Back to Orders
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <!-- Order Header -->
                    <div class="border-b border-gray-200 pb-6 mb-6">
                        <div class="flex justify-between items-start">
                            <div>
                                <h3 class="text-2xl font-bold text-gray-900">Order #{{ $order->id }}</h3>
                                <p class="text-gray-600 mt-1">
                                    Placed on {{ $order->created_at->format('M d, Y \a\t g:i A') }}
                                </p>
                            </div>
                            
                            <span class="px-4 py-2 text-sm font-medium rounded-full 
                                {{ $order->status === 'completed' ? 'bg-green-100 text-green-800' : 
                                   ($order->status === 'processing' ? 'bg-blue-100 text-blue-800' : 
                                   ($order->status === 'cancelled' ? 'bg-red-100 text-red-800' : 'bg-yellow-100 text-yellow-800')) }}">
                                {{ ucfirst($order->status) }}
                            </span>
                        </div>
                    </div>

                    <!-- Customer Information -->
                    <div class="mb-6">
                        <h4 class="font-medium text-gray-900 mb-3">Customer Information</h4>
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <p class="text-gray-900 font-medium">{{ $order->user->name }}</p>
                            <p class="text-gray-600">{{ $order->user->email }}</p>
                        </div>
                    </div>

                    <!-- Order Items -->
                    <div class="mb-6">
                        <h4 class="font-medium text-gray-900 mb-3">Order Items</h4>
                        <div class="space-y-3">
                            @foreach($order->orderItems as $item)
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
                                        <h5 class="font-medium text-gray-900">{{ $item->product->name }}</h5>
                                        <p class="text-sm text-gray-600">
                                            ${{ number_format($item->price, 2) }} × {{ $item->quantity }}
                                        </p>
                                    </div>

                                    <div class="text-right">
                                        <p class="font-medium text-gray-900">
                                            ${{ number_format($item->quantity * $item->price, 2) }}
                                        </p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Order Summary -->
                    <div class="border-t pt-6">
                        <div class="space-y-2">
                            <div class="flex justify-between">
                                <span class="text-gray-600">Subtotal ({{ $order->orderItems->sum('quantity') }} items)</span>
                                <span class="text-gray-900">${{ number_format($order->orderItems->sum(function($item) { return $item->quantity * $item->price; }), 2) }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600">Shipping</span>
                                <span class="text-gray-900">Free</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600">Tax</span>
                                <span class="text-gray-900">$0.00</span>
                            </div>
                            <div class="border-t pt-2 flex justify-between">
                                <span class="text-lg font-medium text-gray-900">Total</span>
                                <span class="text-xl font-bold text-green-600">${{ number_format($order->total_amount, 2) }}</span>
                            </div>
                        </div>
                    </div>

                    <!-- Order Actions -->
                    <div class="mt-8 flex justify-center">
                        <p class="text-gray-500 text-sm">
                            Need help with your order? Contact our support team.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
