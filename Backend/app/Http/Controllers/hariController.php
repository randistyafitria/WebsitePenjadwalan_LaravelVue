<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\hariModel;
use Illuminate\Support\Facades\Validator;

class hariController extends Controller
{

     //Method GET All
     public function index()
     {
         //get data from table posts
         $post = hariModel::get();
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
        $posts = hariModel::where('kode',$id)->first();
        //make response JSON
        return response()->json([
            'success' => true,
            'message' => 'Detail Data Post',
            'data'    => $posts 
        ], 200);
    }

    //Method POST data hari
    public function store(Request $request)
    {
        //set validation
        $validator = Validator::make($request->all(), [
            'nama'      => 'required',
        ]);
        //response error validation
        if ($validator->fails()){
            return response()->json($validator->errors(), 400);
        }
        //save to database
        $post = hariModel::create([
            'nama'      => $request->nama,
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

    //Method PUT data hari by ID
    public function update(Request $request, $id)
    {
        //set validation
        $validator = Validator::make($request->all(),[
            'nama'=>'required',

        ]);

        //response error validation
        if($validator->fails()){
            return response()->json($validator->errors()->toJson());
        }
        $post=hariModel::where('kode', $id)->update([
            'nama'    =>$request->get('nama'),
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

    //Method DELETE data Hari
    public function destroy($id)
    {
        //find post by ID
        $post = hariModel::where('kode',$id);

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