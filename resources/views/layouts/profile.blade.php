<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ trans('messages.applicationName') }} - {{ trans('messages.pageTitle') }}</title>
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    {!!  HTML::style('css/admin.css') !!}
    {!!  HTML::style('css/common.css') !!}

    {!!  HTML::style('css/bootstrap-social.css') !!}
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
</head>

<body>

{!!  HTML::script('https://code.jquery.com/jquery-2.1.4.min.js') !!}
{!!  HTML::script('//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js') !!}
{!!  HTML::script('vendor/jsvalidation/js/jsvalidation.js') !!}
{!!  HTML::script('js/jquery.cookie.js') !!}

<div class="wrapper">
    <div class="box">
        <div class="row row-offcanvas row-offcanvas-left">

            @include('partials.menu')

            <div class="column col-sm-10 col-xs-11" id="main">

                @include('partials.admin.navbar')

                    <div class="full">

                        <div class="row">
                            <div class="col-md-12">
                                <h1>{{ trans('messages.pageTitle') }}</h1>
                            </div>
                        </div>

                        @include('partials.page-menu')
                        @include('partials.message')

                        @yield('content')
                </div>
            </div>
        </div>

        @include('partials.modal.modal')
        @include('partials.timeout')
    </div>
</div>
</body>

<script>
    $('[data-toggle=offcanvas]').click(function() {
        $(this).toggleClass('visible-xs');
        $(this).find('i').toggleClass('fa fa-chevron-right fa fa-chevron-left');
        $('.row-offcanvas').toggleClass('active');
        $('#lg-menu').toggleClass('hidden-xs').toggleClass('visible-xs');
        $('#xs-menu').toggleClass('visible-xs').toggleClass('hidden-xs');
        $('#btnShow').toggle();
    });
</script>

</html>