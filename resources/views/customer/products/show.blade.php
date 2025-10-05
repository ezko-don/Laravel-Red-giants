<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ $product->name }}
            </h2>
            <a href="{{ route('customer.products.index') }}" class="text-gray-600 hover:text-gray-900">
                ← Back to Catalog
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
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8 p-6">
                    <!-- Product Image -->
                    <div>
                        @if($product->image)
                            <img src="{{ Storage::url($product->image) }}" alt="{{ $product->name }}" 
                                 class="w-full h-96 object-cover rounded-lg">
                        @else
                            <div class="w-full h-96 bg-gray-200 rounded-lg flex items-center justify-center">
                                <span class="text-gray-500 text-lg">No Image Available</span>
                            </div>
                        @endif
                    </div>

                    <!-- Product Details -->
                    <div class="space-y-6">
                        <div>
                            <h1 class="text-3xl font-bold text-gray-900">{{ $product->name }}</h1>
                            <p class="text-2xl font-semibold text-green-600 mt-2">${{ number_format($product->price, 2) }}</p>
                        </div>

                        <div>
                            <h3 class="text-lg font-medium text-gray-900 mb-2">Description</h3>
                            <p class="text-gray-700">{{ $product->description ?: 'No description available.' }}</p>
                        </div>

                        <div>
                            <h3 class="text-lg font-medium text-gray-900 mb-2">Availability</h3>
                            <div class="flex items-center space-x-2">
                                <span class="px-3 py-1 text-sm font-medium rounded-full 
                                    {{ $product->stock > 10 ? 'bg-green-100 text-green-800' : ($product->stock > 0 ? 'bg-yellow-100 text-yellow-800' : 'bg-red-100 text-red-800') }}">
                                    {{ $product->stock > 0 ? $product->stock . ' in stock' : 'Out of stock' }}
                                </span>
                            </div>
                        </div>

                        @auth
                            @if($product->stock > 0)
                                <form method="POST" action="{{ route('customer.cart.add', $product) }}" class="space-y-4">
                                    @csrf
                                    <div>
                                        <label for="quantity" class="block text-sm font-medium text-gray-700 mb-2">Quantity</label>
                                        <select id="quantity" name="quantity" 
                                                class="block w-32 border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                            @for ($i = 1; $i <= min(10, $product->stock); $i++)
                                                <option value="{{ $i }}">{{ $i }}</option>
                                            @endfor
                                        </select>
                                    </div>
                                    
                                    <button type="submit" 
                                            class="w-full bg-blue-500 text-white py-3 px-6 rounded-lg hover:bg-blue-600 font-medium">
                                        Add to Cart
                                    </button>
                                </form>
                            @else
                                <button disabled 
                                        class="w-full bg-gray-400 text-white py-3 px-6 rounded-lg cursor-not-allowed font-medium">
                                    Out of Stock
                                </button>
                            @endif
                        @else
                            <div class="space-y-4">
                                <p class="text-gray-600">Please log in to purchase this product.</p>
                                <a href="{{ route('login') }}" 
                                   class="block w-full text-center bg-yellow-500 text-white py-3 px-6 rounded-lg hover:bg-yellow-600 font-medium">
                                    Login to Purchase
                                </a>
                            </div>
                        @endauth
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
