<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\auth\authverifyCode;

use Carbon\Carbon;

class LoginController extends Controller
{

    public function gotoLoginPage()
    {

        $user = Auth::user();

        if (!is_null($user)) {
            return redirect()->route('home');
        } else {
            return view('auth.login');
        }
    }

    public function Login(Request $request)
    {



        if ($request->type == "forgot") {


            $user = User::where('email', $request->email)->first();


            

            if (is_null($user)) {
                
                session()->flash('customError', 'ایمیل وارد شده اشتباه است');
                return redirect()->back();

            }

            session()->put('email' , $user->email);

            return redirect()->route('auth.sendForgotPassCode');

        } else {

            $request->validate([
                'password' => 'required|min:4',
                'email' => 'required|email|exists:users,email',
            ]);

            $user = User::where('email', $request->email)->first();

            if (!$user) {
                session()->flash('customError', 'کاربری با این مشخصات یافت نشد ');
                return redirect()->back();
            }
            $check = Hash::check($request->password, $user->password);

            if ($check) {
                Auth::login($user);
                session()->flash('wellcome', 'خوش آمدید');
                return redirect()->route('adminn.panel');

            } else {

                session()->flash('customError', 'رمز عبور وارد شده اشتباه است');
                return redirect()->back();
            }



            


    }





    }

    public function logout()
    {
        $user = Auth::user();


        Auth::logout($user);

        return redirect()->route('home');
    }
}