@extends('layouts.profile')

@section('content')
   <div class="row">
        <div class="col-md-9">

            <dl class="dl-horizontal">
                <dt>Name</dt>
                <dd>{!! $listing->name !!}</dd>

                <dt>Postal Code</dt>
                <dd>{!! $listing->postal_code !!}</dd>

                <dt>Location Verified</dt>
                <dd>
                   @if ($listing->location_verified)
                       <span class="label label-success">Verified</span> @else
                   <span class="label label-info">Unverified</span>
                   @endif
                </dd>

                <dt>Published</dt>
                <dd>
                   @if ($listing->published)
                       <span class="label label-success">Published</span>
                   @else
                       <span class="label label-info">Unpublished</span>
                   @endif
                </dd>

                <dt>Created At</dt>
                <dd>{{ $listing->created_at }}</dd>

                <dt>Updated At</dt>
                <dd>{{ $listing->updated_at }}</dd>
            </dl>
        </div>

        <div class="col-md-3">
            @if (!$listing->location_verified) <a href="{{ action('ListingController@verifyLocation') }}"> @endif
                <div class="splash @if ($listing->location_verified) bg-success @else bg-danger @endif">
                    <span class="title">Location Status</span>

                    <br>

                    <small>
                        @if ($listing->location_verified)
                            Verified
                        @else
                            Unverified
                        @endif
                    </small>
                    <div class="stat-icon">
                        <i class="fa fa-map-marker fa-2x"></i>
                    </div>
                </div>
                @if (!$listing->location_verified) </a> @endif

            <div class="splash bg-info">
                <span class="title">Avg. Inquiry Distance</span>

                <br>

                <small>11.5km</small>

                <div class="stat-icon">
                    <i class="fa fa-compass fa-2x"></i>
                </div>
            </div>

            <div class="splash bg-warning">
                <span class="title">Listing Views</span>

                <br>

                <small>{{ $listing->views }}</small>

                <div class="stat-icon">
                    <i class="fa fa-eye fa-2x"></i>
                </div>
            </div>
        </div>
    </div>
@stop