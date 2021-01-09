<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\userModel;
use Illuminate\Support\Facades\Hash;


class loginController extends Controller
{
    public function dangky(Request $req){
        $data_dangky = new userModel;
        $data_dangky->name = $req->hoten;
        $data_dangky->email = $req->email;
        $data_dangky->username = $req->tendangnhap;
        $data_dangky->password = hash::make($req->matkhau);
        $noti = $data_dangky->save();
        return redirect('index');
        if($noti){
            Session::put('dangkytc','Đăng ký thành công');
        }else{
            Session::put('dangkytb','DB đăng gặp vấn đề');
        }
    }
}
