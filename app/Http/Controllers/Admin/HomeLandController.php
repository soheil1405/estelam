<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeLandController extends Controller
{



    public function home(){




        $user = Auth::user();
        
        
        if (!is_null($user)) {
    
            return redirect()->route('home');
       
       
        }else{
  
            return redirect()->route('adminn.panel');
       

        }
        
    }

}

    
