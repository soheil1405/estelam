@extends('home.master')



<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<style>
    .warning{
        border: 1px solid red !important;
    }
    .success{
        border: 1px solid rgb(20, 218, 20) !important;
    }
</style>

@section('content')
    
    <div class="row mt-3">
        <div class="col-12">
            <div class="col-xs-12 col-md-10 col-md-push-1 col-lg-8 col-lg-push-2">
                <ul class="tabs">
                    <li class="tab col s4 step1 admin2color "><a  href="{{route('home')}}"  >ورود اطلاعات</a></li>
                    <li class="tab col s4 disabled  step2"><a style="cursor: pointer;"  >وارد کردن کد رهگیری ارسال شده </a></li>
                    <li class="tab col s4   step3 "> <a  class="active" href="{{getSighnedRouteFromSession()}}"  style="cursor: pointer;" >نمایش مدرک تحصیلی</a></li>
                </ul>
            </div>
        </div>
        
    
        <div id="s1" >
            
            <div class=" col-md-10 col-md-push-1 col-lg-8 col-lg-push-2">

                <div class="box box-cme st1 p-5 " >


                    @foreach ($results as $item)
                        <ul style="border: 1px solid black; padding:25px;">
                        
                            <li class="text-center">

                                <h4 class="text-center">
                                
                            {{$item->title}}
                                </h4>
                            <hr>
                        </li>
                            
                            <li>
                                <h4 class="text-center">
                                

                            استعلام فارسی
                                </h4>
                                <br>
                              {{$item->resultPersian}}
                            
                              <hr>
                            </li>


                            @if ($item->resultEnglish)
                                
                            <li>
                                <h4 class="text-center">
                                
                                استعلام انگلیسی

                                </h4>
                                <br>
                                
                                {{$item->resultEnglish}}
                            
                                <hr>
                            </li>
                            @endif

                            @if ($item->filePersian)
                                
                            <li>
                                
                                <h4 class="text-center">
                                    فایل
                                    استعلام فارسی
                                    
                                </h4>
                                <br>

                                <img style="max-width: 100%;" src="{{url($item->filePersian)}}" alt="{{$item->filePersian}}">
                            
                                <hr>
                            </li>
                            @endif

                            @if ($item->fileEnglish)
                                
                            <li><h4 class="text-center">
                                
                                فایل
                                استعلام انگلیسی
                                </h4>
                                <br>                
                                <img style="max-width: 100%;" src="{{url($item->fileEnglish)}}" alt="{{$item->fileEnglish}}">
                                <hr>
                            </li>
                            @endif

                        </ul>    

                    @endforeach

                    
                </div>
            </div>
        </div>
    
        
    
    
        
        
    </div>
    
@endsection







<script src="{{ asset('/asset/jquery.js') }}"></script>
<script>







function validate(item ,type = null , count = null){

    
    var value = $('#'+ item).val();

    var itemValid= false;

    $('.'+item + ".iValidate").css('display' , 'none');
    
    if(value != ""){
        
        if(count &&  value.length != count ){

        }else if(type && type == "email"){
           
            if(validateEmail(value)){
                
                itemValid = true;
            }
        }else{
            itemValid = true;
        }
    }





    if(itemValid){

        $('.'+item).addClass('success');
        $('.'+item).removeClass('warning');
        $('.'+item + ".succsesM").css('display' , 'block');
        $('.'+item + ".warningM").css('display' , 'none');
    
    }else{
        $('.'+item).addClass('warning');
        $('.'+item).removeClass('success');

        $('.'+item + ".succsesM").css('display' , 'none');
        $('.'+item + ".warningM").css('display' , 'block');
    
            
    }



    var isValid;
    $('input').each(function() {
        if(!$(this).val()){
            isValid = false;
        }
    });
    
    
    
    // // console.log()
    // if(isValid){
    //     console.log('valid');
    //     $("#btnSubmit"). attr("disabled", false);
    // }else{
    //     console.log('invalid2');
    //     $("#btnSubmit"). attr("disabled", true);

    // }
    

}


function sendCode(){

    $('#form').submit();

}


const validateEmail = (email) => {

    return String(email)
    .toLowerCase()
    .match(
      /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|.(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/
    );
};

</script>

    

    
