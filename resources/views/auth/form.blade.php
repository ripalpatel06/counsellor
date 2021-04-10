
{!! Form::open('userName', 'User Name') !!}
{!! Form::text('userName', null, ['placeholder' => 'User Name or Email']) !!}
{!! Form::close() !!}

{!! Form::open('password', 'Password') !!}
{!! Form::password('password', ['placeholder' => 'Password']) !!}
{!! Form::close() !!}

{!! Form::submit($submitButtonText, ['class'=>'btn btn-default']) !!}

<script src="https://code.jquery.com/jquery-2.1.4.min.js"></script>
{!!  HTML::script('vendor/jsvalidation/js/jsvalidation.js') !!}
{!! JsValidator::formRequest('App\Http\Requests\SearchListingRequest') !!}