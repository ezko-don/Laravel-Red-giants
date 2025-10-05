<x-guest-layout>
    <div class="text-center mb-8">
        <h2 class="text-3xl font-bold text-gray-900 mb-2 animate__animated animate__fadeInDown">
            Join Us Today! 🚀
        </h2>
        <p class="text-gray-600 animate__animated animate__fadeInUp">
            Create your account and start shopping premium products
        </p>
    </div>

    <form method="POST" action="{{ route('register') }}" class="space-y-6">
        @csrf

        <!-- Name -->
        <div class="animate__animated animate__fadeInLeft" style="animation-delay: 0.1s;">
            <label for="name" class="block text-sm font-bold text-gray-700 mb-2 flex items-center">
                <svg class="w-4 h-4 mr-2 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                </svg>
                Full Name
            </label>
            <input id="name" 
                   class="block w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:ring-purple-500 focus:border-purple-500 transition-all duration-300 bg-gray-50 hover:bg-white focus:bg-white text-gray-900 placeholder-gray-500" 
                   type="text" 
                   name="name" 
                   value="{{ old('name') }}" 
                   required 
                   autofocus 
                   autocomplete="name"
                   placeholder="Enter your full name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2 text-red-500 text-sm" />
        </div>

        <!-- Email Address -->
        <div class="animate__animated animate__fadeInRight" style="animation-delay: 0.2s;">
            <label for="email" class="block text-sm font-bold text-gray-700 mb-2 flex items-center">
                <svg class="w-4 h-4 mr-2 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"></path>
                </svg>
                Email Address
            </label>
            <input id="email" 
                   class="block w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:ring-purple-500 focus:border-purple-500 transition-all duration-300 bg-gray-50 hover:bg-white focus:bg-white text-gray-900 placeholder-gray-500" 
                   type="email" 
                   name="email" 
                   value="{{ old('email') }}" 
                   required 
                   autocomplete="username"
                   placeholder="Enter your email address" />
            <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-500 text-sm" />
        </div>

        <!-- Password -->
        <div class="animate__animated animate__fadeInLeft" style="animation-delay: 0.3s;">
            <label for="password" class="block text-sm font-bold text-gray-700 mb-2 flex items-center">
                <svg class="w-4 h-4 mr-2 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                </svg>
                Password
            </label>
            <input id="password" 
                   class="block w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:ring-purple-500 focus:border-purple-500 transition-all duration-300 bg-gray-50 hover:bg-white focus:bg-white text-gray-900 placeholder-gray-500"
                   type="password"
                   name="password"
                   required 
                   autocomplete="new-password"
                   placeholder="Create a secure password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-500 text-sm" />
        </div>

        <!-- Confirm Password -->
        <div class="animate__animated animate__fadeInRight" style="animation-delay: 0.4s;">
            <label for="password_confirmation" class="block text-sm font-bold text-gray-700 mb-2 flex items-center">
                <svg class="w-4 h-4 mr-2 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                Confirm Password
            </label>
            <input id="password_confirmation" 
                   class="block w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:ring-purple-500 focus:border-purple-500 transition-all duration-300 bg-gray-50 hover:bg-white focus:bg-white text-gray-900 placeholder-gray-500"
                   type="password"
                   name="password_confirmation" 
                   required 
                   autocomplete="new-password"
                   placeholder="Confirm your password" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 text-red-500 text-sm" />
        </div>

        <div class="space-y-4 animate__animated animate__fadeInUp" style="animation-delay: 0.5s;">
            <button type="submit" 
                    class="w-full bg-gradient-to-r from-purple-600 to-indigo-600 text-white py-3 px-6 rounded-xl hover:from-purple-700 hover:to-indigo-700 transition-all duration-300 transform hover:scale-105 shadow-lg hover:shadow-xl font-semibold flex items-center justify-center space-x-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path>
                </svg>
                <span>Create Account</span>
            </button>
            
            <div class="text-center">
                <p class="text-gray-600 text-sm">
                    Already have an account? 
                    <a href="{{ route('login') }}" 
                       class="text-purple-600 hover:text-purple-800 font-semibold transition-colors duration-300 ml-1">
                        Sign in here
                    </a>
                </p>
            </div>
        </div>
    </form>

    <!-- Benefits Section -->
    <div class="mt-8 p-4 bg-gradient-to-r from-green-50 to-blue-50 rounded-xl border border-green-200 animate__animated animate__fadeInUp" style="animation-delay: 0.6s;">
        <h4 class="text-sm font-bold text-gray-800 mb-3 flex items-center">
            <svg class="w-4 h-4 mr-2 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"></path>
            </svg>
            Why Join Mini Shop Lite?
        </h4>
        <div class="grid grid-cols-2 gap-3 text-xs text-gray-700">
            <div class="flex items-center space-x-2">
                <svg class="w-3 h-3 text-green-500 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                </svg>
                <span>Premium Products</span>
            </div>
            <div class="flex items-center space-x-2">
                <svg class="w-3 h-3 text-green-500 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                </svg>
                <span>Free Shipping</span>
            </div>
            <div class="flex items-center space-x-2">
                <svg class="w-3 h-3 text-green-500 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                </svg>
                <span>Secure Checkout</span>
            </div>
            <div class="flex items-center space-x-2">
                <svg class="w-3 h-3 text-green-500 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                </svg>
                <span>24/7 Support</span>
            </div>
        </div>
    </div>
</x-guest-layout>