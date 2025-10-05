<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Mini Shop Lite') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        
        <!-- Tailwind CDN for immediate styling -->
        <script src="https://cdn.tailwindcss.com"></script>
        
        <!-- Animate.css for animations -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        
        <style>
            .gradient-bg {
                background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            }
            .glass-effect {
                backdrop-filter: blur(10px);
                background: rgba(255, 255, 255, 0.95);
                border: 1px solid rgba(255, 255, 255, 0.2);
            }
            @keyframes float {
                0%, 100% { transform: translateY(0px); }
                50% { transform: translateY(-20px); }
            }
            .animate-float {
                animation: float 6s ease-in-out infinite;
            }
        </style>
    </head>
    <body class="font-sans text-gray-900 antialiased">
        <div class="min-h-screen gradient-bg flex flex-col sm:justify-center items-center pt-6 sm:pt-0 relative overflow-hidden">
            <!-- Animated Background Elements -->
            <div class="absolute inset-0">
                <div class="absolute top-1/4 left-1/4 w-72 h-72 bg-white bg-opacity-10 rounded-full blur-3xl animate-pulse"></div>
                <div class="absolute bottom-1/4 right-1/4 w-96 h-96 bg-purple-300 bg-opacity-20 rounded-full blur-3xl animate-pulse"></div>
                <div class="absolute top-1/2 left-1/2 w-64 h-64 bg-pink-300 bg-opacity-15 rounded-full blur-3xl animate-float"></div>
            </div>
            
            <!-- Logo Section -->
            <div class="relative z-10 animate__animated animate__fadeInDown">
                <a href="{{ route('landing') }}" class="flex items-center space-x-3 group mb-8">
                    <div class="w-16 h-16 bg-gradient-to-r from-purple-500 to-pink-500 rounded-2xl flex items-center justify-center group-hover:scale-110 transition-transform duration-300 shadow-2xl">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                        </svg>
                    </div>
                    <div class="text-center">
                        <h1 class="text-3xl font-bold text-white group-hover:text-yellow-400 transition-colors duration-300">
                            Mini Shop Lite
                        </h1>
                        <p class="text-white text-opacity-80 text-sm">Premium E-commerce Experience</p>
                    </div>
                </a>
            </div>

            <!-- Form Container -->
            <div class="w-full sm:max-w-md mt-6 px-8 py-8 glass-effect shadow-2xl overflow-hidden sm:rounded-2xl relative z-10 animate__animated animate__fadeInUp">
                {{ $slot }}
            </div>
            
            <!-- Footer Links -->
            <div class="mt-8 text-center relative z-10 animate__animated animate__fadeInUp" style="animation-delay: 0.2s;">
                <div class="flex items-center justify-center space-x-6 text-white text-opacity-80 text-sm">
                    <a href="{{ route('landing') }}" class="hover:text-white transition-colors duration-300 flex items-center space-x-1">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                        </svg>
                        <span>Home</span>
                    </a>
                    <a href="{{ route('home') }}" class="hover:text-white transition-colors duration-300 flex items-center space-x-1">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                        </svg>
                        <span>Shop</span>
                    </a>
                </div>
                <p class="text-white text-opacity-60 text-xs mt-3">
                    © 2025 Mini Shop Lite. All rights reserved.
                </p>
            </div>
        </div>
    </body>
</html>