<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Product Catalog') }}
            </h2>
            @auth
                <a href="{{ route('customer.cart.index') }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                    View Cart
                </a>
            @endauth
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
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

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                @forelse ($products as $product)
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        @if($product->image)
                            <img src="{{ Storage::url($product->image) }}" alt="{{ $product->name }}" 
                                 class="w-full h-48 object-cover">
                        @else
                            <div class="w-full h-48 bg-gray-200 flex items-center justify-center">
                                <span class="text-gray-500">No Image</span>
                            </div>
                        @endif
                        
                        <div class="p-4">
                            <h3 class="text-lg font-semibold text-gray-900 mb-2">{{ $product->name }}</h3>
                            <p class="text-gray-600 text-sm mb-3">{{ Str::limit($product->description, 100) }}</p>
                            
                            <div class="flex justify-between items-center mb-3">
                                <span class="text-xl font-bold text-green-600">${{ number_format($product->price, 2) }}</span>
                                <span class="text-sm text-gray-500">{{ $product->stock }} in stock</span>
                            </div>

                            <div class="space-y-2">
                                <a href="{{ route('customer.products.show', $product) }}" 
                                   class="block w-full text-center bg-gray-100 text-gray-800 py-2 px-4 rounded hover:bg-gray-200">
                                    View Details
                                </a>
                                
                                @auth
                                    @if($product->stock > 0)
                                        <form method="POST" action="{{ route('customer.cart.add', $product) }}">
                                            @csrf
                                            <input type="hidden" name="quantity" value="1">
                                            <button type="submit" 
                                                    class="w-full bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600">
                                                Add to Cart
                                            </button>
                                        </form>
                                    @else
                                        <button disabled class="w-full bg-gray-400 text-white py-2 px-4 rounded cursor-not-allowed">
                                            Out of Stock
                                        </button>
                                    @endif
                                @else
                                    <a href="{{ route('login') }}" 
                                       class="block w-full text-center bg-yellow-500 text-white py-2 px-4 rounded hover:bg-yellow-600">
                                        Login to Purchase
                                    </a>
                                @endauth
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full text-center py-12">
                        <p class="text-gray-500 text-lg">No products available at the moment.</p>
                    </div>
                @endforelse
            </div>

            @if ($products->hasPages())
                <div class="mt-8">
                    {{ $products->links() }}
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
