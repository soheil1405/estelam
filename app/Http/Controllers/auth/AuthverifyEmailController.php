<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use App\Jobs\SendEamil;
use App\Models\auth\authverifyCode;

use App\Notifications\OtpNotification;
use Carbon\Carbon;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthverifyEmailController extends Controller
{
    public function index()
    {




        if (Auth::user()) {
            return redirect()->route('home');
        } else {


            $user = Auth::user();

            if (Auth::user()->mobileVerifyCode) {

            
                $last_code = Auth::user()->mobileVerifyCode;



                $code = $last_code->update([
                    'user_id' => $user->id,
                    'code' => rand(10000, 99999),
                    'for' => 'mobile'
                ]);




                $user->notify(new OtpNotification());





            } else {
                $code = authverifyCode::create([
                    'user_id' => $user->id,
                    'code' => rand(10000, 99999),
                    'for' => 'mobile'
                ]);

                
                $user->notify(new OtpNotification());



                // $email = Auth::user()->email;

                // SendEamil::dispatch($email , $code);
            }



            return redirect()->route('EnterVerifyCodePage');
        }

    }

    public function verify(Request $request)
    {

        $request->validate([
            'authEmailcode' => 'required',
        ]);

        $user = Auth::user();

        if (!$user) {
            return view('home');
        } else {

            if ($user->EmailVerifyCode->code == $request->authEmailcode) {

                $user->update([
                    'email_verified_at' => Carbon::now(),
                ]);

                $user->EmailVerifyCode->delete();
                Auth::login($user);

                return redirect()->route('home');

            } else {

                session()->flash('customError', 'کد وارد شده اشتباه است ...');
                return redirect()->back();

            }

        }

    }


    public function EnterVerifyCodePage(){
        return view('auth.mobileVerifyCode');

    }


    public function verifyMobile(Request $request)
    {

        $request->validate([
            'mobileVerifyCode' => 'required',
        ]);

        $user = Auth::user();
        if (!$user) {

            return view('home');
        } else {

            if ($user->mobileVerifyCode->code == $request->mobileVerifyCode) {



                $user->update([
                    'mobile_verified_at' => Carbon::now(),
                ]);

                $user->mobileVerifyCode->delete();



                return redirect()->route('home');

            } else {

                session()->flash('customError', 'کد وارد شده اشتباه است ...');
                return redirect()->back();

            }

        }

    }

}