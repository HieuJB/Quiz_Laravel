<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\userModel;
use App\Models\model_question;
use App\Models\Model_history;
use Illuminate\Support\Facades\Hash;
use Session;


class loginController extends Controller
{
    public function dangky(Request $req){
        $data_get = userModel::where('username','=',$req->tendangnhap)->first();
        if($req->hoten==""){
            return back()->with('fail1','Vui lòng nhập đầy đủ thông tin');
        }
        if($req->email==""){
            return back()->with('fail1','Vui lòng nhập đầy đủ thông tin');
        }
        if($req->tendangnhap==""){
            return back()->with('fail1','Vui lòng nhập đầy đủ thông tin');
        }
        if($req->matkhau==""){
            return back()->with('fail1','Vui lòng nhập đầy đủ thông tin');
        }
        $req->validate([
            'email'=>'required|email',
            'matkhau'=>'required|max:12|min:5',
        ]);
        if($data_get){
            return back()->with('fail','database dang gap loi');
        }else{
            $data_dangky = new userModel;
            $data_dangky->name = $req->hoten;
            $data_dangky->email = $req->email;
            $data_dangky->username = $req->tendangnhap;
            $data_dangky->password = Hash::make($req->matkhau);
            $noti = $data_dangky->save();
            if($noti){
                return back()->with('thanhcong','sdasa');
            }
            else{
                return back()->with('fail','dsada');
            }
        }
    }
    public function xulydangnhap(Request $req){
        $users = userModel::where('username','=',$req->tendangnhap)->first();
        if(!$users||!Hash::check($req->matkhau,$users->password)){
            return back()->with('Saimk','Sai mật khẩu');
        }
        else{
            session()->put('email',$req->tendangnhap);
            return redirect('home')->with('tendangnhap',$req->tendangnhap);
        }
    }
    public function dangxuat(){
        session()->forget('email');
        return redirect('index');
    }
    public function thongtin_canhan(){
        $userss = userModel::where('username','=',session('email'))->first();
        return view('trangcanhan',compact('userss'));
    }
    public function capnhat(Request $req){
        if(!Hash::check($req->nhapmatkhaucu,$req->matkhaucu)){
            return back()->with('thatbai','Vui lòng nhập đúng mật khẩu');
        }else{
            $data_update = userModel::find($req->id);
            $data_update->name = $req->name;
            $data_update->email = $req->email;
            $data_update->password = Hash::make($req->matkhau);
            $data_update->save();
            return back()->with('thanhcong','Cật nhập thông tin thành công');
        }
    }
    public function show_question(){
        $question_show = model_question::all()->random(10);
        return view('trangthuchanh',compact('question_show'));
    }
    public function SaveAns(Request $req){
        $data2=[];
        for($i=1;$i<=count($req->q);$i++){
            $data2[] = [
                'question'=>$req->q[$i],
                'ansa'=>$req->ansa[$i],
                'ansb'=>$req->ansb[$i],
                'ansc'=>$req->ansc[$i],
                'ansd'=>$req->ansd[$i],
                'ansCX'=>$req->ansCX[$i],
                'ansLC'=>$req->a[$i],
                'session'=>$req->email[$i],
            ];
        };
        Model_history::insert($data2);      
    }
    public function results(){
        $score_result = Model_history::all()->where('session','',session('email'));
        $score = 0;
        foreach($score_result as $i=>$score_results){
            if($score_results->ansCX == $score_results->ansLC){
                $score++;
            }
        }
        return view('results',compact('score'));
    }
}
