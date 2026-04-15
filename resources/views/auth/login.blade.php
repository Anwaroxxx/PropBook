<x-guest-layout>
    <div class="max-w-md mx-auto">
        <div class="text-center mb-8">
            <div class="w-16 h-16 rounded-full bg-yellow-600 flex items-center justify-center mx-auto mb-4">
                <i class="fas fa-sign-in-alt text-2xl text-white"></i>
            </div>
            <h2 class="text-2xl font-bold text-white mb-2">Welcome Back</h2>
            <p class="text-gray-400">Sign in to your account to continue</p>
        </div>

        <div class="card p-8">
            <x-auth-session-status class="mb-4" :status="session('status')" />

            <form method="POST" action="{{ route('login') }}" class="space-y-6">
                @csrf

                <div>
                    <x-input-label for="email" :value="__('Email Address')" />
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-envelope text-gray-500 text-sm"></i>
                        </div>
                        <x-text-input id="email" class="block w-full pl-10" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                    </div>
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <div>
                    <x-input-label for="password" :value="__('Password')" />
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-lock text-gray-500 text-sm"></i>
                        </div>
                        <x-text-input id="password" class="block w-full pl-10"
                                        type="password"
                                        name="password"
                                        required autocomplete="current-password" />
                    </div>
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <div class="flex items-center justify-between">
                    <label for="remember_me" class="inline-flex items-center cursor-pointer">
                        <input id="remember_me" type="checkbox" class="rounded bg-gray-800 border-gray-700 text-yellow-600 focus:ring-yellow-600 focus:ring-offset-2 focus:ring-offset-gray-900" name="remember">
                        <span class="ml-2 text-sm text-gray-400">Remember me</span>
                    </label>

                    @if (Route::has('password.request'))
                        <a class="text-sm text-yellow-600 hover:text-yellow-500 font-medium" href="{{ route('password.request') }}">
                            Forgot password?
                        </a>
                    @endif
                </div>

                <div class="pt-2">
                    <button type="submit" class="w-full btn-primary py-3 text-base">
                        <i class="fas fa-sign-in-alt mr-2"></i>Sign In
                    </button>
                </div>
            </form>

            <div class="mt-6 pt-6 border-t border-gray-800 text-center">
                <p class="text-sm text-gray-400">
                    Don't have an account? 
                    <a href="{{ route('register') }}" class="text-yellow-600 hover:text-yellow-500 font-medium">Register here</a>
                </p>
            </div>
        </div>
    </div>
</x-guest-layout>
