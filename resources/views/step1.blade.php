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
    <div class="row mt-3">
        <div class="col-12">
            <div class="col-xs-12 col-md-10 col-md-push-1 col-lg-8 col-lg-push-2">
                <ul class="tabs">
                    <li class="tab col s4 step1 admin2color"><a href="{{route('home')}}" class="active"  >ورود اطلاعات</a></li>
                    <li class="tab col s4  step2"><a >وارد کردن کد رهگیری ارسال شده </a></li>
                    <li class="tab col s4   step3"><a  >نمایش مدرک تحصیلی</a></li>
                </ul>
            </div>
        </div>
        
    
        <div id="s1" >
            
            <div class=" col-md-10 col-md-push-1 col-lg-8 col-lg-push-2">

                <div class="box box-cme st1 p-5 " >

                    <form action="{{route('submitForm')}}"  id="form" method="post" class="m-auto">
                        @csrf
                        <label class="row  mt-2">                       
                            <label class="lab_register code">
                                <input id="code"   value="{{ old('code') }}" onkeyup="validate('code')" name="code"  class="inputes" type="text" style=""  placeholder="کد ارسال شده به ایمیل را وارد کنید">
                                <i class="fa fa-check iValidate succsesM code"></i>
                                <i class="fa fa-times iValidate warningM code"></i>
                            </label>
                        </label>
    
                        
                        
    
                        <label class="lb_row ">
                            <a id="btnSubmit"  class="waves-light btn m-auto   box-cme sendCodeBtn"   onclick="sendCode()"> مشاهده نتیجه </a>
                        </label>
    
                    </form>
                    </div>
            </div>
        </div>
    
        
    
    
        
        <div id="s2" class="col-12" style="display: none;">
            <div class="col-xs-12 col-md-10 col-md-push-1 col-lg-8 col-lg-push-2">
                <div class="box box-cme st2">
    
    
                    <form style="padding-top: 15px;">
    
                        <p class="p_st2" style="margin-bottom: 10px !important;">
                            <i class="fa fa-check" style="color:#555"></i>
                            کد رهگیری برای ایمیل <span id="s_email"></span> ارسال گردید .
                        </p>
                        <p class="p_st2">
                            <i class="fa fa-check" style="color:#555"></i>
                            در صورت تمایل به نمایش اطلاعات تحصیلی ، کد رهگیری ارسالی را وارد نمایید
                        </p>
                        <label class="lb_row ">
                            <label class="lab_register codeRahgiri">
                                <i class="fa fa-refresh1 iType "></i>
    
                                <input id="codeRahgiri" class="" type="text" style="" placeholder="کد رهگیری">
    
                                
                                <i class="fa fa-asterisk iValidate codeRahgiri "></i>
                                <i class="fa fa-check iValidate codeRahgiri succsesM "></i>
                                <i class="fa fa-times iValidate codeRahgiri warningM "></i>
                            </label>
                        </label>
    
                        <div class="form-group div_reCaptcha">
                            <div class="col-md-offset-0 col-md-12">
                                
                                <div id="captchaS2" class="g-recaptcha"></div>
    
    
                            </div>
    
                        </div>
    
                        <label class="lb_row ">
    
                            
    
    
                        </label>
    
                        
    
                        <label class="lb_row ">
    
                            <a class="waves-effect waves-light btn   box-cme inqueryBtn" onclick="inquery()"> استعلام مدرک تحصیلی  </a>
                        </label>
    
                        <label class="lb_row ">
    
                            <a id="timerCode" class="waves-effect waves-light btn  disabled " onclick="refreshCodeRahgiri()">
                                60
                            </a>
    
    
                        </label>
                    </form>
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

    

    
