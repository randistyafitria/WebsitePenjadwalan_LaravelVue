<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ruangModel;
use Illuminate\Support\Facades\Validator;

class ruangController extends Controller
{
    /**
     * index
     * 
     * @return void
     */

     public function index()
     {
         //get data from table posts
         $post = ruangModel::get();
         return response()->json($post);

         //make response JSON
         return response()->json([
             'success' => true,
             'message' => 'List Data Ruang',
             'data'    => $post
         ], 200);

     }

     /**
     * show
     *
     * @param  mixed $id
     * @return void
     */
    public function show($id)
    {
        //find post by ID
        $posts = ruangModel::where('kode',$id)->first();

        //make response JSON
        return response()->json([
            'success' => true,
            'message' => 'Detail Data Ruang',
            'data'    => $posts 
        ], 200);
    }

        /**
     * store
     *
     * @param  mixed $request
     * @return void
     */
    public function store(Request $request)
    {
        //set validation
        $validator = Validator::make($request->all(), [
            'nama'      => 'required',
            'kapasitas' => 'required',
            'jenis'     => 'required',
        ]);

        //response error validation
        if ($validator->fails()){
            return response()->json($validator->errors(), 400);
        }

        //save to database
        $post = ruangModel::create([
            'nama'      => $request->nama,
            'kapasitas' => $request->kapasitas,
            'jenis'     => $request->jenis,
        ]);

        //success save to database
        if($post) {
            return response()->json([
                'success' => true,
                'message' => 'Ruang Created',
                'data'    => $post  

            ], 201);
        }

        //failed save to database
        return response()->json([
            'success' => false,
            'message' => 'Ruang Failed to Save',
        ], 409);
    }

        /**
     * update
     *
     * @param  mixed $request
     * @param  mixed $post
     * @return void
     */
    public function update(Request $request, $id)
    {
        //set validation
        $validator = Validator::make($request->all(),[
            'nama'      =>'required',
            'jenis'     =>'required',
            'kapasitas' =>'required',
        ]);

        //response error validation
        if($validator->fails()){
            return response()->json($validator->errors()->toJson());
        }
        $post=ruangModel::where('kode', $id)->update([
            'nama'      =>$request->nama,
            'jenis'     =>$request->jenis,
            'kapasitas' =>$request->kapasitas,
        ]);
        if($post){
            return response()->json([
                'status'  =>true, 
                'message' =>'Ruang Updated',
                // 'data'    => $post 
            ], 200);
        } else {
            return response()->json([
                'status'  =>false, 
                'message' =>'Ruang Failed to Update'
            ], 404);
        }
    }

    /**
     * destroy
     *
     * @param  mixed $id
     * @return void
     */
    public function destroy($id)
    {
        //find post by ID
        $post = ruangModel::where('kode',$id);

        if($post){
            
            //delete post
            $post->delete();

            return response()->json([
                'success' => true,
                'message' => 'Ruang Deleted',
            ], 200);
        }

        //data post not found
        return response()->json([
            'success' => false,
            'message' => 'Ruang Not Found',
        ], 404);
    }
}