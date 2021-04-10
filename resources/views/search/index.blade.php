@extends('layouts.app')

@section('content')
    @include('errors.list')

   <!--Added by Ripal---->
   {{ Form::open(array('action' => 'SearchController@search','method' => 'GET')) }}
   
    <!-- {!! Form::open(['action' => 'SearchController@search', 'method' => 'GET']) !!} -->
        @include('search.form', [
            'denominations' => $denominations,
            'displayReset' => $displayReset
        ])
    {!! Form::close() !!}
@stop