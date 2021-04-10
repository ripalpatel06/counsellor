<div class="row">
    <div class="col-md-6">
        @include('errors.list')

        {!! Form::model($model, ['action' => 'UserController@store']) !!}
        {!! Form::open() !!}

        {!! Form::label('first_name', 'First Name', ['size' => 'col-sm-6']) !!}
        {!! Form::text('first_name', null, ['placeholder' => 'First Name']) !!}

        {!! Form::label('last_name', 'Last Name', ['size' => 'col-sm-6']) !!}
        {!! Form::text('last_name', null, ['placeholder' => 'Last Name']) !!}

        {!! Form::label('email', 'Email', ['size' => 'col-sm-6']) !!}
        {!! Form::text('email', null, ['placeholder' => 'Email']) !!}

        {!! Form::submit('Save Profile', ['class'=>'btn btn-default']) !!}

        {!! Form::close() !!}

        {!! JsValidator::formRequest('App\Http\Requests\CreatePersonalInformationRequest') !!}
    </div>
</div>