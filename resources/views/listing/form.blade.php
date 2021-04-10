@include('errors.list')

 <form method="post" action="{{ url('listing/store') }}">
 	<div class="form-group col-sm-6">
              @csrf
         <label for="name">name:</label>
         <input type="text" class="form-control" name="name" value="{{ $listing->name }}"/>
     </div>
    <div class="form-group col-sm-6">
        <label for="cases">postal_code :</label>
        <input type="text" class="form-control" name="postal_code" value="{{ $listing->postal_code }}"/>
    </div>
          
<div class="form-group row">
 <div class="col-sm-1">
   <button type="submit" class="btn btn-default">Save Listing</button>
</div>
</div>
</form>
{!! JsValidator::formRequest('App\Http\Requests\CreateListingRequest') !!}