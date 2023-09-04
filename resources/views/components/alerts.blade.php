@if ($errors->any())
    
<div class="alert alert-danger">
@foreach ($errors->all() as $error)


{{$error}}
<br>
@endforeach
</div>
@endif


@if (Session::has('CustomErr'))
<div class="alert alert-danger">
{{Session::ger('CustomErr')}}
</div>    

@endif


@if (Session::has('CustomSuccess'))
<div class="alert alert-success">
{{Session::get('CustomSuccess')}}
</div>    

@endif