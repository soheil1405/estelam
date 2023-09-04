<!DOCTYPE html>
<html lang="en">

<head>


    @yield('headers')

    @include('sweetalert::alert')

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    {{-- <!-- <script src="{{ asset('/asset/jquery.js') }}"></script>
    <link href="{{ asset('/asset/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('/asset/bootstrap/js/bootstrap.bundle.min.js') }}" rel="stylesheet">
    --> --}}
    <link rel="stylesheet" href="{{ asset('asset/datepicker/datepicker.css') }}">
      
    
    <link href="{{ asset('/asset/main/css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('/asset/main/css/responsive.css') }}" rel="stylesheet">


    
    @include('admin.style.scripts')


    <title>bet Math | @yield('title')</title>
</head>
<style>

  
.navbar-nav{
    float:right !important;
}
</style>
<body dir="rtl">

<nav class="navbar navbar-inverse  ">
  <div class="container-fluid">
    <div class="navbar-header ">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
     
    </div>
    <div class="collapse navbar-collapse  " id="myNavbar">
      <ul class="nav navbar-nav justify-content-center ">
        
           
           
           <li ><a href="{{ route('home') }}">صفحه اصلی</a></li> 
       
           <li>

            <a href="{{route('adminn.results.index')}}">
              همه
            </a>

           </li>

           <li ><a href="{{ route('logout') }}">خروج</a></li>
       
    </ul>
  </div>
  </div>
</nav>

            
                
<x-alerts />
@yield('content')

</body>

</html>



<script src="{{ asset('asset/datepicker/persiandate.js') }}"></script>
<script src="{{ asset('asset/datepicker/datepicker.js') }}"></script>
<script type="text/javascript">
    $(document).ready(function() {

        $(".example1").pDatepicker({
            autoClose: true,
            onSelect: function(unix) {
                // console.log('datepicker select : ' + unix);
                var day = new persianDate(unix).toDate();
                // console.log('day :' + day);



                var standard = new Date(day).toISOString();


                
                $('#date').val(standard);
                
                console.log( $('#date').val());

            }
        });

        //     $(".example2").pDatepicker({
        //         autoClose: true,
        //         onSelect: function(unix) {
        //             // console.log('datepicker select : ' + unix);
        //             var day = new persianDate(unix).toDate();
        //             // console.log('day :' + day);
        //             var standard =  new Date(day).toISOString();


        //    $('#fromDate').val(standard);
        //         }
        //     });

    });
</script>


