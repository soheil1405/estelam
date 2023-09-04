@extends('admin.dashboard.master')




@section('headers')
@endsection


@section('title')
    داشبورد
@endsection

@section('content')


<form id="form" action="{{route('adminn.results.update' , ['result'=>$result])}}" method="post">

    @method('PUT')
    @csrf

    <div class="form-group">

        کد ملی کاربر (اجباری)
        <input type="number"  value="{{$result->nationalCode}}"  required class="form-control" name="nationalCode"  id="">
    </div>

    <div class="form-group">
      
       نتیحه استعلام  به فارسی
       (اجباری) 
       <textarea name="resultPersian" required id="" class="form-control" cols="30" rows="10" >{{$result->resultPersian}}</textarea>
    </div>
    <div class="form-group"> 
        نتیحه استعلام به انگلیسی
        (اختیاری)
        <textarea name="resultEnglish" id="" class="form-control" cols="30" rows="10" >{{$result->resultEnglish}}</textarea>
    </div>
    <input type="submit" value="ذخیره" class="btn btn-success">

    <a href="{{route('adminn.results.index')}}" class="btn btn-danger">
        بستن
    </a>

</form>


@endsection
