<?php

namespace App\Http\Controllers;

use App\Http\Requests\SubmitFormReq;
use App\Jobs\SendEamil;
use App\Models\Results;
use App\Models\UserEmailsSent;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\URL;
use PhpParser\Node\Stmt\Catch_;
use RealRashid\SweetAlert\Facades\Alert;

class HomeLandController extends Controller
{


    public function step1(){

        
        $user = Auth::user();        
        
        if (is_null($user)) {
                               
            return view('step1');
        
        }else{
            return redirect()->route('adminn.panel');
        }
        
    }



    public function step2(){
   

        $email = $this->checkDataAndEmailFromSession();

        if(array_key_exists('url' , $email)){


            session()->flash('CustomErr' , $email['msg']);
            return redirect()->route($email['url']);
        }

        $email = $email['email'];
        

        if(Carbon::parse($email->code_expire)->isPast()){
            $expire = 0;
        }else{

            $expire = Carbon::now()->diffInSeconds($email->code_expire);
        }




        $email = $email->email;


        return view('step2' , compact('email' ,'expire'));
   
    }

    public function step3(Request $request){
        $email = $this->checkDataAndEmailFromSession($request->email);


        if(array_key_exists('url' , $email)){


            session()->flash('CustomErr' , $email['msg']);
            return redirect()->route($email['url']);
        }


        $emailSent = $email['email'];
        

        $code = $emailSent->code;

        // dd(Carbon::parse($emailSent->code_expire)->isPast());
        if($request->codeRahgiri != $code){
            session()->flash('CustomErr' , "کد وارد شده اشتباه است");
            return redirect()->back();
        }elseif(Carbon::parse($emailSent->code_expire)->isPast()){
           
            // dd(Carbon::parse($request->code_expire));
            session()->flash('CustomErr' , "کد وارد شده منقضی شده است");
            return redirect()->back();
     
        }


        //sendemail
   
        session()->flash('CustomSuccess' , "لینک اطلاعات با موفقیت ساخته شد و برای ایمیل شما ارسال شد ");
    
        return redirect()->route('home');        

        

        
        
    }

    public function submitForm(SubmitFormReq $request) {
        
        $result = Results::where('nationalCode' , $request->nationalCode)->get();

        // try{

            if(count($result) == 0){
         
                session()->flash('CustomErr' , 'موردی با این کد ملی ثبت نشده است');
                Alert::error(' موردی یافت نشد', 'خطا');
                return redirect()->route('home');
         
            }else{
        
        
                $url = URL::signedRoute('resultt' , ['nationalCode' =>$request->nationalCode]);


                $LastSent = UserEmailsSent::where('nationalCode' , $request->nationalCode)->first();

                if($LastSent ){
                
                    if(Carbon::parse($LastSent->code_expire)->isPast()){
                            
                        $LastSent->update([ 
                            'code'=>rand(11111 , 99999),
                            'code_expire'=>Carbon::now()->addMinutes(2) ,
                            'email' => $request->email
                        
                        ]);
                        


                        dispatch(new SendEamil($request->email , $LastSent->code));


                    }else{

                        $LastSent->update([
                            'email' => $request->email
                        ]);
                    }
                    
                }else{



                    $userEmailSent = UserEmailsSent::create([
                        'nationalCode'=>$request->nationalCode ,
                        'email'=>$request->email ,
                        'code'=>rand(11111 , 99999),
                        'code_expire'=>Carbon::now()->addMinutes(2) ,
                        'urlgenerated'=>$url
                    ]);    


                    dispatch(new SendEamil($request->email , $LastSent->code));
                }

                session()->put('data', $request->except('_token'));
                session()->save();

                // dd(session()->get('data'));

                Alert::success(' کد رهگیری با موفقیت برای شما ارسال شد', '');
                return redirect()-> route('homeStep2');
                
            }
    
        // }catch(Exception $e){
            
        //     session()->flash('CustomErr' , 'موردی با این کد ملی ثبت نشده است');
        //     Alert::error(' موردی یافت نشد', 'خطا');
        //     return redirect()->route('home');
        
        // }
    }

    public function result(Request $request  , $nathonalCode){
                

        try{


            $results = Results::where('nationalCode' , $nathonalCode)->get();
        
            $userEmailSent = UserEmailsSent::where('nationalCode' , $nathonalCode)->first();



            session()->put('route' , $userEmailSent->urlgenerated);
            return view('step3' , compact('results'));
        
        }catch(Exception $e){

            session()->flash('CustomErr' , "خطا ");
            return redirect()->route('home');            
        }


    }



    public function resendCode(){
       $emailSent =  $this->checkDataAndEmailFromSession();
   
       if(array_key_exists('url' , $emailSent)){

            session()->flash('CustomErr' , $emailSent['msg']);
            return redirect()->route($emailSent['url']);
        }

        $emailSent = $emailSent['email'];

        $emailSent->update([
        
            'code'=>rand(11111 , 99999) ,
            'code_expire'=>Carbon::now()->addMinutes(2)
            
        ]);
        dispatch(new SendEamil($emailSent->email , $emailSent->code));


        return redirect()->route('homeStep2');
   
    }


}
