<x-guest-layout>
    <div class="text-center mb-8">
        <h2 class="text-3xl font-bold text-gray-900 mb-2 animate__animated animate__fadeInDown">
            Welcome Back! 👋
        </h2>
        <p class="text-gray-600 animate__animated animate__fadeInUp">
            Sign in to your account to continue shopping
        </p>
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="space-y-6">
        @csrf

        <!-- Email Address -->
        <div class="animate__animated animate__fadeInLeft" style="animation-delay: 0.1s;">
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
                   autofocus 
                   autocomplete="username"
                   placeholder="Enter your email address" />
            <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-500 text-sm" />
        </div>

        <!-- Password -->
        <div class="animate__animated animate__fadeInRight" style="animation-delay: 0.2s;">
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
                   autocomplete="current-password"
                   placeholder="Enter your password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-500 text-sm" />
        </div>

        <!-- Remember Me -->
        <div class="flex items-center justify-between animate__animated animate__fadeInUp" style="animation-delay: 0.3s;">
            <label for="remember_me" class="inline-flex items-center cursor-pointer group">
                <input id="remember_me" 
                       type="checkbox" 
                       class="rounded-lg border-gray-300 text-purple-600 shadow-sm focus:ring-purple-500 transition-all duration-300 group-hover:scale-105" 
                       name="remember">
                <span class="ml-3 text-sm text-gray-600 group-hover:text-gray-900 transition-colors duration-300 flex items-center">
                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    Remember me
                </span>
            </label>

            @if (Route::has('password.request'))
                <a class="text-sm text-purple-600 hover:text-purple-800 font-medium transition-colors duration-300 flex items-center" 
                   href="{{ route('password.request') }}">
                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    Forgot password?
                </a>
            @endif
        </div>

        <div class="space-y-4 animate__animated animate__fadeInUp" style="animation-delay: 0.4s;">
            <button type="submit" 
                    class="w-full bg-gradient-to-r from-purple-600 to-indigo-600 text-white py-3 px-6 rounded-xl hover:from-purple-700 hover:to-indigo-700 transition-all duration-300 transform hover:scale-105 shadow-lg hover:shadow-xl font-semibold flex items-center justify-center space-x-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path>
                </svg>
                <span>Sign In</span>
            </button>
            
            <div class="text-center">
                <p class="text-gray-600 text-sm">
                    Don't have an account? 
                    <a href="{{ route('register') }}" 
                       class="text-purple-600 hover:text-purple-800 font-semibold transition-colors duration-300 ml-1">
                        Create one here
                    </a>
                </p>
            </div>
        </div>
    </form>

    <!-- Demo Accounts Info -->
    <div class="mt-8 p-4 bg-gradient-to-r from-blue-50 to-purple-50 rounded-xl border border-blue-200 animate__animated animate__fadeInUp" style="animation-delay: 0.5s;">
        <h4 class="text-sm font-bold text-gray-800 mb-2 flex items-center">
            <svg class="w-4 h-4 mr-2 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
            Demo Accounts
        </h4>
        <div class="space-y-2 text-xs text-gray-700">
            <div class="flex justify-between items-center">
                <span class="font-medium">👨‍💼 Admin:</span>
                <span class="font-mono bg-white px-2 py-1 rounded">admin@demo.com</span>
            </div>
            <div class="flex justify-between items-center">
                <span class="font-medium">🛍️ Customer:</span>
                <span class="font-mono bg-white px-2 py-1 rounded">customer@demo.com</span>
            </div>
            <div class="text-center text-gray-500 mt-2">
                Password: <span class="font-mono font-semibold">password</span>
            </div>
        </div>
    </div>
</x-guest-layout>