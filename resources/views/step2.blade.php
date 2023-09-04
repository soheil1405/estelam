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
                    <li class="tab col s4 step1 admin2color"><a class="active"  >ورود اطلاعات</a></li>
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
                            <label class="lab_register name">
                                <i class="fa fa-user iType"></i>
                                <input id="name"   value="{{ old('name') }}" onkeyup="validate('name')" name="name"  class="inputes" type="text" style=""  placeholder="نام">
    
                                
                                <i class="fa fa-asterisk iValidate name"></i>
                                <i class="fa fa-check iValidate succsesM name"></i>
                                <i class="fa fa-times iValidate warningM name"></i>
                            </label>
                        </label>
    
                        <label class="lb_row ">
                            <label class="lab_register family">
                                <i class="fa fa-user-plus iType"></i>
                                <input id="family" onkeyup="validate('family')" value="{{ old('family') }}" name="family" class="inputes" type="text" style="" placeholder="نام خانوادگی">
    
                                
                                <i class="fa fa-asterisk iValidate family"></i>
                                <i class="fa fa-check iValidate succsesM family"></i>
                                <i class="fa fa-times iValidate warningM family"></i>
                            </label>
                        </label>
    
                        <label class="lb_row ">
                            <label class="lab_register father">
                                <i class="fa fa-male iType"></i>
                                <input id="father"  onkeyup="validate('father')" class="inputes" value="{{ old('father') }}" name="father" type="text" style=""  placeholder="نام پدر">
    
                                
                                <i class="fa fa-asterisk iValidate father"></i>
                                <i class="fa fa-check iValidate succsesM father"></i>
                                <i class="fa fa-times iValidate warningM father"></i>
                            </label>
                        </label>
    
                        <label class="lb_row ">
                            <label class="lab_register email">
                                <i class="fa fa-email iType"></i>
                                <input id="ایمیل" onkeyup="validate('email' , 'email' , null)" type="email"  class="onlynumeric inputes" name="email" style="" value="{{ old('email') }}" placeholder="ایمیل">
    
                                
                                <i class="fa fa-asterisk iValidate email"></i>
                                <i class="fa fa-check iValidate succsesM email"></i>
                                <i class="fa fa-times iValidate warningM email"></i>
                            </label>
                        </label>
    
    
                        <label class="lb_row ">
                            <label class="lab_register nationalCode">
                                <i class="fa fa-id-badge iType"></i>
                                <input id="nationalCode"  type="number" onkeyup="validate('nationalCode' , null , 10)" class="onlynumeric inputes" type="tel"  value="" style=""  value="{{ old('nationalCode') }}"  name="nationalCode" placeholder="کد ملی">
    
    
                                
                                <i class="fa fa-asterisk iValidate nationalCode"></i>
                                <i class="fa fa-check iValidate succsesM nationalCode"></i>
                                <i class="fa fa-times iValidate warningM nationalCode"></i>
                            </label>
                        </label>
    
    
                        <label class="lb_row ">
                            <label class="lab_register numberId">
                                <i class="fa fa-id-card-o iType"></i>
                                <input id="numberId" type="number" onkeyup="validate('numberId')"  class="onlynumeric inputes" type="tel"  value="" style="" value="{{ old('numberId') }}"  name="numberId"  placeholder="شماره شناسنامه">
    
    
                                <i class="fa fa-asterisk iValidate numberId"></i>
                                <i class="fa fa-check iValidate succsesM numberId"></i>
                                <i class="fa fa-times iValidate warningM numberId"></i>
                            </label>
                        </label>
    
                        <label class="lb_row ">
                            <label class="lab_register serialId">
                                <i class="fa fa-ellipsis-h iType"></i>
     
                                <input id="serialId" type="number"  onkeyup="validate('serialId' , null , 6)"  class="onlynumeric inputes" type="tel" maxlength="6" style="" value="{{ old('serialId') }}"  name="serialId" placeholder="فقط 6 رقم عددی سریال شناسنامه را وارد کنید">
                                <a  class="btn-floating btn-small  red lighten-1 pulse modal-trigger" style="color:yellow;position:absolute;
                                    left:30px;top:4px; width:26px;height:26px; ">
                                    <i class="fa fa-info" style="top:5px;color:#ffcdd2 "></i>
                                </a>

                        
                        
                            @php
                                $type = 'detail';
                                $image = "<img src='http://127.0.0.1:8000/asset/images/Serial-Example.jpg' >";
                                $text = 'تذکر مهم : فقط 6 رقم عددی سریال شناسنامه را وارد کنید .بعنوان مثال 23د/592385 فقط 592385 درج بشود .';
                            @endphp
                    
                            <x-submit :type='$type'  :text='$text' :image='$image' />
                    
                                
    
                                <i class="fa fa-asterisk iValidate serialId"></i>
                                <i class="fa fa-check iValidate succsesM serialId"></i>
                                <i class="fa fa-times iValidate warningM serialId"></i>
                            </label>
                        </label>
    
                        <label class="lb_row ">
                            <label class=" birthday d-flex">
    
                                
    
                                <label class="lab_register day">
                                <input value="20" type="number" onkeyup="validate('day' )" class="inputes"  value="{{ old('day') }}"  name="day" id="day">
                                </label>

                                
                                <select id="month" name="month" class="form-control ">
                                
                                    
                                    <option value="01" selected="selected" >فروردین</option>
                                    <option value="02">اردیبهشت</option>
                                    <option value="03">خرداد</option>
                                    <option value="04">تیر</option>
                                    <option value="05">مرداد</option>
                                    <option value="06">شهریور</option>
                                    <option value="07">مهر</option>
                                    <option value="08">آبان</option>
                                    <option value="09">آذر</option>
                                    <option value="10">دی</option>
                                    <option value="11">بهمن</option>
                                    <option value="12">اسفند</option>
                                </select>
                                
                                
    
                                <label class="lab_register year">

                                <input type="number" value="1370" onkeyup="validate('year' , null , 4)"  value="{{ old('year') }}"  name="year" class=" inputes"   id="year">

                                </label>
    
    
    

                                <i class="fa fa-check iValidate succsesM birthday"></i>
                                <i class="fa fa-times iValidate warningM birthday"></i>
                            </label>
                        </label>
    
                        
    
                        <label class="lb_row ">
                            <a id="btnSubmit"  class="waves-light btn m-auto   box-cme sendCodeBtn"   onclick="sendCode()">صدور کد رهگیری</a>
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

    

    
