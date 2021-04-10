    @include('errors.list')

     <form method="POST" action="{{ url('profile/store') }}">
      @csrf

    <div class="form-group col-sm-8">
         <label for="first_name">First Name</label>
         <input type="text" class="form-control" name="first_name" value="{{ $profiledata[0]['first_name'] }}"/>
    </div>
    <div class="form-group col-sm-8">
         <label for="last_name">Last Name</label>
         <input type="text" class="form-control" name="last_name" value="{{ $profiledata[0]['last_name'] }}"/>
    </div>
    <div class="form-group col-sm-8">
         <label for="Gender">Gender</label>
                <br/>
                <input id="gender" type="radio" name="gender" value="" {{ ($profiledata[0]['gender'] =='')? "checked" : '' }}   required /> Unspecified
                <br/>
                <input id="gender" type="radio" name="gender" value="M" {{ ($profiledata[0]['gender'] =='M')? "checked" : '' }} required /> Male
                <br/>
                <input id="gender" type="radio" name="gender" value="F" {{ ($profiledata[0]['gender'] =='F')? "checked" : '' }} required /> Female
    </div>
    <div class="form-group col-sm-8">
         <label for="denomination">Denomnation</label>
         <select id="denomination" name="denomination"  class="form-control">
            @foreach ($denominations as $key => $denomination)
             @if($profiledata[0]['denomination_id'] == $key)
               <option value="{{ $key }}" selected="selected">{{ $denomination }}</option>
             @else
              <option value="{{ $key }}">{{ $denomination }}</option>
             @endif
                
            @endforeach
         </select>
    </div>
      
    <div class="form-group col-sm-8">
    
        <button type="submit" class="btn btn-default">Save Profile</button>
    
    </div>
</form>
 