<x-guest-layout>
    <div class="w-full max-w-5xl mx-auto bg-white shadow-lg rounded-lg flex overflow-hidden max-h-[80vh]">
        <!-- Left side with logo -->
        <div class="w-1/2">
            <img src="{{ asset('assets/logo-smartbills/SmartBills/logoLogin.png') }}" alt="SmartBills Logo" class="w-full h-full object-cover">
        </div>

        <!-- Right side with the registration form and texts -->
        <div class="w-1/2 p-8 flex flex-col justify-between overflow-y-auto">

            <!-- Registration form -->
            <form method="POST" action="{{ route('register') }}" class="flex flex-col gap-4">
                @csrf

                <!-- Name -->
                <div>
                    <x-input-label for="name" :value="__('Name')" />
                    <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" placeholder="digite seu nome" />
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>

                <!-- Email Address -->
                <div>
                    <x-input-label for="email" :value="__('Email')" />
                    <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" placeholder="digite seu email" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- Password -->
                <div>
                    <x-input-label for="password" :value="__('Password')" />
                    <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" placeholder="*********" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <!-- Confirm Password -->
                <div>
                    <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
                    <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" placeholder="*********" />
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                </div>

                <!-- Register Button -->
                <div class="mt-6">
                    <x-primary-button class="w-full flex justify-center items-center" style="background-color: #3EA55B;">
                        {{ __('Register') }}
                    </x-primary-button>
                </div>

                <!-- Already registered -->
                <div class="mt-4 text-center">
                    <a href="{{ route('login') }}" class="underline text-sm hover:text-gray-900" style="color: #3EA55B;">
                        {{ __('Já tem uma conta? Entrar!') }}
                    </a>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>
