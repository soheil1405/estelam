@extends('admin.dashboard.master')




@section('headers')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
    <script src="{{ asset('/asset/jquery.js') }}"></script>

    @endsection


@section('title')
    داشبورد
@endsection

@section('content')
    <div class="container-fluid background-math">

        <div class="container">
            <div class="row">
                <div class="headback rounded">
                    <h6 class="text-center iransansultralight">داشبرد ادمین</h6>
                </div>



                <span onclick="$('#form').css('display' , 'block');"  class="btn btn-success">

                    ایجاد مورد جدید
                </span>

                <form  style="display: none;" id="form" action="{{route('adminn.results.store')}}" method="post" enctype="multipart/form-data">

                    @csrf

                    <div class="form-group">

                        کد ملی کاربر (اجباری)
                        <input type="number"  required class="form-control" name="nationalCode"  id="">
                    </div>
                    <div class="form-group">
                        عنوان مدرک(اجباری)
                        <input type="text"  required class="form-control" name="title"  id="">
                    </div>

                    <div class="form-group">
                      
                       نتیحه استعلام  به فارسی
                       (اجباری) 
                       <textarea name="resultPersian" required id="" class="form-control" cols="30" rows="10" > </textarea>
                    </div>
                    <div class="form-group"> 
                        نتیحه استعلام به انگلیسی
                        (اختیاری)
                        <textarea name="resultEnglish" id="" class="form-control" cols="30" rows="10" > </textarea>
                    </div>



                    <div class="form-group">
                      
                        <img src="" id="filePersian" alt="">
                        قایل فارسی(اختیاری) 
                        <input type="file" accept="image/png, image/gif, image/jpeg" name="filePersian" id="">
                    </div>

                    <div class="form-group">
                      
                        <img src="" id="fileEnglish" alt="">
                        قایل انگلیسی(اختیاری) 
                        <input type="file" accept="image/png, image/gif, image/jpeg" name="fileEnglish" id="">
                    </div>
                    <input type="submit" value="ذخیره" class="btn btn-success">
                
                    <span onclick="$('#form').css('display' , 'none');"  class="btn btn-danger">
                        بستن
                    </span>

                </form>



            </div>
        </div>
    </div>

    
@endsection
