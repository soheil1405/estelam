<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeLandController extends Controller
{


    public function step1(){

        $user = Auth::user();        
        
        if (is_null($user)) {
                               
            return view('welcome');
        
        }else{
            return redirect()->route('adminn.panel');
        }
        
    }


    public function step2(){
   
        return view('step2');
   
    }

    public function step3(){
        return view('step3');
    }
}
