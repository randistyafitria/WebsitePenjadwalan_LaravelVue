<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\userModel;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class userController extends Controller
{
     /**
     * index
     * 
     * @return void
     */

    public function index()
    {
        //get data from table posts
        $post = userModel::get();
        return response()->json($post);

        //make response JSON
        return response()->json([
            'success' => true,
            'message' => 'List Data User',
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
       $post = userModel::findOrfail($id);

       //make response JSON
       return response()->json([
           'success' => true,
           'message' => 'Detail Data User',
           'data'    => $post
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
           'username'   => 'required',
           'pass'       => 'required',
           'level'      => 'required',
       ]);

       //response error validation
       if ($validator->fails()){
           return response()->json($validator->errors(), 400);
       }

       //save to database
       $post = userModel::create([
           'username'   => $request->username,
           'pass'       => Hash::Make($request->pass),
           'level'      => $request->level,
       ]);

       //success save to database
       if($post) {
           return response()->json([
               'success' => true,
               'message' => 'User Created',
               'data'    => $post  

           ], 201);
       }

       //failed save to database
       return response()->json([
           'success' => false,
           'message' => 'User Failed to Save',
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
           'username'  =>'required',
           'pass'      =>'required',
           'level'     =>'required',
       ]);

       //response error validation
       if($validator->fails()){
           return response()->json($validator->errors()->toJson());
       }
       $post= userModel::where('id', $id)->update([
           'username'   =>$request->username,
           'pass'       => Hash::Make($request->pass),
           'level'      =>$request->level,
       ]);
       if($post){
           return response()->json([
               'status'  =>true, 
               'message' =>'User Updated',
               // 'data'    => $post 
           ], 200);
       } else {
           return response()->json([
               'status'  =>false, 
               'message' =>'User Failed to Update'
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
        $post = userModel::findOrfail($id);;

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
