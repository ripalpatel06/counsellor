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

<div class="row">
    <div class="form-group col-md-4">
        <label class="control-label" for="location">Your Location</label>
        {!! Form::text('location', null, ['id'=>'location', 'placeholder' => 'City, Postal Code, or Region', 'class' => 'input-sm']) !!}
    </div>

    <div class="form-group col-md-2">
        <label class="control-label" for="specialty">Specialty</label>
        {!! Form::select('specialty', [
                ''  => 'No Preference',
                'M' => 'Marriage Counselling',
                'G' => 'Grief Counselling',
                'L' => 'Life Counselling',
        ], false, ['class' => 'input-sm']) !!}
    </div>

    <div class="form-group col-md-2">
        <label class="control-label" for="gender">Gender</label>
        {!! Form::select('gender', [
                ''  => 'No Preference',
                'M' => 'Male',
                'F' => 'Female'
        ], false, ['class' => 'input-sm']) !!}
    </div>

    <div class="form-group col-md-2">
        <label class="control-label" for="denomination">
            Denomination
        </label>

        {!! Form::select('denomination', ['' => 'No Preference'] + $denominations,
            false,
            ['class' => 'input-sm'])
        !!}
    </div>

    <div class="form-group col-md-2">
        <label class="control-label" for="other">Other</label>
        {!! Form::select('other', [
            ''  => 'No Preference',
            'B' => 'Made Up Label',
            'C' => 'Something Else',
            'P' => 'Another One'
        ], false, ['class' => 'input-sm']) !!}
    </div>
</div>

{!! Form::submit('Search', ['class'=>'btn btn-default']) !!}

{!!  HTML::script('vendor/jsvalidation/js/jsvalidation.js') !!}
{!! JsValidator::formRequest('App\Http\Requests\SearchListingRequest') !!}