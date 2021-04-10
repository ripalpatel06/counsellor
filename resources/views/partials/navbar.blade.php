<nav role="navigation" class="navbar navbar-default navbar-static-top">
    <div class="container">
        <div class="navbar-header navbar-left pull-left">
            <a class="navbar-brand" href="{{ action('SearchController@index') }}">{{ trans('messages.applicationName') }}</a>
        </div>
        <div class="navbar-header navbar-right pull-right">
            <button type="button" data-toggle="collapse" data-target=".navbar-collapse" class="navbar-toggle">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
        </div>
        <div class="visible-xs-block clearfix"></div>
        <div class="collapse navbar-collapse">
             <ul class="nav navbar-nav navbar-left">
                <li><a href="{{ action('SearchController@index') }}">Search</a></li>
                
            </ul>
            <ul class="nav navbar-nav navbar-right">
               
                @if (Auth::guest())
                <li><a href="{{ route('login') }}">Log In</a></li>
                <li><a href="{{ route('register') }}">Register</a></li>
                @else
                <li><a href="{{ action('ProfileController@index') }}">My Account</a></li>
                <li><a href="{{ route('logout') }}">Log Out</a></li>
                @endif
           
            </ul>
        </div>
    </div>
</nav>









