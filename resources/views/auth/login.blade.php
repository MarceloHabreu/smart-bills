<x-guest-layout>
    <div class="w-full max-w-5xl mx-auto bg-white shadow-lg rounded-lg flex overflow-hidden max-h-[80vh]">
        <!-- Left side with text -->
        <div class="w-1/2 p-8 flex flex-col justify-center">
            <h2 class="text-3xl font-bold text-gray-900 text-center">BEM VINDO DE VOLTA</h2>
            <p class="mt-2 text-lg text-gray-600 text-center">Por favor, insira seus dados</p>

            <!-- Login form -->
            <form method="POST" action="{{ route('login') }}" class="flex flex-col gap-4 mt-8">
                @csrf

                <!-- Email Address -->
                <div>
                    <x-input-label for="email" :value="__('Email')" />
                    <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" placeholder="Digite seu email" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- Password -->
                <div class="mt-4">
                    <x-input-label for="password" :value="__('Password')" />
                    <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" placeholder="*********" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <!-- Remember Me -->
                <div class="block mt-4">
                    <label for="remember_me" class="inline-flex items-center">
                        <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                        <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                    </label>
                </div>

                <!-- Forgot Password and Login Button -->
                <div class="flex items-center justify-between mt-4">
                    @if (Route::has('password.request'))
                        <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('password.request') }}">
                            {{ __('Forgot your password?') }}
                        </a>
                    @endif
                    <x-primary-button class="w-full flex justify-center items-center" style="background-color: #3EA55B;">
                        {{ __('Log in') }}
                    </x-primary-button>
                </div>

                <!-- Additional Links -->
                <div class="mt-4 text-center">
                    <a href="{{ route('register') }}" class="underline text-sm hover:text-gray-900" style="color: #3EA55B;">
                        {{ __('Não tem uma conta? Cadastre-se') }}
                    </a>
                </div>
            </form>
        </div>

        <!-- Right side with logo -->
        <div class="w-1/2">
            <img src="{{ asset('assets/logo-smartbills/SmartBills/logoLogin.png') }}" alt="SmartBills Logo" class="w-full h-full object-cover">
        </div>
    </div>
</x-guest-layout>
