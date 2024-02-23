<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\front\RegisterController;
use App\Http\Controllers\front\LoginController;
use App\Http\Controllers\GoogleController;
use App\Http\Controllers\UserDashboard;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\AudioController;
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

Route::get('/', function () {
    return view('front.home');
});

Route::get('/register',[RegisterController::class,'register'])->name('register');
Route::post('register',[RegisterController::class,'SaveUser'])->name('save-user');
Route::get('verify-account/{id}',[RegisterController::class,'verifyAccount'])->name('verify-account');


Route::get('/contact',[ContactController::class,'contact'])->name('contact');
Route::post('/save-feedback',[ContactController::class,'saveFeedback'])->name('save-feedback');
Route::post('/news-letter',[ContactController::class,'newsLetter'])->name('news-letter');

Route::get('/about',[FrontController::class,'aboutUs'])->name('about');
Route::get('/program',[FrontController::class,'program'])->name('program');

Route::get('/login',[LoginController::class,'login'])->name('login');
Route::post('/demo-login',[LoginController::class,'demoLogin'])->name('demo-login');
Route::get('/logout',[LoginController::class,'logout'])->name('logout');

Route::group(['middleware','loginUser'],function(){

    Route::get('/user/dashboard',[UserDashboard::class,'Dashboard'])->name('user-dashboard');
    Route::get('/user/profile',[UserDashboard::class,'Profile'])->name('user-profile');
    Route::post('/user/profile/update',[UserDashboard::class,'updateProfile'])->name('update-profile');

    Route::get('/recording-audio',[AudioController::class,'RecordingAudio'])->name('recording-audio');
    Route::post('/save-Recording-audio',[AudioController::class,'saveRecordingAudio'])->name('save-Recording-audio');

});
Route::fallback(function(){
    return view('page-not-found');
});

