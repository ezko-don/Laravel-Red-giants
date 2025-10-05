<x-app-layout>
    <div class="min-h-screen bg-gradient-to-br from-blue-50 via-white to-purple-50">
        <!-- Enhanced Hero Section -->
        <div class="relative bg-gradient-to-r from-purple-600 via-blue-600 to-indigo-700 overflow-hidden">
            <!-- Animated background elements -->
            <div class="absolute inset-0">
                <div class="absolute top-1/4 left-1/4 w-72 h-72 bg-white/10 rounded-full blur-3xl animate-pulse"></div>
                <div class="absolute bottom-1/4 right-1/4 w-96 h-96 bg-purple-300/20 rounded-full blur-3xl animate-pulse" style="animation-delay: -2s;"></div>
            </div>
            
            <div class="relative max-w-7xl mx-auto py-16 px-4 sm:px-6 lg:px-8">
                <div class="text-center">
                    <h1 class="text-4xl md:text-6xl font-bold text-white mb-4 animate__animated animate__fadeInDown">
                        🛍️ <span class="text-transparent bg-clip-text bg-gradient-to-r from-yellow-400 to-pink-400">Premium</span> Products
                    </h1>
                    <p class="text-xl text-white/90 max-w-2xl mx-auto animate__animated animate__fadeInUp">
                        Discover our curated collection of high-quality products with amazing deals and fast shipping
                    </p>
                </div>
            </div>
        </div>

        <!-- Alert Messages -->
        @if (session('success'))
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-6">
                <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded-r-xl shadow-lg animate__animated animate__fadeInDown">
                    <div class="flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                        </svg>
                        {{ session('success') }}
                    </div>
                </div>
            </div>
        @endif

        @if (session('error'))
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-6">
                <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 rounded-r-xl shadow-lg animate__animated animate__fadeInDown">
                    <div class="flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path>
                        </svg>
                        {{ session('error') }}
                    </div>
                </div>
            </div>
        @endif

        <!-- Enhanced Search and Filter Section -->
        <div class="sticky top-0 z-40 bg-white/95 backdrop-blur-md border-b border-gray-200 shadow-lg">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
                <form method="GET" action="{{ route('customer.products.index') }}" class="grid grid-cols-1 md:grid-cols-4 gap-4">
                    <!-- Search Input -->
                    <div class="md:col-span-2 relative group">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400 group-focus-within:text-purple-500 transition-colors" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </div>
                        <input type="text" name="search" value="{{ request('search') }}" 
                               placeholder="Search for amazing products..." 
                               class="block w-full pl-12 pr-4 py-3 border-2 border-gray-200 rounded-xl focus:ring-purple-500 focus:border-purple-500 transition-all duration-300 bg-white/80 backdrop-blur-sm hover:bg-white">
                    </div>

                    <!-- Price Range -->
                    <div class="flex space-x-2">
                        <input type="number" name="min_price" value="{{ request('min_price') }}" 
                               placeholder="Min $" 
                               class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:ring-purple-500 focus:border-purple-500 transition-all duration-300 bg-white/80 hover:bg-white">
                        <input type="number" name="max_price" value="{{ request('max_price') }}" 
                               placeholder="Max $" 
                               class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:ring-purple-500 focus:border-purple-500 transition-all duration-300 bg-white/80 hover:bg-white">
                    </div>

                    <!-- Sort and Search Button -->
                    <div class="flex space-x-2">
                        <select name="sort" 
                                class="flex-1 px-4 py-3 border-2 border-gray-200 rounded-xl focus:ring-purple-500 focus:border-purple-500 transition-all duration-300 bg-white/80 hover:bg-white">
                            <option value="">Sort by</option>
                            <option value="name_asc" {{ request('sort') == 'name_asc' ? 'selected' : '' }}>Name A-Z</option>
                            <option value="name_desc" {{ request('sort') == 'name_desc' ? 'selected' : '' }}>Name Z-A</option>
                            <option value="price_asc" {{ request('sort') == 'price_asc' ? 'selected' : '' }}>Price Low-High</option>
                            <option value="price_desc" {{ request('sort') == 'price_desc' ? 'selected' : '' }}>Price High-Low</option>
                        </select>
                        <button type="submit" 
                                class="px-6 py-3 bg-gradient-to-r from-purple-600 to-indigo-600 text-white rounded-xl hover:from-purple-700 hover:to-indigo-700 transition-all duration-300 transform hover:scale-105 shadow-lg hover:shadow-xl">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                        </button>
                    </div>
                </form>

                <!-- Search Results Info -->
                @if(request()->hasAny(['search', 'min_price', 'max_price', 'sort']))
                    <div class="mt-4 flex items-center justify-between">
                        <div class="flex items-center space-x-2 text-sm text-gray-600">
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-purple-100 text-purple-800">
                                {{ $products->total() }} {{ Str::plural('result', $products->total()) }}
                            </span>
                            @if(request('search'))
                                <span>for "<strong>{{ request('search') }}</strong>"</span>
                            @endif
                        </div>
                        <a href="{{ route('customer.products.index') }}" 
                           class="text-sm text-purple-600 hover:text-purple-800 font-medium transition-colors">
                            Clear all filters
                        </a>
                    </div>
                @endif
            </div>
        </div>

        <!-- Products Grid -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            @if($products->count() > 0)
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
                    @foreach($products as $index => $product)
                        <div class="group bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2 overflow-hidden animate__animated animate__fadeInUp" 
                             style="animation-delay: {{ $index * 0.1 }}s;">
                            <!-- Product Image -->
                            <div class="relative overflow-hidden bg-gray-100 aspect-w-1 aspect-h-1">
                                @if($product->image)
                                    <img src="{{ Storage::url($product->image) }}" 
                                         alt="{{ $product->name }}" 
                                         class="w-full h-64 object-cover group-hover:scale-110 transition-transform duration-500">
                                @else
                                    <div class="w-full h-64 bg-gradient-to-br from-purple-400 to-pink-400 flex items-center justify-center group-hover:from-purple-500 group-hover:to-pink-500 transition-all duration-500">
                                        <svg class="w-16 h-16 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                                        </svg>
                                    </div>
                                @endif
                                
                                <!-- Stock Badge -->
                                @if($product->stock > 0)
                                    <div class="absolute top-3 left-3">
                                        <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium {{ $product->stock > 10 ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                            @if($product->stock > 10)
                                                ✅ In Stock
                                            @else
                                                ⚡ Only {{ $product->stock }} left
                                            @endif
                                        </span>
                                    </div>
                                @else
                                    <div class="absolute top-3 left-3">
                                        <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                            ❌ Out of Stock
                                        </span>
                                    </div>
                                @endif

                                <!-- Quick Action Overlay -->
                                <div class="absolute inset-0 bg-black/0 group-hover:bg-black/20 transition-all duration-300 flex items-center justify-center opacity-0 group-hover:opacity-100">
                                    <a href="{{ route('customer.products.show', $product) }}" 
                                       class="bg-white text-gray-900 px-6 py-2 rounded-full font-medium transform scale-90 group-hover:scale-100 transition-transform duration-300 shadow-lg hover:shadow-xl">
                                        👁️ Quick View
                                    </a>
                                </div>
                            </div>

                            <!-- Product Info -->
                            <div class="p-6">
                                <h3 class="text-lg font-bold text-gray-900 mb-2 group-hover:text-purple-600 transition-colors line-clamp-2">
                                    {{ $product->name }}
                                </h3>
                                <p class="text-gray-600 text-sm mb-4 line-clamp-2">
                                    {{ Str::limit($product->description, 80) }}
                                </p>
                                
                                <div class="flex items-center justify-between">
                                    <div class="text-2xl font-bold text-purple-600">
                                        ${{ number_format($product->price, 2) }}
                                    </div>
                                    
                                    @auth
                                        @if($product->stock > 0)
                                            <form action="{{ route('customer.cart.add', $product) }}" method="POST" class="inline">
                                                @csrf
                                                <button type="submit" 
                                                        class="bg-gradient-to-r from-purple-600 to-indigo-600 text-white px-4 py-2 rounded-xl hover:from-purple-700 hover:to-indigo-700 transition-all duration-300 transform hover:scale-105 shadow-lg hover:shadow-xl text-sm font-medium">
                                                    🛒 Add to Cart
                                                </button>
                                            </form>
                                        @else
                                            <span class="text-red-500 text-sm font-medium">Out of Stock</span>
                                        @endif
                                    @else
                                        <a href="{{ route('login') }}" 
                                           class="bg-gray-200 text-gray-700 px-4 py-2 rounded-xl hover:bg-gray-300 transition-all duration-300 text-sm font-medium">
                                            Login to Buy
                                        </a>
                                    @endauth
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Enhanced Pagination -->
                <div class="mt-16">
                    {{ $products->withQueryString()->links('pagination::tailwind') }}
                </div>
            @else
                <!-- Empty State -->
                <div class="text-center py-16">
                    <div class="max-w-md mx-auto">
                        <div class="mb-8">
                            <svg class="w-24 h-24 mx-auto text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-900 mb-4">No products found</h3>
                        <p class="text-gray-600 mb-8">
                            @if(request()->hasAny(['search', 'min_price', 'max_price']))
                                We couldn't find any products matching your criteria. Try adjusting your search or filters.
                            @else
                                It looks like there are no products available right now.
                            @endif
                        </p>
                        @if(request()->hasAny(['search', 'min_price', 'max_price']))
                            <a href="{{ route('customer.products.index') }}" 
                               class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-purple-600 to-indigo-600 text-white rounded-xl hover:from-purple-700 hover:to-indigo-700 transition-all duration-300 transform hover:scale-105 shadow-lg hover:shadow-xl">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                                </svg>
                                Clear Filters & Show All
                            </a>
                        @endif
                    </div>
                </div>
            @endif
        </div>

        <!-- Floating Cart Button for Mobile -->
        @auth
            <div class="fixed bottom-6 right-6 z-50 sm:hidden">
                <a href="{{ route('customer.cart.index') }}" 
                   class="bg-gradient-to-r from-purple-600 to-indigo-600 text-white p-4 rounded-full shadow-2xl hover:shadow-3xl transition-all duration-300 transform hover:scale-110">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4m1.6 8L3 3H1m6 10v8a2 2 0 002 2h8a2 2 0 002-2v-8m-10 0V9a2 2 0 012-2h4a2 2 0 012 2v4m-6 0a2 2 0 002 2h2a2 2 0 002-2m-6 0V9a2 2 0 012-2h2a2 2 0 012 2v4"></path>
                    </svg>
                </a>
            </div>
        @endauth
    </div>

    <!-- Add animate.css for better animations -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    
    <style>
        .line-clamp-2 {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
        
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

        /* Custom hover effects */
        .hover-lift {
            transition: all 0.3s ease;
        }
        .hover-lift:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 40px rgba(0,0,0,0.1);
        }

        /* Glass morphism effect */
        .glass {
            background: rgba(255, 255, 255, 0.25);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.18);
        }
    </style>
</x-app-layout>