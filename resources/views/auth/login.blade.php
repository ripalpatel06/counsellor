@extends('layouts.app')

@section('content')

<x-guest-layout>
    
        <x-slot name="logo">
            
        </x-slot>

        <x-jet-validation-errors class="mb-4" />

        @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ session('status') }}
            </div>
        @endif
        <div class="panel panel-default">
        <div class="panel-heading">Login</div>
        <div class="panel-body border-between">
            
        <div class="col-md-3">
                <h2>One Click Log In</h2>

                <a href="{{ action('Auth\AuthController@getSocialLogin') }}" class="btn btn-block btn-social btn-google">
                    <span class="fa fa-google-plus"></span>Log In with Google
                </a>
            </div>

            <div class="col-md-6 border-left">
        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div "mt-4">
                <x-jet-label for="email" value="{{ __('Email') }}" />
                <x-jet-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            </div>

            <div class="mt-4">
                <x-jet-label for="password" value="{{ __('Password') }}" />
                <x-jet-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" />
            </div>

            <div class="flex items-center justify-end mt-4">

                <x-jet-button class="ml-4">
                    {{ __('Log in') }}
                </x-jet-button>
            </div>
        </form>
    </div>
</div>
</div>
</x-guest-layout>
@endsection