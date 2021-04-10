<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{!! trans('messages.applicationName') !!} - {!! trans('messages.pageTitle') !!}</title>
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    {!!  HTML::style('css/front-end.css') !!}
    {!!  HTML::style('css/common.css') !!}

    {!!  HTML::style('css/bootstrap-social.css') !!}
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
     
    
</head>
<body>
    {!!  HTML::script('https://code.jquery.com/jquery-2.1.4.min.js') !!}
    {!!  HTML::script('//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js') !!}
    {!!  HTML::script('vendor/jsvalidation/js/jsvalidation.js') !!}
    {!!  HTML::script('js/jquery.cookie.js') !!}


    <div id="content">
        @include('partials.navbar')
        <div class="container">

           

            @include('partials/message')
            @yield('content')
            @include('partials.modal.modal')
            @include('partials.timeout')
        </div>

        @include('partials.footer')
    </div>
</body>
</html>