@if ($errors->any())
    <div class="alert alert-danger text-center">
        @foreach ($errors->all() as $error)
            {{$error}}
            <br>
        @endforeach
    </div>
@endif


@if (Session::has('CustomErr'))
<div class="alert alert-danger text-center">
{{Session::get('CustomErr')}}
</div>    

@endif


@if (Session::has('CustomSuccess'))
<div class="alert alert-success text-center">
{{Session::get('CustomSuccess')}}
</div>    

@endif