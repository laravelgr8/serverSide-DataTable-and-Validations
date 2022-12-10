<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use DataTables;
class UserController extends Controller
{
    public function index(){
        return view('student-form');
    }

    public function save(Request $request){
        $request->validate([
            "name" => 'required',
            "email" => 'required',
            "password" => 'required',
            "mobile*" => 'required'
        ]);

        //for image
        if ($request->hasFile('pic')) {
            $file = $request->file('pic');
            $fileName = time() . '-' . $file->getClientOriginalName();
            // dd($fileName);
            $fileUploaded = $file->move(public_path() . '/uploads/', $fileName);
            if ($fileUploaded) {
                $File_Uploaded_Status = 1;
                $Document_FileName = $fileName;
            }
        } else {
            $Document_FileName = '';
        }

        $data=[
            "name" =>$request->name,
            "email" =>$request->email,
            "password" =>$request->password,
            "gender" =>"F",
            "qualification" =>"MCA",
            "pic" =>$Document_FileName
        ];

        

        try{
           DB::begintransaction(); 
           $sql=DB::table('students')->insertGetId($data);
           $lastid=$sql;
           foreach($request->mobile as $key => $value){
            $sql1=DB::table('mobiles')->insert([
                "student_id" =>$lastid,
                "mobile" =>$request->mobile[$key]
            ]);
           }
           DB::commit();  
           return back()->with('message',"Student Create");       
        }
        catch (Exception $e){
            DB::rollback();
            return back()->with('message',"Some Error");  
        }

    }



    public function show(Request $request)
    {
        if ($request->ajax()) {
            // $data = User::select('*');
            $i=1;
            $data=DB::table('students')->get();
            // dd($data['id']);
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
       
                            $btn = '<a href="javascript:void(0)" data-eid="'.$row->id.'" class="edit btn btn-primary btn-sm">Edit</a>
                            <a href="javascript:void(0)" data-did="'.$row->id.'" class="delete btn btn-danger btn-sm">Delete</a>';
      
                            return $btn;
                    })
                    ->addColumn('pic', function($row){
                            // $path=public_path("uploads/$row->pic");
                            // $pic = '<img src="'.public_path()."/uploads/".$row->pic.'">';
                            $pic="<img src='".public_path('uploads/'.$row->pic)."'>";
                            // $pic='<img src="'.$path.'">';
                            // $pic='<img src="https://www.simplilearn.com/ice9/free_resources_article_thumb/what_is_image_Processing.jpg">';
                            return $pic;
                    })
                    
                    
                    ->rawColumns(['action','pic'])
                    ->make(true);
        }
          
        return view('student-form');
    }
}
