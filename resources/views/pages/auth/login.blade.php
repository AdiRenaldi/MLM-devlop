@extends('pages.layouts.layoutMaster')

@section('title','Login')

@section('content')
<div class="bg-popup min-h-screen flex flex-col">
    <!-- Konten Halaman Login -->
    <div class="flex-grow flex items-center justify-center">
        <div class="bg-main shadow-lg shadow-main rounded-lg p-8 w-9/12 md:w-8/12 lg:w-6/12">
            <img src="{{ asset('images/icon/logo.png') }}" alt="Rafa" class="w-36 md:w-44 lg:w-60 mx-auto m-6 lg:mb-8">
            <form method="POST" action="{{ route('login-action') }}">
                @csrf
                <div class="px-8 md:px-14">
                    @if ($errors->any())
                    <div class="flex items-center px-4 py-2 mb-1 text-sm text-red-800 rounded-3xl bg-popup dark:bg-gray-800 dark:text-red-400" role="alert">
                        <svg class="flex-shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
                        </svg>
                        <span class="sr-only">Info</span>
                        <div>
                            {{ $errors->first() }}
                        </div>
                    </div>
                    @endif
                    <div class="mb-6 lg:mb-8">
                        <input 
                            type="email" 
                            name="email"
                            id="email" 
                            value="{{ old('email') }}"
                            placeholder="Email" 
                            class="text-main w-full lg:h-16 px-4 py-3 text-lg md:text-xl lg:text-2xl border border-gray-300 rounded-3xl focus:outline-none focus:ring-1 focus:ring-main focus:border-main placeholder-main"
                        >
                    </div>
                    <div class="mb-3">
                        <input 
                            type="password" 
                            name="password"
                            id="password" 
                            placeholder="Password" 
                            class="text-main w-full lg:h-16 px-4 py-3 text-lg md:text-xl lg:text-2xl border border-gray-300 rounded-3xl focus:outline-none focus:ring-1 focus:ring-main focus:border-main placeholder-main"
                        >
                    </div>
                    <div class="flex items-center mb-8">
                        <input id="disabled-checkbox" type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }} class="w-4 h-4 text-komplementer bg-gray-100 border-komplementer rounded focus:ring-komplementer dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                        <label for="disabled-checkbox" class="ms-2 text-sm font-medium text-white dark:text-gray-500"><small>Tetap masuk ke akun ini ?</small></label>
                    </div>
                    <button type="submit" class="bg-komplementer hover:bg-opacity-90 lg:h-16 text-white text-lg md:text-xl lg:text-2xl font-semibold py-3 px-12 rounded-3xl focus:outline-none focus:ring-1 focus:ring-komplementer mx-auto w-1/2 md:w-2/3 lg:w-1/2 flex items-center justify-center">
                        Login
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-main text-sm text-center py-3 text-white">
        <p>© 2024 PT. RAFAH SUKSES GEMILANG</p>
    </footer>
</div>

@endsection