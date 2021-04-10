@extends('layouts.profile')

@section('content')
    @include('profile.form', [
            'denominations' => $denominations
        ])
@stop