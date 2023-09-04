<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreResultRequest;
use App\Http\Requests\SubmitFormReq;
use App\Models\Results;
use App\Models\UserEmailsSent;
use Carbon\Carbon;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use RealRashid\SweetAlert\Facades\Alert;

class ResultsController extends Controller
{
    
    public function index(Request $request){
        
        $search = $request->search;
        
        
        $items = Results::latest()
        ->when( $search , function ($query) use($search) {
            return $query->where('id' , $search )->orWhere('nationalCode' ,$search);
        })
        ->get();
    
        return view('admin.results.index', compact('items'));
    }

    public function edit(Request $request , $result){
        
        $result = Results::findOrFail($result);
        
        
        
        return view('admin.results.edit', compact('result'));
    }

    public function store(StoreResultRequest $request){


        $result = Results::create($request->except('_token'));

        session()->flash('CustomSuccess', 'آیتم مورد نظر با موفقیت ذخیره شد');

        return redirect()->route('adminn.results.index');

    }

    public function update(StoreResultRequest $request , $result){


        
        $result = Results::findOrFail($result)->update($request->except('_token'));

        session()->flash('CustomSuccess', 'آیتم مورد نظر با موفقیت ویرایش شد');

        return redirect()->route('adminn.results.index');

    }

    public function destroy( $result){


        
        $result = Results::findOrFail($result)->delete();

        session()->flash('CustomSuccess', 'آیتم مورد نظر با موفقیت حذف شد');

        return redirect()->route('adminn.results.index');

    }



    public function submitForm(SubmitFormReq $request) {
        
        $result = Results::where('nationalCode' , $request->nationalCode)->get();

        if(count($result) == 0){



            Alert::error(' موردی یافت نشد', 'خطا');


            return redirect()->back();
        }else{
      
      
            $url = URL::signedRoute('resultt' , ['email'=>$request->email  , 'nationalCode' =>$request->nationalCode]);


            $LastSent = UserEmailsSent::where('email' , $request->email)->where('nationalCode' , $request->nationalCode)->first();

            if($LastSent){
                $LastSent->update([ 
                    'code'=>rand(11111 , 99999),
                    'code_expire'=>Carbon::now()->addMinutes(2) ,
                ]);
            }else{
                $userEmailSent = UserEmailsSent::create([
                    'nationalCode'=>$request->nationalCode ,
                    'email'=>$request->email ,
                    'code'=>rand(11111 , 99999),
                    'code_expire'=>Carbon::now()->addMinutes(2) ,
                    'urlgenerated'=>$url
                ]);    
            }

            session()->put('data', $request->except('_token'));
            session()->save();

            Alert::success(' کد رهگیری با موفقیت برای شما ارسال شد', '');
            return redirect()->back();
            
        }
        
    }



    public function result(Request $request , $email , $nathonalCode){
        dd( $email  , $nathonalCode);
    }
}
