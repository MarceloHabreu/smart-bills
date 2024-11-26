<x-guest-layout>
    <!-- Main container with flexbox layout -->
    <div class="flex justify-center items-center min-h-screen bg-gray-100">

        <!-- Card container -->
        <div class="w-full max-w-md bg-white p-8 rounded-lg shadow-lg">

            <!-- Logo at the top -->
            <div class="text-center mb-2">
                <img src="{{ asset('assets/logo-smartbills/SmartBills/default_transparent_765x625.png') }}" alt="SmartBills Logo" class="w-full h-full object-cover">
            </div>

            <!-- Information about password reset -->
            <div class="mb-4 text-sm text-gray-600 text-center">
                {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
            </div>

            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />

            <!-- Password reset form -->
            <form method="POST" action="{{ route('password.email') }}" class="w-full">
                @csrf

                <!-- Email Address -->
                <div>
                    <x-input-label for="email" :value="__('Email')" />
                    <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus placeholder="Digite seu email" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- Reset button -->
                <div class="flex items-center justify-center mt-6">
                    <x-primary-button class="w-full" style="background-color: #3EA55B;">
                        {{ __('Email Password Reset Link') }}
                    </x-primary-button>
                </div>

                <!-- Link to return to login -->
                <div class="mt-4 text-center">
                    <a href="{{ route('login') }}" class="underline text-sm text-gray-600 hover:text-gray-900">
                        {{ __('Voltar Para o login') }}
                    </a>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>
