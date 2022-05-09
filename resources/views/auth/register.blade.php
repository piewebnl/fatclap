@extends('layouts.app')

@section('content')
<main class="sm:container sm:mx-auto sm:max-w-960 sm:mt-10">
    <div class="flex">
        <div class="w-full">
            <section class="flex flex-col break-words bg-white sm:border-1 sm:rounded-md sm:shadow-sm sm:shadow-lg">

                <header class="font-semibold bg-gray-200 text-gray-700 py-5 px-6 sm:py-6 sm:px-8 sm:rounded-t-md">
                    {{ __('Register') }}
                </header>

                <form class="w-full px-6 space-y-6 sm:px-10 sm:space-y-8" method="POST" action="{{ route('register') }}">
                    @csrf

                    <div class="flex flex-wrap">
                        <label for="name" class="block text-gray-700 text-sm font-bold mb-2 sm:mb-4">
                            {{ __('Name') }}:
                        </label>

                        <input id="name" type="text" class="form-input w-full @error('name')  border-red-500 @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                        @error('name')
                        <p class="text-red-500 text-xs italic mt-4">
                            {{ $message }}
                        </p>
                        @enderror
                    </div>

                    <div class="flex flex-wrap">
                        <label for="email" class="block text-gray-700 text-sm font-bold mb-2 sm:mb-4">
                            {{ __('E-Mail Address') }}:
                        </label>

                        <input id="email" type="email" class="form-input w-full @error('email') border-red-500 @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                        @error('email')
                        <p class="text-red-500 text-xs italic mt-4">
                            {{ $message }}
                        </p>
                        @enderror
                    </div>

                    <div class="flex flex-wrap items-center">
                        <h3>Set the daily nutrition limits here:</h3>
                        <p class="mt-1">Keep values at '0' for no limit</p>
                    </div>

                    <div class="flex flex-wrap">
                        <label for="calories" class="block text-gray-700 text-sm font-bold mb-2 sm:mb-4">
                            {{ __('Calories') }}:
                        </label>

                        <input id="calories" type="calories" class="form-input w-full @error('calories') border-red-500 @enderror" name="calories" value="{{ old('calories') }}" required autocomplete="new-calories">

                        @error('calories')
                        <p class="text-red-500 text-xs italic mt-4">
                            {{ $message }}
                        </p>
                        @enderror
                    </div>

                    <div class="flex flex-wrap">
                        <label for="carbs" class="block text-gray-700 text-sm font-bold mb-2 sm:mb-4">
                            {{ __('Carbs') }}:
                        </label>

                        <input id="carbs" type="carbs" class="form-input w-full @error('carbs') border-red-500 @enderror" name="carbs" value="{{ old('carbs') }}" required autocomplete="new-carbs">

                        @error('carbs')
                        <p class="text-red-500 text-xs italic mt-4">
                            {{ $message }}
                        </p>
                        @enderror
                    </div>


                    <div class="flex flex-wrap">
                        <label for="fats" class="block text-gray-700 text-sm font-bold mb-2 sm:mb-4">
                            {{ __('Fats') }}:
                        </label>

                        <input id="fats" type="fats" class="form-input w-full @error('carbs') border-red-500 @enderror" name="fats" value="{{ old('fats') }}" required autocomplete="new-fats">

                        @error('fats')
                        <p class="text-red-500 text-xs italic mt-4">
                            {{ $message }}
                        </p>
                        @enderror
                    </div>


                    <div class="flex flex-wrap">
                        <label for="proteins" class="block text-gray-700 text-sm font-bold mb-2 sm:mb-4">
                            {{ __('Proteins') }}:
                        </label>

                        <input id="proteins" type="proteins" class="form-input w-full @error('proteins') border-red-500 @enderror" name="proteins" value="{{ old('proteins') }}" required autocomplete="new-proteins">

                        @error('proteins')
                        <p class="text-red-500 text-xs italic mt-4">
                            {{ $message }}
                        </p>
                        @enderror
                    </div>

                    <div class="flex flex-wrap">
                        <label for="password" class="block text-gray-700 text-sm font-bold mb-2 sm:mb-4">
                            {{ __('Password') }}:
                        </label>

                        <input id="password" type="password" class="form-input w-full @error('password') border-red-500 @enderror" name="password" required autocomplete="new-password">

                        @error('password')
                        <p class="text-red-500 text-xs italic mt-4">
                            {{ $message }}
                        </p>
                        @enderror
                    </div>

                    <div class="flex flex-wrap">
                        <label for="password-confirm" class="block text-gray-700 text-sm font-bold mb-2 sm:mb-4">
                            {{ __('Confirm Password') }}:
                        </label>

                        <input id="password-confirm" type="password" class="form-input w-full" name="password_confirmation" required autocomplete="new-password">
                    </div>

                    <div class="flex flex-wrap">
                        <button type="submit">
                            {{ __('Register') }}
                        </button>

                        <p class="w-full text-xs text-center text-gray-700 my-6 sm:text-sm sm:my-8">
                            {{ __('Already have an account?') }}
                            <a class="text-blue-500 hover:text-blue-700 no-underline hover:underline" href="{{ route('login') }}">
                                {{ __('Login') }}
                            </a>
                        </p>
                    </div>
                </form>

            </section>
        </div>
    </div>
</main>
@endsection