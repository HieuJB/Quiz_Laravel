<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Excel;
use Session;
use App\Imports\sinhvienImport;
use App\Imports\import_cauhoidiemdanh;
use App\Models\model_sinhvien;
use App\Models\model_cauhoidiemdanh;
use App\Models\model_lichsucauhoidiemdanh;
use App\Models\model_diemdanh;
use App\Models\model_diemdanhtest;
use DataTables;

class import_sinhvien extends Controller
{
    public function import_sinhvien(Request $req){
       Excel::import(new sinhvienImport,$req->file);
       return redirect('/giaovien/sinhvien')->with('themthanhcong','Thêm thành công');
    }
    public function import_cus_sv(Request $req){
        $data = new model_sinhvien();
        $data->msv=$req->msv;
        $data->hoten=$req->hoten;
        $data->lop=$req->lop;
        $data->mahocphan=$req->mahocphan;
        $data->tenmonhoc=$req->tenmonhoc;
        $data->giaovien=session('email1');
        $data->save();
    }
    public function find_id_edit_sv(Request $req){
        $Data_find = model_sinhvien::find($req->id);
        return Response()->json($Data_find);
    }
    public function edit_details_sv(Request $req){
        $data = model_sinhvien::find($req->id);
        $data->msv=$req->msv;
        $data->hoten=$req->hoten;
        $data->lop=$req->lop;
        $data->mahocphan=$req->mahocphan;
        $data->tenmonhoc=$req->tenmonhoc;
        $data->giaovien=$req->giaovien;
        $data->save();
        return response()->json($data);
    }
    public function remove_data_sv(Request $req){
        $data_remove = model_sinhvien::find($req->id);
        $data_remove->delete();
        return Response()->json($data_remove);
    }
    
    public function getdata_monhoc(Request $request){
        $data_mhp=model_sinhvien::where('giaovien',session('email1'))->distinct()->get('mahocphan');
        $data_tmh=model_sinhvien::where('giaovien',session('email1'))->distinct()->get('tenmonhoc');
        $data_mhp1=$data_mhp;
        $data_tmh1=$data_tmh;
        $data_mhp2=$data_mhp;
        $data_tmh2=$data_tmh;
        $data_mhp3=$data_mhp;
        $data_tmh3=$data_tmh;
        
        $books = model_cauhoidiemdanh::where('giaovien',session('email1'))->get();;
        if($request->ajax()){
            $data = model_cauhoidiemdanh::where('giaovien',session('email1'))->get();;
            return DataTables::of($data)->addIndexColumn()->addColumn('action',function($row){
                $btn = '<a href="javascript:void(0)"  data-toggle="tooltip" id="edit" data-id="'.$row->id.'" data-original-title="Edit"  class="edit btn btn-primary btn-sm editBook">Edit</a>';
                $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip" id="remove"  data-id="'.$row->id.'" data-original-title="Delete" class="btn btn-danger btn-sm deleteBook">Delete</a>';
                return $btn;
            })
            ->rawColumns(['action'])
            ->make(true);
        }

        return view('giaovien.themcauhoi',compact('data_mhp','data_tmh','data_mhp1','data_tmh1','data_mhp2','data_tmh2','data_mhp3','data_tmh3','books'));
    }
    public function laythongtin_diemdanh(Request $req){
        // $data1=model_cauhoidiemdanh::where('monhoc',$req->mon_hoc)->where('buoi',$req->buoi_hoc)->get();
        $data_check=model_cauhoidiemdanh::where('mahocphan',$req->mahocphan)->where('giaovien',session('email1'))->where('buoi',$req->buoi_hoc)->first();
        if(!$data_check){
            return back()->with('themthanhcong','Bạn chưa thêm dữ liệu');
        }else {
            session()->put('mahocphan',$req->mahocphan);
            session()->put('buoi_hoc',$req->buoi_hoc);
            $data=new model_lichsucauhoidiemdanh();
            $data->mahocphan=session('mahocphan');
            $data->buoi_hoc=session('buoi_hoc');
            $data->giaovien=session('email1');
            $data->lat=$req->lat;
            $data->long=$req->long;
            $data->save();
            return redirect('okmen');   
        }
    }
    public function xoa_db_session(){
        $data=model_lichsucauhoidiemdanh::where('giaovien',session('email1'))->delete();
        return "Hết giờ làm bài dữ liệu sẽ xóa";
    }
    public function showquestion_diemdanh($id){
        // $data=model_cauhoidiemdanh::where('monhoc',session('mon_hoc'))->where('buoi',session('buoi_hoc'))->get();
        // return Response()->json($data);
        $data_find=model_lichsucauhoidiemdanh::where('giaovien',$id)->first();
        if($data_find){
        $data=model_cauhoidiemdanh::where('mahocphan',$data_find['mahocphan'])->where('buoi',$data_find['buoi_hoc'])->where('giaovien',$id)->get();
        return view('giaovien.trangthi',compact('data'));
        }else{
            return "Bạn không có quyền truy cập khi không có sự đồng ý của giáo viên";
        }
    }
    public function check_msv(Request $req){
        $data_show_hide="buoi".$req->buoi;
        $data_diem_show_hide="diembuoi".$req->buoi;
        $data=model_sinhvien::where('msv',$req->msv)->first();
        $score = 0;
        if(!$data){
            return "MÃ SINH VIÊN CỦA BẠN KHÔNG TỒN TẠI!!!";
        }else{ 
            
            for($i=1;$i<=count($req->q);$i++){
                if($req->anscx[$i]==$req->a[$i]){
                    $score=$score+2;
                }
            };
            $data_check_tontai=model_diemdanhtest::where('giaovien',$req->giaovien)->where('monhoc',$req->monhoc)
            ->where('mahocphan',$req->mahocphan)->where('msv',$req->msv)->first();
            if($data_check_tontai){
                $data_check_dalam=model_diemdanhtest::where('msv',$req->msv)->first();
                if($data_check_dalam['buoi'.$req->buoi]!=='0'){
                    return "Bạn đã làm bài rồi!!!";
                }else {
                    $data_find=model_diemdanhtest::find($data_check_tontai['id']);
                    $data_find->msv=$req->msv;
                    $data_find->hoten=$data->hoten;
                    $data_find->lop=$data->lop;
                    $data_find->$data_show_hide="Có";
                    $data_find->$data_diem_show_hide=$score;
                    $data_find->save();
                    return "Cảm ơn".$data->hoten."bạn đã điểm danh thành công";
                }

                // $data_find=model_diemdanhtest::find($data_check_tontai['id']);
                // $data_find->msv=$req->msv;
                // $data_find->hoten=$data->hoten;
                // $data_find->lop=$data->lop;
                // $data_find->$data_show_hide="Có";
                // $data_find->$data_diem_show_hide=$score;
                // $data_find->save();
                // return "Cảm ơn".$data->hoten."bạn đã điểm danh thành công";
            }else {
                $data_diemdanh=new model_diemdanhtest();
                $data_diemdanh->msv=$req->msv;
                $data_diemdanh->hoten=$data->hoten;
                $data_diemdanh->lop=$data->lop;
                $data_diemdanh->buoi1="";
                $data_diemdanh->diembuoi1="";
                $data_diemdanh->buoi2="";
                $data_diemdanh->diembuoi2="";
                $data_diemdanh->buoi3="";
                $data_diemdanh->diembuoi3="";
                $data_diemdanh->buoi4="";
                $data_diemdanh->diembuoi4="";
                $data_diemdanh->buoi5="";
                $data_diemdanh->diembuoi5="";
                $data_diemdanh->buoi6="";
                $data_diemdanh->diembuoi6="";
                $data_diemdanh->buoi7="";
                $data_diemdanh->diembuoi7="";
                $data_diemdanh->buoi8="";
                $data_diemdanh->diembuoi8="";
                $data_diemdanh->buoi9="";
                $data_diemdanh->diembuoi9="";
                $data_diemdanh->buoi10="";
                $data_diemdanh->diembuoi10="";
                $data_diemdanh->$data_show_hide="Có";
                $data_diemdanh->$data_diem_show_hide=$score;
                $data_diemdanh->mahocphan=$req->mahocphan;
                $data_diemdanh->monhoc=$req->monhoc;
                $data_diemdanh->giaovien=$req->giaovien;
                $data_diemdanh->save();
                return "Cảm ơn".$data->hoten."bạn đã điểm danh thành công";

                // return response()->json($data_diemdanh);
            }
            // $data_check_tontai=model_diemdanh::where('giaovien',$req->giaovien)->where('monhoc',$req->monhoc)
            // ->where('mahocphan',$req->mahocphan)->where('msv',$req->msv)->first();
            //     if($data_check_tontai){
            //         $data_check_tontai->buoi=$data_check_tontai['buoi']."-".$req->buoi;
            //         $data_check_tontai->diem=$data_check_tontai['diem']."-".$score;
            //         $data_check_tontai->save();
            //         return "Cảm ơn".$data_check_tontai['hoten']."bạn đã điểm danh thành công";
            //     }else {
            //         $data_diemdanh=new model_diemdanh();
            //         $data_diemdanh->msv=$req->msv;
            //         $data_diemdanh->hoten=$data->hoten;
            //         $data_diemdanh->lop=$data->lop;
            //         $data_diemdanh->buoi=$req->buoi;
            //         $data_diemdanh->diem=$score;
            //         $data_diemdanh->mahocphan=$req->mahocphan;
            //         $data_diemdanh->monhoc=$req->monhoc;
            //         $data_diemdanh->giaovien=$req->giaovien;
            //         $data_diemdanh->save();
            //         return "Cảm ơn" .  $data->hoten. "bạn đã điểm danh thành công";
            //     }
        }
    }
    public function add_cauhoi_diemdanh(Request $req){
        $data=new model_cauhoidiemdanh();
        $data->cauhoi=$req->cauhoi;
        $data->ansa=$req->ansa;
        $data->ansb=$req->ansb;
        $data->ansc=$req->ansc;
        $data->ansd=$req->ansd;
        $data->caucx=$req->caucx;
        $data->buoi=$req->buoi;
        $data->mahocphan=$req->mahocphan;
        $data->monhoc=$req->monhoc;
        $data->giaovien=session('email1');
        $data->save();
        return response()->json($data);
    }
    public function excel_cauhoidiemdanh(Request $req){
        Excel::import(new import_cauhoidiemdanh,$req->file);
        return redirect('/giaovien/themcauhoi')->with('themthanhcong','Thêm thành công');
    }
    public function get_cauhoi_diemdanh(Request $req){
        $data = model_cauhoidiemdanh::find($req->id);
        return response()->json($data);

    }
    public function cauhoi_diemdanh(Request $req){
        $data = model_cauhoidiemdanh::find($req->id);
        $data->cauhoi=$req->cauhoi;
        $data->ansa=$req->ansa;
        $data->ansb=$req->ansb;
        $data->ansc=$req->ansc;
        $data->ansd=$req->ansd;
        $data->caucx=$req->caucx;
        $data->buoi=$req->buoi;
        $data->mahocphan=$req->mahocphan;
        $data->monhoc=$req->monhoc;
        $data->giaovien=session('email1');
        $data->save();
        return response()->json($data);
    }
    public function remove_data_diemdanh(Request $req){
        $data_remove = model_cauhoidiemdanh::find($req->id);
        $data_remove->delete();
        return Response()->json($data_remove);
    }
    public function hienthi_diemdanh(Request $req){
        $data_check=model_diemdanhtest::where('giaovien',session('email1'))->where('mahocphan',$req->mahocphan)->first();
        if(!$data_check){
            return back()->with('themthanhcong','Chưa có dữ liệu');
        }else{
           session()->put('mahocphan_diemdanh',$req->mahocphan);
           session()->put('monhoc',$req->monhoc);
           return redirect('giaovien/diemdanhshow');
        }
    }
    public function hienthi_danhsach(Request $request){
        $books = model_diemdanhtest::where('mahocphan',session('mahocphan_diemdanh'))->where('giaovien',session('email1'))->get();
        if($request->ajax()){
            $data = model_diemdanhtest::where('mahocphan',session('mahocphan_diemdanh'))->where('giaovien',session('email1'))->get();
            return DataTables::of($data)->addIndexColumn()->addColumn('action',function($row){
                $btn = '<a href="javascript:void(0)"  data-toggle="tooltip" id="edit" data-id="'.$row->id.'" data-original-title="Edit"  class="edit btn btn-primary btn-sm editBook">Edit</a>';
                $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip" id="remove"  data-id="'.$row->id.'" data-original-title="Delete" class="btn btn-danger btn-sm deleteBook">Delete</a>';
                return $btn;
            })
            ->rawColumns(['action'])
            ->make(true);
        }
        // return $books;
        return view('giaovien.diemdanhshow',compact('books'));
    }
    public function diemdanhthucong(Request $req){
        $data=model_sinhvien::where('msv',$req->msv)->first();
        $data_find="buoi".$req->buoi;
        $data_find_diem="diembuoi".$req->buoi;
        if($data){
            $data_check_tontai = model_diemdanhtest::where('msv',$req->msv)->where('mahocphan',session('mahocphan'))->where('monhoc',session('monhoc'))->where('giaovien',session('email1'))->first();
            if($data_check_tontai){
                return back()->with('themthanhcong','THÔNG TIN SINH VIÊN ĐÃ CÓ TRONG CSDL XIN HÃY SỬ DỤNG CHỨC NĂNG CẬP NHẬT');
            }else{
                $data_add=new model_diemdanhtest();
                $data_add->msv=$req->msv;
                $data_add->hoten=$data['hoten'];
                $data_add->lop=$data['lop'];
                $data_add->buoi1="";
                $data_add->diembuoi1="";
                $data_add->buoi2="";
                $data_add->diembuoi2="";
                $data_add->buoi3="";
                $data_add->diembuoi3="";
                $data_add->buoi4="";
                $data_add->diembuoi4="";
                $data_add->buoi5="";
                $data_add->diembuoi5="";
                $data_add->buoi6="";
                $data_add->diembuoi6="";
                $data_add->buoi7="";
                $data_add->diembuoi7="";
                $data_add->buoi8="";
                $data_add->diembuoi8="";
                $data_add->buoi9="";
                $data_add->diembuoi9="";
                $data_add->buoi10="";
                $data_add->diembuoi10="";
                $data_add->$data_find='Có';
                $data_add->$data_find_diem=$req->diem;
                $data_add->mahocphan=session('mahocphan');
                $data_add->monhoc=session('monhoc');
                $data_add->giaovien=session('email1');
                $data_add->save();
                return back()->with('themthanhcong','ĐIỂM DANH THỦ CÔNG THÀNH CÔNG');
            }
        }else {
            return back()->with('themthatbai','MÃ SINH VIÊN BẠN NHẬP KHÔNG CÓ TRONG DỮ LIỆU!!!');
        }
    }

    public function get_info_svdiemdanh(Request $req){
        $data=model_diemdanhtest::find($req->id);
        return Response()->json($data);
    }
    public function edit_info_diemdanh(Request $req){
        $buoi_edit="buoi".$req->buoi_edit_diemdanh;
        $diem_edit="diembuoi".$req->buoi_edit_diemdanh;
        $data_add=model_diemdanhtest::find($req->id);
        $data_add->$buoi_edit="Có";
        $data_add->$diem_edit=$req->diem_edit_diemdanh;
        $data_add->save();
        return back()->with('themthanhcong','CẬP NHẬT THÀNH CÔNG!!!');
    }
    public function remove_info_diemdanh(Request $req){
        $data_remove = model_diemdanhtest::find($req->id);
        $data_remove->delete();
        return Response()->json($data_remove);
    }    
    public function get_check_msv($id){
        return view('giaovien.verify_msv',compact('id'));
    }   
    public function check_msv_lat_long(Request $req){
        $data=model_sinhvien::where('msv',$req->msv)->first();
        if(!$data){
            return back()->with('thatbai','MÃ SINH VIÊN CỦA BẠN KHÔNG TỒN TẠI!!!');
        }
        else {
            $data_check=model_lichsucauhoidiemdanh::where('giaovien',$req->giaovien)->where('lat',$req->lat)->where('long',$req->long)->first();
            if(!$data_check){
                return back()->with('thatbai',"VỊ TRÍ CỦA BẠN KHÔNG HỢP LỆ");
            }
            else {
                session()->put('msv_check',$req->msv);
                $data_find=model_lichsucauhoidiemdanh::where('giaovien',$req->giaovien)->first();
                    if($data_find){
                    $data=model_cauhoidiemdanh::where('mahocphan',$data_find['mahocphan'])->where('buoi',$data_find['buoi_hoc'])->where('giaovien',$req->giaovien)->get();
                    return view('giaovien.trangthi',compact('data'));
                        }else{
                            return "Bạn không có quyền truy cập khi không có sự đồng ý của giáo viên";
                        } 
            }
        }
    }
}
