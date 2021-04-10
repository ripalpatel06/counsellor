<div class="column col-sm-2 col-xs-1 sidebar-offcanvas" id="sidebar">
    <div class="menu-title hidden-xs">
        {{ trans('messages.dashboard') }}
    </div>

    <div class="list-group nav visible-xs" id="chevron">
        <a href="#" data-toggle="offcanvas" class="list-group-item visible-xs">
            <i class="fa fa-chevron-right fa-lg"></i>
        </a>
    </div>

    {{--Large Menu--}}
    <div class="list-group nav hidden-xs" id="lg-menu">
        <a href="{{ action('ProfileController@index') }}" class="list-group-item @if ($controller == 'profile') active @endif">
            <span class="menu-icon"><i class="fa fa-user fa-lg"></i></span>
            <span class="text">Profile</span>
        </a>

        <a href="{{ action('ListingController@index') }}" class="list-group-item @if ($controller == 'listing') active @endif">
            <span class="menu-icon"><i class="fa fa-flag fa-lg"></i></span>
            <span class="text">Listing</span>
        </a>
    </div>

    {{--Extra Small Menu--}}
    <div class="list-group nav visible-xs" id="xs-menu">
        <a href="{{ action('ProfileController@index') }}" class="list-group-item @if ($controller == 'profile') active @endif">
            <i class="fa fa-user"></i>
        </a>

        <a href="{{ action('ListingController@index') }}" class="list-group-item @if ($controller == 'listing') active @endif">
            <i class="fa fa-flag"></i>
        </a>
    </div>
</div>