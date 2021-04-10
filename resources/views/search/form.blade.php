<script src="https://maps.googleapis.com/maps/api/js?libraries=places&key=ENTERYOURGOOGLEAPIKEY" type="text/javascript"
        xmlns="http://www.w3.org/1999/html"></script>
<script type="text/javascript">
    function initialize() {
        var options = {
            types: ['(regions)'],
            componentRestrictions: {country: "CA"}
        };
        var input = document.getElementById('location');
        new google.maps.places.Autocomplete(input, options);
    }

    $(function() {
        google.maps.event.addDomListener(window, 'load', initialize);

        $('#location').keydown(function (e) {
            if (e.which == 13 && $('.pac-container:visible').length) return false;
        });
    });
</script>

{!! Form::open(['id' => 'form']) !!}
 
    {!! Form::label('location', 'Your Location', ['size' => 'col-sm-6']) !!}

    {!! Form::text('location', null, ['placeholder' => 'City, Postal Code, or Region', 'class' => 'input-lg']) !!}



<fieldset id="search-criteria">
    <legend>Counsellor Traits (Optional)</legend>
    <div class="row">
        <div class="form-group col-md-3">
            <label class="control-label" for="specialty">Specialty</label>
            {!! Form::select('specialty', [
                    ''  => 'No Preference',
                    'M' => 'Marriage Counselling',
                    'G' => 'Grief Counselling',
                    'L' => 'Life Counselling',
            ], false, ['class' => 'input-sm']) !!}
        </div>

        <div class="form-group col-md-3">
            <label class="control-label" for="gender">Gender</label>
            {!! Form::select('gender', [
                    ''  => 'No Preference',
                    'M' => 'Male',
                    'F' => 'Female'
            ], false, ['class' => 'input-sm']) !!}
        </div>

        <div class="form-group col-md-3">
            <label class="control-label" for="denomination">Denomination</label>
            {!! Form::select(
                'denomination', ['' => 'No Preference'] + $denominations, false, ['class' => 'input-sm']) !!}
        </div>

        <div class="form-group col-md-3">
            <label class="control-label" for="other">Other</label>
            {!! Form::select('other', [
                ''  => 'No Preference',
                'B' => 'Made Up Label',
                'C' => 'Something Else',
                'P' => 'Another One'
            ], false, ['class' => 'input-sm']) !!}
        </div>
    </div>
</fieldset>

{!! Form::submit('Search', ['class'=>'btn btn-default']) !!}



    <a class="btn btn-default" href="{{ action('SearchController@index') }}" role="button">Reset</a>

{!!  HTML::script('vendor/jsvalidation/js/jsvalidation.js') !!}
{!! JsValidator::formRequest('App\Http\Requests\SearchListingRequest') !!}

{!! Form::close() !!}