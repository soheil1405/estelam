<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreResultRequest;
use App\Http\Requests\SubmitFormReq;
use App\Models\Results;
use App\Models\UserEmailsSent;
use Carbon\Carbon;
use Exception;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
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


        if($request->filePersian){
            $filePersian = $this->saveImage($request->filePersian);
            
            $result->update([
                'filePersian' =>$filePersian
            ]);
        
        }

        if($request->fileEnglish){
             $fileEnglish =  $this->saveImage($request->fileEnglish);
             $result->update([

                'fileEnglish' =>$fileEnglish
            ]);
        }

        session()->flash('CustomSuccess', 'آیتم مورد نظر با موفقیت ذخیره شد');

        return redirect()->route('adminn.results.index');

    }

    public function update(StoreResultRequest $request , $result){


        
        $result = Results::findOrFail($result)->update($request->except('_token'));

        session()->flash('CustomSuccess', 'آیتم مورد نظر با موفقیت ویرایش شد');

        return redirect()->route('adminn.results.index');

    }

    public function destroy( $result){


        
        $result = Results::findOrFail($result);

        $result->deleteImages();

        $resultNationalCode = $result->nationalCode;


        $moreresult = Results::where('nationalCode' , $result->nationalCode)->where('id' , "!=" , $result->id)->get(); 


        if(count($moreresult) == 0){
            $UserEmailsSent = UserEmailsSent::where('nationalCode' , $resultNationalCode)->get();

            foreach ($UserEmailsSent as $sent) {
                
                $sent->delete();
            }
        }



        
        $result->delete();




        session()->flash('CustomSuccess', 'آیتم مورد نظر با موفقیت حذف شد');

        return redirect()->route('adminn.results.index');

    }







}
