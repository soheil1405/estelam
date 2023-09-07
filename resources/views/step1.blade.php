@extends('home.master')





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
                    <li class="tab col s4 step1 admin2color"><a class="active"  >ورود اطلاعات</a></li>
                    <li class="tab col s4 disabled step2"><a >وارد کردن کد رهگیری ارسال شده </a></li>
                    <li class="tab col s4 disabled  step3"><a  href="{{getSighnedRouteFromSession()}}"  >نمایش مدرک تحصیلی</a></li>
                </ul>
            </div>
        </div>
        
    
        <div id="s1" >
            
            <div class=" col-md-10  m-auto  col-md-push-1 col-lg-8 col-lg-push-2">

                <div class="box box-cme st1 p-5 " >

                    <form action="{{route('submitForm')}}"  id="form" method="post" class="m-auto">
                        @csrf
                        <label class="row  mt-2">                       
                            <label class="lab_register name">
                                <i class="fa fa-user iType"></i>
                                <input id="name"   value="{{ getFromSessiom('data' , 'name' , 'string') }}" onkeyup="validate('name' , null , null , 'perisan' )" name="name"  class="inputes" type="text" style=""  placeholder="نام">
    
                                
                                <i class="fa fa-asterisk iValidate name"></i>
                                <i class="fa fa-check iValidate succsesM name"></i>
                                <i class="fa fa-times iValidate warningM name"></i>
                            </label>
                        </label>
    
                        <label class="lb_row ">
                            <label class="lab_register family">
                                <i class="fa fa-user-plus iType"></i>
                                <input id="family" onkeyup="validate('family'  , null , null , 'perisan')" value="{{ getFromSessiom('data' , 'family' , 'string') }}" name="family" class="inputes" type="text" style="" placeholder="نام خانوادگی">
    
                                
                                <i class="fa fa-asterisk iValidate family"></i>
                                <i class="fa fa-check iValidate succsesM family"></i>
                                <i class="fa fa-times iValidate warningM family"></i>
                            </label>
                        </label>
    
                        <label class="lb_row ">
                            <label class="lab_register father">
                                <i class="fa fa-male iType"></i>
                                <input id="father"  onkeyup="validate('father'  , null , null , 'perisan')" class="inputes" value="{{ getFromSessiom('data' , 'father' , 'string') }}" name="father" type="text" style=""  placeholder="نام پدر">
    
                                
                                <i class="fa fa-asterisk iValidate father"></i>
                                <i class="fa fa-check iValidate succsesM father"></i>
                                <i class="fa fa-times iValidate warningM father"></i>
                            </label>
                        </label>
    
                        <label class="lb_row ">
                            <label class="lab_register email">
                                <i class="fa fa-email iType"></i>
                                <input id="email" onkeyup="validate('email' , 'email' , null )" type="email"  class="onlynumeric inputes" name="email" style="" value="{{ getFromSessiom('data' , 'email' , 'string') }}" placeholder="ایمیل">
    
                                
                                <i class="fa fa-asterisk iValidate email"></i>
                                <i class="fa fa-check iValidate succsesM email"></i>
                                <i class="fa fa-times iValidate warningM email"></i>
                            </label>
                        </label>
    
    
                        <label class="lb_row ">
                            <label class="lab_register nationalCode">
                                <i class="fa fa-id-badge iType"></i>
                                <input id="nationalCode"  type="number" onkeyup="validate('nationalCode' , null , 10, 'int')" class="onlynumeric inputes" type="tel"   style=""  value="{{ getFromSessiom('data' , 'nationalCode' , 'int') }}"  name="nationalCode" placeholder="کد ملی">
    
    
                                
                                <i class="fa fa-asterisk iValidate nationalCode"></i>
                                <i class="fa fa-check iValidate succsesM nationalCode"></i>
                                <i class="fa fa-times iValidate warningM nationalCode"></i>
                            </label>
                        </label>
    
    
                        <label class="lb_row ">
                            <label class="lab_register numberId">
                                <i class="fa fa-id-card-o iType"></i>
                                <input id="numberId" type="number" onkeyup="validate('numberId'  , null , null , 'int')"  class="onlynumeric inputes" type="tel"   style="" value="{{ getFromSessiom('data' , 'numberId' , 'int') }}"  name="numberId"  placeholder="شماره شناسنامه">
    
    
                                <i class="fa fa-asterisk iValidate numberId"></i>
                                <i class="fa fa-check iValidate succsesM numberId"></i>
                                <i class="fa fa-times iValidate warningM numberId"></i>
                            </label>
                        </label>
    
                        <label class="lb_row ">
                            <label class="lab_register serialId">
                                <i class="fa fa-ellipsis-h iType"></i>
     
                                <input id="serialId" type="number"  onkeyup="validate('serialId' , null , 6 , 'int')"  class="onlynumeric inputes" type="tel" maxlength="6" style="" value="{{ getFromSessiom('data' , 'serialId' , 'int') }}"  name="serialId" placeholder="فقط 6 رقم عددی سریال شناسنامه را وارد کنید">
                                <a  class="btn-floating btn-small  red lighten-1 pulse modal-trigger" style="color:yellow;position:absolute;
                                    left:30px;top:4px; width:26px;height:26px; ">
                                    <i class="fa fa-info" style="top:5px;color:#ffcdd2 "></i>
                                </a>

                        
                        
                            @php
                                $type = 'detail';
                                
                                $image = "";
                                // $image = "<img src='http://127.0.0.1:8000/asset/images/Serial-Example.jpg' >";
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
                                <input value="20" type="number" onkeyup="validate('day' , null , 2 , 'int' )" class="inputes"  value="{{ getFromSessiom('data' , 'day' , 'int') }}"  name="day" id="day">
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

                                <input type="number" value="1370" onkeyup="validate('year' , null , 4  , 'int')"  value="{{ getFromSessiom('data' , 'year' , 'int') }}"  name="year" class=" inputes"   id="year">

                                </label>
    
    
    

                                <i class="fa fa-check iValidate succsesM birthday"></i>
                                <i class="fa fa-times iValidate warningM birthday"></i>
                            </label>
                        </label>
    
                        
    
                        {{-- <label class="lb_row "> --}}

                            <div class="row">

                                <a id="btnSubmit"  class="waves-light btn m-auto   box-cme"   onclick="sendCode()">صدور کد رهگیری</a>
                            </div>
                        {{-- </label> --}}
    
                    </form>
                    </div>
            </div>
        </div>
    
        
    
    
        
    </div>
    
@endsection







<script src="{{ asset('/asset/jquery.js') }}"></script>
<script>




$( document ).ready(function() { 
    // console.log('adasdads');
    
    validateAll();
    // array 
});


function validate(item ,type = null , count = null , vartype = null){

    
    var value = $('#'+ item).val();


    var itemValid= false;

    $('.'+item + ".iValidate").css('display' , 'none');
    
    if(value != ""){
        
        if(count &&  value.length != count ){

        }else if(type && type == "email"){
           
            if(validateEmail(value)){        

                itemValid = true;
            }
        
        }else if(vartype == "perisan"){
          
        
            itemValid =  just_persian(value);
        }else{
            itemValid = true;
        }
    }





    if(itemValid){

        $('.'+item).addClass('success');
        $('.'+item).removeClass('warning');
        $('.'+item + ".succsesM").css('display' , 'block');
        $('.'+item + ".warningM").css('display' , 'none');
    
        return true;
    }else{
        $('.'+item).addClass('warning');
        $('.'+item).removeClass('success');

        $('.'+item + ".succsesM").css('display' , 'none');
        $('.'+item + ".warningM").css('display' , 'block');
    
        
        return false;
    }


    
    

}


function validateAll(voidable =null){
    
    if(validate('name') &&  validate('family') && validate('father')
    
    && validate('email' , 'email' , null) &&
    validate('nationalCode' , null , 10) && 
    validate('numberId') && 
    validate('serialId' , null , 6) && 
    validate('day' ) &&
    validate('year' , null , 4)
    ){


        if(!voidable){

            return true ;
        }
    }else{
        if(!voidable){

            return false;
        }
    }
    
    
    
    
    
    
    
    
}


function just_persian(str){
    var p = /^[\u0600-\u06FF\s]+$/;
    if (!p.test(str)) {
        return false;
    }else{
        return true;
    }
}

function sendCode(){


    if(validateAll()){

        if(confirm('آیا از اطلاعات وارد شده اطمینان دارید ؟')){

            $('#form').submit();
        }

    }else{
        alert('لطفا ابتدا تمامی موارد را بدقت وارد کنید');
    }


}


const validateEmail = (email) => {

    
    return String(email)
    .toLowerCase()
    .match(
      /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|.(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/
    );
};

</script>

    

    
