<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\loginController;
use App\Http\Controllers\Question_Controller;

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
Route::get('/chitiet',[loginController::class,'chitietbailam']);
Route::get('xoadata',[loginController::class,'xoahistory']);
Route::get('home/trangdiemso',[loginController::class,'show_score']);
Route::view('/admin','admin.admin');
Route::get('/admin/quanlytaikhoan',[loginController::class,'quanlytaikhoan_admin']);
Route::get('/edit1/{id}',[loginController::class,'find_id_edit']);
Route::put('/dasdsa',[loginController::class,'edit_data_form'])->name('edit.data');
Route::delete('delete1/{id}',[loginController::class,'remove_data_form']);
Route::view('/admin/themcauhoi','admin.themcauhoi');
Route::get('/admin/themcauhoi',[Question_Controller::class,'index'])->name('index.index');
Route::post('ss',[Question_Controller::class,'add_data'])->name('add.data');
Route::get('/edit/{id}',[Question_Controller::class,'find_id_edit']);
Route::put('/ss',[Question_Controller::class,'edit_data'])->name('edit_data');
Route::delete('delete/{id}',[Question_Controller::class,'remove_data']);
Route::get('/admin/trangxephang',[loginController::class,'lay_data_xephang']);
Route::post('/adminlogin',[loginController::class,'adminlogin']);
Route::get('/khach',[loginController::class,'show_phanloai']);
Route::post('/khach/khachlambai',[loginController::class,'show_id_soHL']);
Route::post('/ketquakhach',[loginController::class,'ketquakhach']);