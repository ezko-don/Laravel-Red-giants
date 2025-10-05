<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Edit Product') }}
            </h2>
            <a href="{{ route('admin.products.index') }}" class="text-gray-600 hover:text-gray-900">Back to List</a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form method="POST" action="{{ route('admin.products.update', $product) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <!-- Name -->
                        <div class="mb-4">
                            <x-input-label for="name" :value="__('Product Name')" />
                            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name', $product->name)" required autofocus />
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>

                        <!-- Description -->
                        <div class="mb-4">
                            <x-input-label for="description" :value="__('Description')" />
                            <textarea id="description" name="description" rows="3" 
                                    class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">{{ old('description', $product->description) }}</textarea>
                            <x-input-error :messages="$errors->get('description')" class="mt-2" />
                        </div>

                        <!-- Price -->
                        <div class="mb-4">
                            <x-input-label for="price" :value="__('Price')" />
                            <x-text-input id="price" class="block mt-1 w-full" type="number" step="0.01" min="0" name="price" :value="old('price', $product->price)" required />
                            <x-input-error :messages="$errors->get('price')" class="mt-2" />
                        </div>

                        <!-- Stock -->
                        <div class="mb-4">
                            <x-input-label for="stock" :value="__('Stock Quantity')" />
                            <x-text-input id="stock" class="block mt-1 w-full" type="number" min="0" name="stock" :value="old('stock', $product->stock)" required />
                            <x-input-error :messages="$errors->get('stock')" class="mt-2" />
                        </div>

                        <!-- Current Image -->
                        @if($product->image)
                            <div class="mb-4">
                                <x-input-label value="Current Image" />
                                <img src="{{ Storage::url($product->image) }}" alt="{{ $product->name }}" class="mt-2 w-32 h-32 object-cover rounded-lg">
                            </div>
                        @endif

                        <!-- New Image -->
                        <div class="mb-6">
                            <x-input-label for="image" :value="__('New Product Image (optional)')" />
                            <input id="image" type="file" name="image" accept="image/*"
                                   class="block mt-1 w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                            <x-input-error :messages="$errors->get('image')" class="mt-2" />
                        </div>

                        <div class="flex items-center justify-end space-x-4">
                            <a href="{{ route('admin.products.index') }}" class="text-gray-600 hover:text-gray-900">Cancel</a>
                            <x-primary-button class="ml-4">
                                {{ __('Update Product') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
