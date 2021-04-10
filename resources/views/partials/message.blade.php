
@if (Session::has('success'))
    <div class="alert alert-success" role="alert">
        <p>{{ Session::get('success') }}</p>
    </div>
@endif

@if (Session::has('warning'))
    <div class="alert alert-danger" role="alert">
        <p>{{ Session::get('warning') }}</p>
    </div>
@endif