@if($errors->any())
    <div class="alert alert-warning">
        @foreach($errors->all() as $error)
            <p>{{$error}}</p>
        @endforeach
    </div>
@endif

@if(session('session'))
    <div class="alert alert-success">
        {{session('success')}}
    </div>
@endif

@if(session('session'))
    <div class="alert alert-danger">
        {{session('error')}}
    </div>
@endif
