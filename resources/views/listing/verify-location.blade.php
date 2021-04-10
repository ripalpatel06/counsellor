@extends('layouts.profile')

@section('content')
    <div class="col-md-7">
        <p>
            Please verify the details of your listing including name, postal code, and approximate map marker placement.
            You can modify your listing at any time by visiting
            <a href="{{ action('ListingController@index') }}">My Listing</a>.
        </p>

        <dl class="dl-horizontal">
            <dt>Name</dt>
            <dd>{!! $listing->name !!}</dd>

            <dt>Postal Code</dt>
            <dd>{!! $listing->postal_code !!}</dd>

            <dt></dt>
            <dd>
                {!! Form::model($listing, ['action' => 'ListingController@postVerifyLocation']) !!}

                {!! Form::checkbox('locationVerification', true, 'I confirm the information is correct') !!}

                {!! Form::submit('Submit Verification', ['class'=>'btn btn-default']) !!}

                {!! Form::close() !!}

                {!! JsValidator::formRequest('App\Http\Requests\VerifyLocationRequest') !!}
            </dd>
        </dl>
    </div>

    <div class="col-md-5">
        <div class="well well-sm">
            {!! Mapper::render() !!}
        </div>
    </div>
@stop