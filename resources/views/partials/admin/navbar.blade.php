<nav role="navigation" class="navbar navbar-default navbar-static-top">
        <div class="container-fluid">
            <div class="navbar-header">
                <button class="navbar-toggle" type="button" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="{{ action('SearchController@index') }}">{{ trans('messages.applicationName') }}</a>
            </div>

            <div id="navbar" class="navbar-collapse collapse" aria-expanded="true">

               
            <ul class="nav navbar-nav navbar-right">
                    @if (Auth::guest())
                        <li><a href="{{ route('login') }}">Log In</a></li>
                        <li><a href="{{ route('register') }}">Register</a></li>
                    @else
                        <li class="active"><a href="{{ action('ProfileController@index') }}">My Account</a></li>
                        <li><a href="{{ route('logout') }}">Log Out</a></li>
                    @endif
                </ul>
            </div><!--/.nav-collapse -->
        </div><!--/.container -->
</nav>
