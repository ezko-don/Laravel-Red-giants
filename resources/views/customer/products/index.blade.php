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
                            <div class="relative overflow-hidden bg-gray-100 aspect-w-1 aspect-h-1 group-hover:bg-gray-200 transition-colors duration-500">
                                @if($product->image)
                                    <img src="{{ Storage::url($product->image) }}" 
                                         alt="{{ $product->name }}" 
                                         class="w-full h-64 object-cover group-hover:scale-110 transition-transform duration-500">
                                @else
                                    <!-- Enhanced placeholder with product-specific icons and gradients -->
                                    @php
                                        $gradients = [
                                            'from-purple-400 to-pink-400',
                                            'from-blue-400 to-indigo-400', 
                                            'from-green-400 to-teal-400',
                                            'from-yellow-400 to-orange-400',
                                            'from-red-400 to-pink-400',
                                            'from-indigo-400 to-purple-400',
                                            'from-teal-400 to-cyan-400',
                                            'from-orange-400 to-red-400'
                                        ];
                                        $icons = [
                                            // Electronics
                                            '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"/>',
                                            // Headphones  
                                            '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11a7 7 0 01-7 7m0 0a7 7 0 01-7-7m7 7v4m0 0H8m4 0h4m-4-8a3 3 0 01-3-3V5a3 3 0 116 0v6a3 3 0 01-3 3z"/>',
                                            // Camera
                                            '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"/>',
                                            // Laptop
                                            '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17V7a2 2 0 012-2h6a2 2 0 012 2v10a2 2 0 01-2 2H5a3 3 0 01-3-3 3 3 0 013-3h4z"/>',
                                            // Watch
                                            '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>',
                                            // Clothing
                                            '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>',
                                            // Book
                                            '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>',
                                            // Gaming
                                            '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 4a2 2 0 114 0v1a1 1 0 001 1h3a1 1 0 011 1v3a1 1 0 01-1 1h-1a2 2 0 100 4h1a1 1 0 011 1v3a1 1 0 01-1 1h-3a1 1 0 01-1-1v-1a2 2 0 10-4 0v1a1 1 0 01-1 1H7a1 1 0 01-1-1v-3a1 1 0 011-1h1a2 2 0 100-4H7a1 1 0 01-1-1V7a1 1 0 011-1h3a1 1 0 001-1V4z"/>'
                                        ];
                                        $gradientIndex = $loop->index % count($gradients);
                                        $iconIndex = $loop->index % count($icons);
                                        $gradient = $gradients[$gradientIndex];
                                        $icon = $icons[$iconIndex];
                                    @endphp
                                    <div class="w-full h-64 bg-gradient-to-br {{ $gradient }} flex items-center justify-center group-hover:from-purple-500 group-hover:to-pink-500 transition-all duration-500 relative overflow-hidden">
                                        <!-- Animated background pattern -->
                                        <div class="absolute inset-0 opacity-10">
                                            <div class="absolute top-4 left-4 w-8 h-8 bg-white rounded-full animate-pulse"></div>
                                            <div class="absolute top-12 right-8 w-6 h-6 bg-white rounded-full animate-pulse" style="animation-delay: 0.5s;"></div>
                                            <div class="absolute bottom-8 left-8 w-4 h-4 bg-white rounded-full animate-pulse" style="animation-delay: 1s;"></div>
                                            <div class="absolute bottom-4 right-4 w-10 h-10 bg-white rounded-full animate-pulse" style="animation-delay: 1.5s;"></div>
                                        </div>
                                        
                                        <!-- Main product icon -->
                                        <div class="relative z-10 transform group-hover:scale-110 group-hover:rotate-12 transition-all duration-500">
                                            <svg class="w-20 h-20 text-white drop-shadow-lg" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                {!! $icon !!}
                                            </svg>
                                        </div>
                                        
                                        <!-- Floating particles -->
                                        <div class="absolute inset-0 pointer-events-none">
                                            <div class="absolute top-1/4 left-1/4 w-2 h-2 bg-white/30 rounded-full animate-bounce" style="animation-delay: 0.2s;"></div>
                                            <div class="absolute top-3/4 right-1/4 w-3 h-3 bg-white/20 rounded-full animate-bounce" style="animation-delay: 0.8s;"></div>
                                            <div class="absolute top-1/2 left-3/4 w-1 h-1 bg-white/40 rounded-full animate-bounce" style="animation-delay: 1.2s;"></div>
                                        </div>
                                        
                                        <!-- Shimmer effect -->
                                        <div class="absolute inset-0 bg-gradient-to-r from-transparent via-white/10 to-transparent -skew-x-12 animate-shimmer"></div>
                                    </div>
                                @endif
                                
                                <!-- Stock Badge -->
                                @if($product->stock > 0)
                                    <div class="absolute top-3 left-3 animate__animated animate__fadeInDown">
                                        <span class="inline-flex items-center px-3 py-1.5 rounded-full text-xs font-bold {{ $product->stock > 10 ? 'bg-green-100 text-green-800 border border-green-200' : 'bg-yellow-100 text-yellow-800 border border-yellow-200' }} shadow-lg backdrop-blur-sm">
                                            @if($product->stock > 10)
                                                <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                                </svg>
                                                In Stock
                                            @else
                                                <svg class="w-3 h-3 mr-1 animate-pulse" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                                </svg>
                                                Only {{ $product->stock }} left
                                            @endif
                                        </span>
                                    </div>
                                @else
                                    <div class="absolute top-3 left-3 animate__animated animate__fadeInDown">
                                        <span class="inline-flex items-center px-3 py-1.5 rounded-full text-xs font-bold bg-red-100 text-red-800 border border-red-200 shadow-lg backdrop-blur-sm">
                                            <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path>
                                            </svg>
                                            Out of Stock
                                        </span>
                                    </div>
                                @endif

                                <!-- Price Badge -->
                                <div class="absolute top-3 right-3 animate__animated animate__fadeInDown" style="animation-delay: 0.1s;">
                                    <div class="bg-white/90 backdrop-blur-sm text-purple-600 px-3 py-1.5 rounded-full text-sm font-bold shadow-lg border border-purple-200">
                                        <span class="flex items-center">
                                            <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                                            </svg>
                                            ${{ number_format($product->price, 0) }}
                                        </span>
                                    </div>
                                </div>

                                <!-- Quick Action Overlay -->
                                <div class="absolute inset-0 bg-gradient-to-t from-black/50 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-all duration-300 flex items-end justify-center pb-4">
                                    <div class="flex space-x-2">
                                        <a href="{{ route('customer.products.show', $product) }}" 
                                           class="bg-white/90 backdrop-blur-sm text-gray-900 px-4 py-2 rounded-xl font-medium transform translate-y-4 group-hover:translate-y-0 transition-all duration-300 shadow-lg hover:shadow-xl flex items-center space-x-1 border border-gray-200"
                                           style="transition-delay: 0.1s;">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                            </svg>
                                            <span>View</span>
                                        </a>
                                        
                                        @auth
                                            @if($product->stock > 0)
                                                <button onclick="quickAddToCart({{ $product->id }})" 
                                                       class="bg-purple-600 text-white px-4 py-2 rounded-xl font-medium transform translate-y-4 group-hover:translate-y-0 transition-all duration-300 shadow-lg hover:shadow-xl hover:bg-purple-700 flex items-center space-x-1"
                                                       style="transition-delay: 0.2s;">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4m1.6 8L3 3H1m6 10v8a2 2 0 002 2h8a2 2 0 002-2v-8m-10 0V9a2 2 0 012-2h4a2 2 0 012 2v4m-6 0a2 2 0 002 2h2a2 2 0 002-2m-6 0V9a2 2 0 012-2h2a2 2 0 012 2v4"></path>
                                                    </svg>
                                                    <span>Add</span>
                                                </button>
                                            @endif
                                        @endauth
                                    </div>
                                </div>
                            </div>

                            <!-- Product Info -->
                            <div class="p-6 bg-gradient-to-br from-white to-gray-50/50 group-hover:from-purple-50/30 group-hover:to-pink-50/30 transition-all duration-500">
                                <!-- Product Title with Rating -->
                                <div class="flex items-start justify-between mb-2">
                                    <h3 class="text-lg font-bold text-gray-900 group-hover:text-purple-600 transition-colors line-clamp-2 flex-1">
                                        {{ $product->name }}
                                    </h3>
                                    <!-- Rating Stars -->
                                    <div class="flex items-center ml-2">
                                        @php $rating = rand(4, 5); @endphp
                                        @for($i = 1; $i <= 5; $i++)
                                            <svg class="w-3 h-3 {{ $i <= $rating ? 'text-yellow-400' : 'text-gray-300' }}" fill="currentColor" viewBox="0 0 20 20">
                                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                            </svg>
                                        @endfor
                                    </div>
                                </div>
                                
                                <!-- Product Description -->
                                <p class="text-gray-600 text-sm mb-4 line-clamp-2 group-hover:text-gray-700 transition-colors">
                                    <span class="inline-flex items-center">
                                        <svg class="w-3 h-3 mr-1 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        {{ Str::limit($product->description, 80) }}
                                    </span>
                                </p>
                                
                                <!-- Product Tags -->
                                <div class="flex flex-wrap gap-1 mb-4">
                                    @php
                                        $tags = [
                                            ['name' => 'Premium', 'color' => 'bg-purple-100 text-purple-800', 'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"/>'],
                                            ['name' => 'Fast Ship', 'color' => 'bg-blue-100 text-blue-800', 'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>'],
                                            ['name' => 'Warranty', 'color' => 'bg-green-100 text-green-800', 'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>'],
                                            ['name' => 'Popular', 'color' => 'bg-pink-100 text-pink-800', 'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>']
                                        ];
                                        $productTags = array_slice($tags, 0, rand(2, 3));
                                    @endphp
                                    @foreach($productTags as $tag)
                                        <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium {{ $tag['color'] }} animate__animated animate__fadeIn" 
                                              style="animation-delay: {{ $loop->index * 0.1 }}s;">
                                            <svg class="w-2.5 h-2.5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                {!! $tag['icon'] !!}
                                            </svg>
                                            {{ $tag['name'] }}
                                        </span>
                                    @endforeach
                                </div>
                                
                                <!-- Price and Action Section -->
                                <div class="flex items-center justify-between">
                                    <div class="flex flex-col">
                                        <div class="flex items-center space-x-2">
                                            <div class="text-2xl font-bold text-purple-600 group-hover:text-purple-700 transition-colors">
                                                ${{ number_format($product->price, 2) }}
                                            </div>
                                            @if(rand(0, 1))
                                                <div class="text-sm text-gray-500 line-through">
                                                    ${{ number_format($product->price * 1.2, 2) }}
                                                </div>
                                            @endif
                                        </div>
                                        <div class="text-xs text-gray-500 flex items-center">
                                            <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                                            </svg>
                                            Free shipping
                                        </div>
                                    </div>
                                    
                                    @auth
                                        @if($product->stock > 0)
                                            <form action="{{ route('customer.cart.add', $product) }}" method="POST" class="inline">
                                                @csrf
                                                <button type="submit" 
                                                        class="bg-gradient-to-r from-purple-600 to-indigo-600 text-white px-6 py-3 rounded-xl hover:from-purple-700 hover:to-indigo-700 transition-all duration-300 transform hover:scale-105 shadow-lg hover:shadow-xl text-sm font-bold flex items-center space-x-2 group/btn">
                                                    <svg class="w-4 h-4 group-hover/btn:animate-bounce" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4m1.6 8L3 3H1m6 10v8a2 2 0 002 2h8a2 2 0 002-2v-8m-10 0V9a2 2 0 012-2h4a2 2 0 012 2v4m-6 0a2 2 0 002 2h2a2 2 0 002-2m-6 0V9a2 2 0 012-2h2a2 2 0 012 2v4"></path>
                                                    </svg>
                                                    <span>Add to Cart</span>
                                                </button>
                                            </form>
                                        @else
                                            <span class="text-red-500 text-sm font-medium flex items-center">
                                                <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path>
                                                </svg>
                                                Out of Stock
                                            </span>
                                        @endif
                                    @else
                                        <a href="{{ route('login') }}" 
                                           class="bg-gray-200 text-gray-700 px-6 py-3 rounded-xl hover:bg-gray-300 transition-all duration-300 text-sm font-medium flex items-center space-x-2 shadow-md hover:shadow-lg">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path>
                                            </svg>
                                            <span>Login to Buy</span>
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
        
        @keyframes shimmer {
            0% {
                transform: translateX(-100%) skewX(-12deg);
            }
            100% {
                transform: translateX(200%) skewX(-12deg);
            }
        }
        
        .animate-shimmer {
            animation: shimmer 2s ease-in-out infinite;
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

        /* Loading skeleton */
        .skeleton {
            background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%);
            background-size: 200% 100%;
            animation: skeleton-loading 1.5s infinite;
        }

        @keyframes skeleton-loading {
            0% {
                background-position: 200% 0;
            }
            100% {
                background-position: -200% 0;
            }
        }

        /* Floating animation for badges */
        @keyframes float-badge {
            0%, 100% {
                transform: translateY(0px);
            }
            50% {
                transform: translateY(-3px);
            }
        }

        .animate-float-badge {
            animation: float-badge 3s ease-in-out infinite;
        }
    </style>

    <script>
        // Quick add to cart functionality
        function quickAddToCart(productId) {
            const button = event.target.closest('button');
            const originalText = button.innerHTML;
            
            // Add loading state
            button.innerHTML = `
                <svg class="animate-spin w-4 h-4" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
                <span>Adding...</span>
            `;
            button.disabled = true;

            // Simulate API call (replace with actual AJAX call)
            setTimeout(() => {
                // Success state
                button.innerHTML = `
                    <svg class="w-4 h-4 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                    </svg>
                    <span>Added!</span>
                `;
                
                // Reset after 2 seconds
                setTimeout(() => {
                    button.innerHTML = originalText;
                    button.disabled = false;
                }, 2000);
            }, 1000);
        }

        // Intersection Observer for staggered animations
        document.addEventListener('DOMContentLoaded', function() {
            const observerOptions = {
                threshold: 0.1,
                rootMargin: '0px 0px -50px 0px'
            };

            const observer = new IntersectionObserver(function(entries) {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.style.opacity = '1';
                        entry.target.style.transform = 'translateY(0)';
                    }
                });
            }, observerOptions);

            // Observe all product cards for animations
            document.querySelectorAll('.group').forEach((card, index) => {
                card.style.opacity = '0';
                card.style.transform = 'translateY(30px)';
                card.style.transition = `opacity 0.6s ease ${index * 0.1}s, transform 0.6s ease ${index * 0.1}s`;
                observer.observe(card);
            });

            // Add hover sound effect (optional)
            document.querySelectorAll('.group').forEach(card => {
                card.addEventListener('mouseenter', function() {
                    // Optional: Add subtle hover sound
                    // new Audio('/sounds/hover.mp3').play();
                });
            });
        });

        // Search enhancement
        const searchInput = document.querySelector('input[name="search"]');
        if (searchInput) {
            let searchTimeout;
            searchInput.addEventListener('input', function() {
                clearTimeout(searchTimeout);
                const searchTerm = this.value;
                
                if (searchTerm.length > 2) {
                    searchTimeout = setTimeout(() => {
                        // Optional: Implement live search
                        console.log('Searching for:', searchTerm);
                    }, 300);
                }
            });
        }
    </script>
</x-app-layout>