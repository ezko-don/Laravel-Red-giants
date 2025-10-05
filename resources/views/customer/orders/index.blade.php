<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('My Orders') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            @if (session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    @if($orders->isEmpty())
                        <div class="text-center py-12">
                            <div class="text-gray-400 text-6xl mb-4">📦</div>
                            <h3 class="text-lg font-medium text-gray-900 mb-2">No orders yet</h3>
                            <p class="text-gray-600 mb-6">Start shopping to see your orders here!</p>
                            <a href="{{ route('customer.products.index') }}" 
                               class="inline-flex items-center px-6 py-3 bg-blue-500 text-white rounded-lg hover:bg-blue-600">
                                Browse Products
                            </a>
                        </div>
                    @else
                        <div class="space-y-4">
                            @foreach($orders as $order)
                                <div class="border border-gray-200 rounded-lg p-6">
                                    <div class="flex justify-between items-start mb-4">
                                        <div>
                                            <h3 class="text-lg font-medium text-gray-900">
                                                Order #{{ $order->id }}
                                            </h3>
                                            <p class="text-sm text-gray-600">
                                                Placed on {{ $order->created_at->format('M d, Y \a\t g:i A') }}
                                            </p>
                                        </div>
                                        
                                        <div class="text-right">
                                            <span class="px-3 py-1 text-sm font-medium rounded-full 
                                                {{ $order->status === 'completed' ? 'bg-green-100 text-green-800' : 
                                                   ($order->status === 'processing' ? 'bg-blue-100 text-blue-800' : 
                                                   ($order->status === 'cancelled' ? 'bg-red-100 text-red-800' : 'bg-yellow-100 text-yellow-800')) }}">
                                                {{ ucfirst($order->status) }}
                                            </span>
                                            <p class="text-lg font-bold text-gray-900 mt-1">
                                                ${{ number_format($order->total_amount, 2) }}
                                            </p>
                                        </div>
                                    </div>

                                    <!-- Order Items Preview -->
                                    <div class="mb-4">
                                        <h4 class="font-medium text-gray-900 mb-2">Items ({{ $order->orderItems->count() }})</h4>
                                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-2">
                                            @foreach($order->orderItems->take(3) as $item)
                                                <div class="flex items-center space-x-2 text-sm text-gray-600">
                                                    <span class="w-6 h-6 bg-gray-100 rounded text-center text-xs leading-6">
                                                        {{ $item->quantity }}
                                                    </span>
                                                    <span class="truncate">{{ $item->product->name }}</span>
                                                </div>
                                            @endforeach
                                            @if($order->orderItems->count() > 3)
                                                <div class="text-sm text-gray-500">
                                                    +{{ $order->orderItems->count() - 3 }} more items
                                                </div>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="flex justify-end">
                                        <a href="{{ route('customer.orders.show', $order) }}" 
                                           class="text-blue-600 hover:text-blue-800 text-sm font-medium">
                                            View Details →
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        @if ($orders->hasPages())
                            <div class="mt-6">
                                {{ $orders->links() }}
                            </div>
                        @endif
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
