@extends('layouts.app')

@section('content')
<x-guest-layout>
    <!--<x-jet-authentication-card>-->
        <x-slot name="logo">
            <x-jet-authentication-card-logo />
        </x-slot>

        <x-jet-validation-errors class="mb-4" />
        <div class="panel panel-default">
        <div class="panel-heading">Register</div>
        <div class="panel-body border-between">
            <div class="col-md-4">
                <h2>One Click Registration</h2>

                <a href="{{ url('auth/google') }}" class="btn btn-block btn-social btn-google">
                    <span class="fa fa-google-plus"></span>Register with Google
                </a>
            </div>
        <div class="col-md-8 border-left">
        <form method="POST" action="{{ route('register') }}">
            @csrf
            <div>
                <x-jet-label for="name" value="{{ __('First Name') }}" />
                <x-jet-input id="name" class="block mt-1 w-full" type="text" name="fname" :value="old('fname')" required autofocus autocomplete="First name" />
            </div>

            <div>
                <x-jet-label for="name" value="{{ __('Last Name') }}" />
                <x-jet-input id="name" class="block mt-1 w-full" type="text" name="lname" :value="old('lname')" required autofocus autocomplete="Last name" />
            </div>

            <div class="mt-4">
                <x-jet-label for="email" value="{{ __('Email Address') }}" />
                <x-jet-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
            </div>

            <div class="mt-4">
                <x-jet-label for="password" value="{{ __('Password') }}" />
                <x-jet-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
            </div>

            <div class="mt-4">
                <x-jet-label for="password_confirmation" value="{{ __('Confirm Password') }}" />
                <x-jet-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
            </div>

            @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                <div class="mt-4">
                    <x-jet-label for="terms">
                        <div class="flex items-center">
                            <x-jet-checkbox name="terms" id="terms"/>

                            <div class="ml-2">
                                {!! __('I agree to the :terms_of_service and :privacy_policy', [
                                        'terms_of_service' => '<a target="_blank" href="'.route('terms.show').'" class="underline text-sm text-gray-600 hover:text-gray-900">'.__('Terms of Service').'</a>',
                                        'privacy_policy' => '<a target="_blank" href="'.route('policy.show').'" class="underline text-sm text-gray-600 hover:text-gray-900">'.__('Privacy Policy').'</a>',
                                ]) !!}
                            </div>
                        </div>
                    </x-jet-label>
                </div>
            @endif

            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>

                <x-jet-button class="ml-4">
                    {{ __('Register') }}
                </x-jet-button>
            </div>
        </form>
    </div>
</div>
</div>
<!--</x-jet-authentication-card>-->
</x-guest-layout>
@endsection