<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\SettingControler;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\auth\LoginController;
use App\Http\Controllers\HomeLandController;
use App\Http\Controllers\ResultsController;
use App\Http\Middleware\isLogin;
use App\Http\Middleware\notLogin;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/





Route::get('/' , function(){

    Artisan::call('optimize:clear');
    return redirect()->route('home');

});

Route::get('/step1', [HomeLandController::class, 'step1'])->name('home');
Route::get('/step2', [HomeLandController::class, 'step2'])->name('homeStep2');
Route::post('/step3', [HomeLandController::class, 'step3'])->name('homeStep3');
Route::get('resultt/{nationalCode}',[HomeLandController::class , 'result'])->name('resultt')->middleware('signed');
Route::post('/resendCode' , [HomeLandController::class , 'resendCode'])->name('resendCode');
Route::post('/submitForm' , [HomeLandController::class  , 'submitForm'])->name('submitForm');





Route::get('/logout', [LoginController::class, 'logout'])
    ->middleware(isLogin::class)
    ->name('logout');
Route::get('/login', [LoginController::class, 'gotoLoginPage'])->middleware(notLogin::class)->name('LoginPage');
Route::post('/login/save', [LoginController::class, 'login'])->middleware(notLogin::class)->name('login');
        

Route::prefix('/admin-dashboard')
    ->name('adminn.')
    ->middleware([isLogin::class])
    ->group(function () {
        Route::get('/', [AdminController::class, 'index'])->name('panel');
        Route::resource('/results' , ResultsController::class);
        
    });






