<x-guest-layout>
    <div class="max-w-md mx-auto">
        <div class="text-center mb-8">
            <div class="w-16 h-16 rounded-full bg-yellow-600/20 flex items-center justify-center mx-auto mb-4">
                <i class="fas fa-key text-2xl text-yellow-500"></i>
            </div>
            <h2 class="text-2xl font-bold text-white mb-2">Forgot Password?</h2>
            <p class="text-gray-400">No worries! Enter your email and we'll send you a reset link</p>
        </div>

        <div class="card p-8">
            <x-auth-session-status class="mb-4" :status="session('status')" />

            <form method="POST" action="{{ route('password.email') }}" class="space-y-6">
                @csrf

                <div>
                    <x-input-label for="email" :value="__('Email Address')" />
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-envelope text-gray-500 text-sm"></i>
                        </div>
                        <x-text-input id="email" class="block w-full pl-10" type="email" name="email" :value="old('email')" required autofocus />
                    </div>
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <div>
                    <button type="submit" class="w-full btn-primary py-3 text-base">
                        <i class="fas fa-paper-plane mr-2"></i>Send Reset Link
                    </button>
                </div>
            </form>

            <div class="mt-6 pt-6 border-t border-gray-800 text-center">
                <a href="{{ route('login') }}" class="text-sm text-yellow-600 hover:text-yellow-500 font-medium inline-flex items-center gap-2">
                    <i class="fas fa-arrow-left text-xs"></i>Back to Login
                </a>
            </div>
        </div>
    </div>
</x-guest-layout>
