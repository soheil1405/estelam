<!DOCTYPE html>
<html dir="rtl" lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>

    <title> استعلام مدرک تحصیلی  </title>
    @yield('headers')
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="{{ asset('/asset/main/css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('/asset/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('/asset/bootstrap/js/bootstrap.min.js') }}" rel="stylesheet">
    <link href="{{ asset('/asset/bootstrap/js/bootstrap.bundle.min.js') }}" rel="stylesheet">
    <link href="{{ asset('/asset/main/css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('/asset/main/css/responsive.css') }}" rel="stylesheet">


    <script src="{{ asset('/asset/jquery.js') }}"></script>
    @include('sweetalert::alert')
 
    

   </head>


<body class="antialiased">
    <div class="container-fluid p-0 "  style="background: url('/asset/images/header-min.png')">
        <div class="container-fluid bg-admin" style="  ">
                <div class="container">
                    <div class="row">
                    
                        
                        <h6 class="text-center pt-3" style="color: white">سامانه استعلام مدرک تحصیلی فلان</h6>
    
    
                            
    
    
                            
                        
                            
                    </div>
    
                </div>
            </div>
                
    
        </div>
    
        <x-alerts />
    
        <div class="main">

            @yield('content')
        </div>
        <div  class="noscript text-center">
            
            <strong>
                
                <h1 class="">
                    ...please turn on javascript to continue        
                </h1>

                <a  class="btn btn-success " href="{{route('home')}}">ok</a>
            </strong>
        </div>
    </div>

</body>


<script src="{{ asset('/asset/jquery.js') }}"></script>
<noscript>
  
<script>
    
    $('.main').css('display' , 'none');

    alert('please turn on javascript');

</script>
</noscript>
@include('sweetalert::alert', ['cdn' => "https://cdn.jsdelivr.net/npm/sweetalert2@9"])

</html>
