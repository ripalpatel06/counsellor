@extends('layouts.app')

@section('content')
    @include('errors.list')

    {!! Form::open(['action' => 'SearchController@search', 'method' => 'GET']) !!}
        @include('search.form-small', [
        'denominations' => $denominations
    ])
    {!! Form::close() !!}

    <hr>

    @if ($listings->count() > 0)
        <div class="row">
            <div class="col-md-4">
                @foreach ($listings as $listing)
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <a href="{{ action('SearchController@show', $listing->id) }}">
                                <strong>{{ $listing->name }}</strong>
                            </a>
                            <br>
                            <small>({{ $listing->distance }}km)</small>
                        </div>

                        <div class="panel-body">
                            <address>
                                {{ $listing->user->profile->fullName }}
                            </address>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="col-md-8">
                <div class="well well-sm">
                    {!! Mapper::render() !!}
                </div>
            </div>
        </div>
    @else
        <p><i class="fa fa-search fa-2x"></i> We could not find any councellors given your search criteria. Please change your search and try again.</p>
    @endif
@stop