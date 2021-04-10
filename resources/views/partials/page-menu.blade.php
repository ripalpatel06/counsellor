<div class="grey-container">
    @if ($controller == 'profile' && $profile)
        <a href="{{ action('ProfileController@update') }}"
           class="shortcut-link @if ($action == 'update') active @endif">
                    <span class="shortcut-icon">
                        <i class="fa fa-pencil-square-o"></i>
                    </span>
            <span class="text">Update</span>
        </a>
    @endif

    @if ($controller == 'listing')

        <a href="{{ action('ListingController@update') }}"
           class="shortcut-link">
                    <span class="shortcut-icon">
                        <i class="fa fa-pencil-square-o"></i>
                    </span>
            <span class="text">Update</span>
        </a>

        @if (!$listing->location_verified)
            <a href="{{ action('ListingController@verifyLocation') }}"
               class="shortcut-link">
                    <span class="shortcut-icon">
                        <i class="fa fa-map-marker"></i>
                    </span>
                <span class="text">Verify Location</span>
            </a>
        @endif

    @endif
</div>