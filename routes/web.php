<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\SettingControler;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\auth\LoginController;
use App\Http\Controllers\HomeLandController;
use App\Http\Controllers\ResultsController;
use App\Http\Middleware\isLogin;
use App\Http\Middleware\notLogin;
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

    return redirect()->route('home');
});

Route::get('/step1', [HomeLandController::class, 'step1'])->name('home');
Route::get('/step2', [HomeLandController::class, ''])->name('homeStep2');
Route::get('/step3', [HomeLandController::class, 'step3'])->name('homeStep3');

Route::get('/login', [LoginController::class, 'gotoLoginPage'])->middleware(notLogin::class)->name('LoginPage');
Route::post('/login/save', [LoginController::class, 'login'])->middleware(notLogin::class)->name('login');

Route::post('/submitForm' , [ResultsController::class  , 'submitForm'])->name('submitForm');

Route::get('/logout', [LoginController::class, 'logout'])
    ->middleware(isLogin::class)
    ->name('logout');

    Route::get('resultt/{email}/{nationalCode}',[ResultsController::class , 'result'])->name('resultt')->middleware('signed');
    




Route::prefix('/admin-dashboard')
    ->name('adminn.')
    ->middleware([isLogin::class])
    ->group(function () {
        Route::get('/', [AdminController::class, 'index'])->name('panel');

        
        // Route::resource('/users', UserController::class);
        
        Route::resource('/results' , ResultsController::class);
        
    });



// Route::prefix('/user-dashboard')
//     ->middleware([isLogin::class, IsUser::class])
//     ->name('user.')
//     ->group(function () {


//         Route::get('/', [UserController::class, 'dashboard'])->name('panel');



//         Route::get('/ResetPass', [forgotPassword::class, 'ResetPassPage'])->name('ResetPassPage');


//         Route::post('/newPass', [forgotPassword::class, 'EnterNew'])->name('EnterNewPass');

//         Route::get('/questions/{id}', [QuestionsController::class, 'userShow'])->name('questions.show');


//         Route::get('/winners', [WinnersController::class, 'userIndex'])->name('winners');

//         Route::get('/myHistory', [QuestionsController::class, 'myHistory'])->name('myHistory');

//         Route::get('/user/{id}' , [UserController::class , 'showUser'])->name('showUser');

//         Route::get('/myLastQuestion', [QuestionsController::class, 'myLastQuestion'])->name('myLastQuestion');

//         Route::get('/CompetitionList', [UserController::class, 'Competition'])->name('CompetitionList');
//     });











