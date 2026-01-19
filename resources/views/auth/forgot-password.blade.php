<x-guest-layout>
    <div class="mb-4 text-sm text-gray-600">
        {{ __('Lupa password Anda? Tidak masalah. Masukkan email Anda dan kami akan mengirimkan kode OTP 6 digit ke email Anda untuk mereset password.') }}
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a href="{{ route('login') }}" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                {{ __('Kembali ke Login') }}
            </a>

            <x-primary-button class="ms-3">
                {{ __('Kirim OTP') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
