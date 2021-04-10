@if (!Auth::guest())
    {!!  HTML::script('js/session-timeout.js') !!}

    
@endif