<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Jammodel;
use Illuminate\Support\Facades\Validator;

class Jamcontroller extends Controller
{
    /**
     * index
     * 
     * @return void
     */

     public function index()
     {
         //get data from table posts
         $post = Jammodel::get();
         return response()->json($post);

         //make response JSON
         return response()->json([
             'success' => true,
             'message' => 'List Data Post',
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
        $posts = Jammodel::where('kode',$id)->first();

        //make response JSON
        return response()->json([
            'success' => true,
            'message' => 'Detail Data Post',
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
            'range_jam' => 'required',
            'aktif'     => 'required',
        ]);

        //response error validation
        if ($validator->fails()){
            return response()->json($validator->errors(), 400);
        }

        //save to database
        $post = Jammodel::create([
            'range_jam' => $request->range_jam,
            'aktif'     => $request->aktif,
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
            'range_jam' => 'required',
            'aktif'     => 'required',
        ]);

        //response error validation
        if($validator->fails()){
            return response()->json($validator->errors()->toJson());
        }
        $post=Jammodel::where('kode', $id)->update([
            'range_jam'  =>$request->get('range_jam'),
            'aktif'      =>$request->get('aktif'),
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

    /**
     * destroy
     *
     * @param  mixed $id
     * @return void
     */
    public function destroy($id)
    {
        //find post by ID
        $post = Jammodel::where('kode',$id);

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