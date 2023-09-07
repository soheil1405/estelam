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
                    <li class="tab col s4 step1 admin2color"><a href="{{route('home')}}"   >ورود اطلاعات</a></li>
                    <li class="tab col s4  step2"><a  class="active" >وارد کردن کد رهگیری ارسال شده </a></li>
                    <li class="tab col s4  disabled  step3"><a href="{{getSighnedRouteFromSession()}}"  >نمایش مدرک تحصیلی</a></li>
                </ul>
            </div>
        </div>
        
    
    
    
        
        <div id="s2" class="col-12" >
            <div class="col-xs-12 col-md-10 col-md-push-1 col-lg-8 col-lg-push-2">
                <div class="box box-cme st2">
    
    
                    <form action="{{route('homeStep3')}}"   id="homeStep3" method="post" class="m-auto">
                        @csrf
                        <input type="hidden" name="email" value="{{$email}}">

                        <p class="p_st2" style="margin-bottom: 10px !important;">
                            <i class="fa fa-check" style="color:#555"></i>
                            کد رهگیری برای ایمیل شما <span id="s_email"></span> ارسال گردید .
                        </p>
                        <p class="p_st2">
                            <i class="fa fa-check" style="color:#555"></i>
                            در صورت تمایل به نمایش اطلاعات تحصیلی ، کد رهگیری ارسالی را وارد نمایید
                        </p>
                        <label class="lb_row ">
                            <label class="lab_register codeRahgiri">
                                <i class="fa fa-refresh1 iType "></i>
    
                            <input id="codeRahgiri"  required value="{{ old('codeRahgiri') }}" onkeyup="validate('codeRahgiri' , null , 5)" name="codeRahgiri" type="text" style="" placeholder="کد رهگیری">
    
                                
                                <i class="fa fa-asterisk iValidate codeRahgiri "></i>
                                <i class="fa fa-check iValidate codeRahgiri succsesM "></i>
                                <i class="fa fa-times iValidate codeRahgiri warningM "></i>
                            </label>
                        </label>
    
                        
                        <label class=" ">
    
                            <a class="waves-effect waves-light btn   box-cme inqueryBtn" id="submit" onclick="$('#homeStep3').submit()"> استعلام مدرک تحصیلی  </a>
                        </label>
    
                        <label class=" ">
    

                            <a id="timerCode" class="waves-effect waves-light btn  disabled " style="color:red !important;" onclick="refreshCodeRahgiri()">
                                120
                            </a>
    
    
                        </label>
                    </form>
    
                    <form action="{{route('resendCode')}}" method="post" id="resendCode">
                        @csrf

                        <input type="hidden" name="email" value="{{$email}}">
                    </form>
                </div>
            </div>
        </div>
        
    </div>
    
@endsection







<script src="{{ asset('/asset/jquery.js') }}"></script>


<script>

var allseconds = {{$expire}};

$( document ).ready(function() { 

const countdown = setInterval(() => {

    // seconds.html("");
  
    
    if (allseconds === 0) {
        $('#timerCode').removeClass('disabled');
        $('#timerCode').html('ارسال مجدد رمز '  );
        $('#submit').addClass('disabled');
        clearInterval(countdown);   
    } else {
   
        console.log(allseconds);
        allseconds = allseconds - 1;
        $('#timerCode').html(allseconds);
    }

}, 1000)
});

function refreshCodeRahgiri(){
    
    
    console.log('asdasdasdasd');
    $('#resendCode').submit();
}

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

    

    
