<?php

namespace App\Http\Controllers;

use App\Models\waktu_tidak_bersediaModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class waktu_tidak_bersediaController extends Controller
{

    //Method GET All
    public function index()
    {
        //get data from table posts
        $post = waktu_tidak_bersediaModel::get();
        return response()->json($post);

        //make response JSON
        return response()->json([
            'success' => true,
            'message' => 'List Data Post',
            'data'    => $post
        ], 200);

    }

   //Method GET By ID
   public function show($id)
   {
       //find post by ID
       $posts = waktu_tidak_bersediaModel::where('kode',$id)->first();
       //make response JSON
       return response()->json([
           'success' => true,
           'message' => 'Detail Data Post',
           'data'    => $posts 
       ], 200);
   }

   //Method POST data Waktu tidak bersedia
   public function store(Request $request)
   {
       //set validation
       $validator = Validator::make($request->all(), [
           'kode_dosen'      => 'required',
           'kode_hari'       => 'required',
           'kode_jam'        => 'required'
       ]);
       //response error validation
       if ($validator->fails()){
           return response()->json($validator->errors(), 400);
       }
       //save to database
       $post = waktu_tidak_bersediaModel::create([
           'kode_dosen'      => $request->kode_dosen,
           'kode_hari'       => $request->kode_hari,
           'kode_jam'        => $request->kode_jam
       ]);
       //success save to database
       if($post) {
           return response()->json([
               'success' => true,
               'message' => 'Post Created',
               'data'    => $post  

           ], 201);
       }
       //failed save to database
       return response()->json([
           'success' => false,
           'message' => 'Post Failed to Save',
       ], 409);
   }

   //Method PUT data Waktu tidak bersedia by ID
   public function update(Request $request, $id)
   {
       //set validation
       $validator = Validator::make($request->all(),[
           'kode_dosen'=>'required',
           'kode_hari'=>'required',
           'kode_jam'=>'required'
       ]);

       //response error validation
       if($validator->fails()){
           return response()->json($validator->errors()->toJson());
       }
       $post=waktu_tidak_bersediaModel::where('kode', $id)->update([
           'kode_dosen'    =>$request->get('kode_dosen'),
           'kode_hari'     =>$request->get('kode_hari'),
           'kode_jam'      =>$request->get('kode_jam'),
       ]);
       if($post){
           return response()->json([
               'status'  =>true, 
               'message' =>'Post Updated',
               // 'data'    => $post 
           ], 200);
       } else {
           return response()->json([
               'status'  =>false, 
               'message' =>'Post Failed to Update'
           ], 404);
       }
   }

   //Method DELETE data Waktu tidak bersedia by ID
   public function destroy($id)
   {
       //find post by ID
       $post = waktu_tidak_bersediaModel::where('kode',$id);

       if($post){
           
           //delete post
           $post->delete();

           return response()->json([
               'success' => true,
               'message' => 'Post Deleted',
           ], 200);
       }

       //data post not found
       return response()->json([
           'success' => false,
           'message' => 'Post Not Found',
       ], 404);
   }
}
