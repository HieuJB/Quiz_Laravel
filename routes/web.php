<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\loginController;

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
    return view('welcome');
});
Route::view('/index','index')->middleware('check_session');
Route::post('/dangky',[loginController::class,'dangky']);
Route::post('/dangnhap',[loginController::class,'xulydangnhap']);
Route::view('/home','home')->middleware('auth_login');
Route::get('/logout',[loginController::class,'dangxuat']);
Route::get('/home/trangcanhan',[loginController::class,'thongtin_canhan']);
Route::post('/updatecanhan',[loginController::class,'capnhat']);
Route::get('/home/thuchanh',[loginController::class,'show_question']);
Route::post('/luudapan',[loginController::class,'SaveAns']);
Route::get('/ketqua',[loginController::class,'results']);