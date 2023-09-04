@extends('admin.dashboard.master')




@section('headers')
<script src="{{ asset('/asset/jquery.js') }}"></script>

@endsection


@section('title')
    لیست نتایج
@endsection

@section('content')

    <div class="container-fluid background-math">
    <div class="headback rounded">
        <div class="container">
            <div class="row">
            
         
                <form class="" style="display: flex !important;">
                    <input class="form-control" name="search" type="search" 
                    
                    @if (request()->has('search'))
                        
                        value = "{{ request('search') }}"
                    @else
                    placeholder="برای جستجو ایدی یا کد ملی مورد نظر را وارد کنید ..." 
                        
                    @endif

                    
                    
                    aria-label="Search">
                    <button class="btn btn-outline-success" type="submit">جستجو</button>
                </form>

                <a href="{{route('adminn.panel')}}" class="btn btn-succcess">
                    ایجاد
                </a>
            </div>
            <div class="row bg-white rounded">

                <div class="col-md-12 divmain p-5">
                    <div class="row">
                        <table class="table table-hover table-striped table-bordered text-center">
                            <thead>

                                <th>

                                     ایدی
                                </th>

                                <th>
                                    کد ملی
                                </th>

                                <th>
                                    تاریخ ایجاد
                                </th>

                                <th>
                                    تاریخ اخرین ویرایش
                                </th>
                                <th>
                                    عملیات
                                </th>

                            </thead>

                            <tbody>

                                @foreach ($items as $item)
                                    <tr>

                                        <th>

                                            {{ $item->id }}

                                        </th>

                                        <th>

                                            {{ $item->nationalCode }}

                                        </th>

                                        <th>

                                            {{ verta( $item->created_at) }}

                                        </th>

                                        <th>

                                            {{ verta($item->updated_at) }}

                                        </th>

                                        
                                        <th>

                                            <a class="btn btn-warning" 
                                            href="{{route('adminn.results.edit' , ['result'=>$item])}}"
                                            
                                            
                                            ><svg
                                                    xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                    fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                                    <path
                                                        d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                                    <path fill-rule="evenodd"
                                                        d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
                                                </svg><span class="p-3">مشاهده و ویرایش</span></a>

                                                <button type="button" class="btn btn-danger"
                                                    onclick="deleteee({{$item->id}})">


                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                        fill="currentColor" class="bi bi-x-lg" viewBox="0 0 16 16">
                                                        <path
                                                            d="M2.146 2.854a.5.5 0 1 1 .708-.708L8 7.293l5.146-5.147a.5.5 0 0 1 .708.708L8.707 8l5.147 5.146a.5.5 0 0 1-.708.708L8 8.707l-5.146 5.147a.5.5 0 0 1-.708-.708L7.293 8 2.146 2.854Z" />
                                                    </svg>

                                                    حذف

                                                </button>


                                        </th>
                                        
                                        <form id="deleteForm" action="{{route('adminn.results.destroy' , ['result'=>$item])}}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <input type="hidden" name="Uid" id="Uid" value="{{$item->id}}" >

                                        </form>

                                    </tr>
                                @endforeach
                            </tbody>









                        </table>
                    </div>
                </div>


            </div>
        </div>
    </div>
@endsection

<script>
    function deleteee(id) {


        var answer = window.confirm("آیا میخواهید این مورد را حذف کنید ؟");
        if (answer) {
            $('#Uid').val(id);

            $('#deleteForm').submit();   
        
        
        } else {



        }

    }
</script>
