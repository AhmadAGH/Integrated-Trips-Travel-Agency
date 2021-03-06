@if ($errors->any())
      <div class="alert alert-danger text-center">
        <ul>
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
        </ul>
      </div><br />
@endif

@if (session('success'))
    <div class="alert alert-success text-center">    
        {{session('success')}}
    </div>  
@endif

@if (session('error'))
    <div class="alert alert-danger text-center">    
        {{session('error')}}
    </div>  
@endif