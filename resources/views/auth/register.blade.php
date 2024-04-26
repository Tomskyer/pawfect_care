<x-app-layout>
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">
        @if($role == 1)
        <h1 class="text-3xl items-center text-semibold">Owner Registration</h1>
        @else
        <h1 class="text-3xl flex flex-col items-center text-semibold">Carer Registration</h1>
        @endif
        <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
            <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
                @csrf

                <!-- Picture -->
                <!-- <x-picture-input /> -->

                <!-- Name -->
                <div class="mt-4">
                    <x-input-label for="name" :value="__('Name')" />
                    <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>

                <!-- Email Address -->
                <div class="mt-4">
                    <x-input-label for="email" :value="__('Email')" />
                    <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- Postcode -->
                <div class="mt-4">
                    <x-input-label for="postcode" :value="__('Postcode')" />

                    <x-text-input id="postcode" class="block mt-1 w-full" type="text" name="postcode" required />

                    <x-input-error :messages="$errors->get('postcode')" class="mt-2" />
                </div>

                <!-- Role -->
                <!-- <div class="flex flex-row mt-4">
                    <input type="radio" id="age1" name="age" value="30" default>
                    <label for="age1">0 - 30</label><br>
                    <input type="radio" id="age2" name="age" value="60">
                    <label for="age2">31 - 60</label><br>
                    <input type="radio" id="age3" name="age" value="100">
                    <label for="age3">61 - 100</label><br><br>
                </div> -->

                <input name="role" value="{{ $role }}" hidden />

                <!-- Password -->
                <div class="mt-4">
                    <x-input-label for="password" :value="__('Password')" />

                    <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />

                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <!-- Confirm Password -->
                <div class="mt-4">
                    <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

                    <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />

                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                </div>

                <div class="flex items-center justify-end mt-4">
                    <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                        {{ __('Already registered?') }}
                    </a>

                    <x-primary-button class="ms-4">
                        {{ __('Register') }}
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>