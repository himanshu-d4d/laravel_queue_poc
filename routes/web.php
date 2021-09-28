<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendtestMail;
use App\Models\User;
use App\Http\Controllers\UserRegistrasionController;


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
    $user = User::findorFail(1);
   dispatch(new \App\jobs\SendtestMailjob($user))->delay(now()->addSeconds(10));
   echo "mail send";
  
});

Route::get('fb', [UserRegistrasionController::class, 'fbButton']);
Route::get('fbsub', [UserRegistrasionController::class, 'fbSubmit']);
Route::get('feceRes', [UserRegistrasionController::class, 'feceResponce']);

Route::get('linkSub', [UserRegistrasionController::class, 'linkSubmit']);
Route::get('linkRes', [UserRegistrasionController::class, 'linkResponce']);
Route::get('login', [UserRegistrasionController::class, 'Login']);
Route::get('ragister', [UserRegistrasionController::class, 'ragister']);
//Route::get('UserLogin', [UserRegistrasionController::class, 'UserLogin']);
Route::get('deshboard', [UserRegistrasionController::class, 'deshboard']);

Route::get('googlesub', [UserRegistrasionController::class, 'googleSubmit']);
Route::get('googleRes', [UserRegistrasionController::class, 'googleResponse']);

 Route::get('instaSubmit', [UserRegistrasionController::class, 'instaSubmit']);
Route::get('instaResponse', [UserRegistrasionController::class, 'instaResponse']);



