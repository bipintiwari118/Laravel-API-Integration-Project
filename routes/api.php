<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\UserController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/


Route::group(['middleware'=>'api'],function($routes){

    Route::post('register',[UserController::class,'register'])->name('api.register');
    Route::post('login',[UserController::class,'login'])->name('api.login');
    Route::get('logout',[UserController::class,'logout'])->name('api.logout');
    Route::get('profile',[UserController::class,'profile'])->name('api.profile');

});



// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
