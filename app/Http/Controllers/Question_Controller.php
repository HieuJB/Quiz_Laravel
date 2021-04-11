<?php

namespace App\Http\Controllers;
use App\Models\model_question;
use DataTables;
use Excel;
use App\Imports\import_question;

use Illuminate\Http\Request;

class Question_Controller extends Controller
{
    public function index(Request $request)
    {
        $books = model_question::all();
        if($request->ajax()){
            $data = model_question::all();
            return DataTables::of($data)->addIndexColumn()->addColumn('action',function($row){
                $btn = '<a href="javascript:void(0)"  data-toggle="tooltip" id="edit" data-id="'.$row->id.'" data-original-title="Edit"  class="edit btn btn-primary btn-sm editBook">Edit</a>';
                $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip" id="remove"  data-id="'.$row->id.'" data-original-title="Delete" class="btn btn-danger btn-sm deleteBook">Delete</a>';
                return $btn;
            })
            ->rawColumns(['action'])
            ->make(true);
        }
        return view('admin.themcauhoi',compact('books'));
    } 
    public function add_data(Request $req){
        $data_add = new model_question();
        $data_add->question=$req->question;
        $data_add->ansa=$req->ansa;
        $data_add->ansb=$req->ansb;
        $data_add->ansc=$req->ansc;
        $data_add->ansd=$req->ansd;
        $data_add->ansCX=$req->ansCX;
        $data_add->ansPL=$req->ansPL;
        $data_add->save();
        return Response()->json($data_add);
    }
    public function find_id_edit(Request $req){
        $Data_find = model_question::find($req->id);
        return Response()->json($Data_find);
    }
    public function edit_data(Request $req){
        $data_edit = model_question::find($req->id);
        $data_edit->question=$req->question;
        $data_edit->ansa=$req->ansa;
        $data_edit->ansb=$req->ansb;
        $data_edit->ansc=$req->ansc;
        $data_edit->ansd=$req->ansd;
        $data_edit->ansCX=$req->ansCX;
        $data_edit->ansPL=$req->ansPL;
        $data_edit->save();
        return Response()->json($data_edit);
    }
    public function remove_data(Request $req){
        $data_remove = model_question::find($req->id);
        $data_remove->delete();
        return Response()->json($data_remove);
    }
    public function import_question(Request $req){
        Excel::import(new import_question,$req->file1);
        return redirect('/admin/themcauhoi')->with('themthanhcong','Thêm thành công');
        // return "them thanh cong";
    }
}
