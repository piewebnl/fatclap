@extends('layouts.app')

@section('content')
<main class="sm:container sm:mx-auto sm:max-w-960 sm:mt-10">
    @if (session('status') == 'verification-link-sent')
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
            <span class="block sm:inline">{{ __('A new verification link has been sent to the email address you provided during registration.') }}</span>
        </div>
    @endif
    <div class="flex">
        <div class="w-full">
            <section class="flex flex-col break-words bg-white sm:border-1 sm:rounded-md sm:shadow-sm sm:shadow-lg p-6">
                <label class="block text-gray-700 text-sm font-bold mb-2 sm:mb-4">{{ __('Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.') }}</label>

                <form class="w-full px-6 space-y-6 sm:px-10 sm:space-y-8" method="POST" action="{{ route('verification.send') }}">
                    @csrf

                    <button type="submit">
                        {{ __('Resend Verification Email') }}
                    </button>
                </form>

                <form class="w-full px-6 space-y-6 sm:px-10 sm:space-y-8" method="POST" action="{{ route('logout') }}">
                    @csrf

                    <button type="submit">
                        {{ __('Logout') }}
                    </button>
                </form>
    <section>
    </div>
</div>

</main>
@endsection
