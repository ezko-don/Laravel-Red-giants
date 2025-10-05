<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ $product->name }}
            </h2>
            <div class="space-x-4">
                <a href="{{ route('admin.products.edit', $product) }}" class="text-indigo-600 hover:text-indigo-900">Edit</a>
                <a href="{{ route('admin.products.index') }}" class="text-gray-600 hover:text-gray-900">Back to List</a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
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
                                <h3 class="text-lg font-medium text-gray-900 mb-2">Stock Information</h3>
                                <div class="flex items-center space-x-2">
                                    <span class="px-3 py-1 text-sm font-medium rounded-full 
                                        {{ $product->stock > 10 ? 'bg-green-100 text-green-800' : ($product->stock > 0 ? 'bg-yellow-100 text-yellow-800' : 'bg-red-100 text-red-800') }}">
                                        {{ $product->stock }} units available
                                    </span>
                                </div>
                            </div>

                            <div>
                                <h3 class="text-lg font-medium text-gray-900 mb-2">Product Information</h3>
                                <div class="space-y-2 text-sm">
                                    <div class="flex justify-between">
                                        <span class="text-gray-600">Product ID:</span>
                                        <span class="text-gray-900">{{ $product->id }}</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span class="text-gray-600">Created:</span>
                                        <span class="text-gray-900">{{ $product->created_at->format('M d, Y') }}</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span class="text-gray-600">Last Updated:</span>
                                        <span class="text-gray-900">{{ $product->updated_at->format('M d, Y') }}</span>
                                    </div>
                                </div>
                            </div>

                            <!-- Actions -->
                            <div class="flex space-x-4">
                                <a href="{{ route('admin.products.edit', $product) }}" 
                                   class="bg-indigo-500 text-white px-6 py-2 rounded hover:bg-indigo-600">
                                    Edit Product
                                </a>
                                <form method="POST" action="{{ route('admin.products.destroy', $product) }}" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                            onclick="return confirm('Are you sure you want to delete this product?')"
                                            class="bg-red-500 text-white px-6 py-2 rounded hover:bg-red-600">
                                        Delete Product
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
