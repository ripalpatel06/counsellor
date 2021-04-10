@extends('layouts.app')

@section('content')
    <h1>{!! $listing->name !!}</h1>

    <div class="row">
        <div class="col-md-6">
            <dl class="dl-horizontal">
                <dt>First Name</dt>
                <dd>{!! $profile->first_name !!}</dd>

                <dt>Last Name</dt>
                <dd>{!! $profile->last_name !!}</dd>
            </dl>

            <dl class="dl-horizontal">
                <dt>{{ trans('messages.postalCode') }}</dt>
                <dd>{!! $listing->postal_code !!}</dd>

                <dt>Created At</dt>
                <dd>{{ $listing->created_at }}</dd>

                <dt>Updated At</dt>
                <dd>{{ $listing->updated_at }}</dd>
            </dl>
        </div>

        <div class="col-md-6">
            <div class="well well-sm">
                {!! Mapper::render() !!}
            </div>
        </div>
    </div>
@stop