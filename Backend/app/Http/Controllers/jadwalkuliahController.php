<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\jadwalkuliahModel;
use Illuminate\Support\Facades\Validator;

class jadwalkuliahController extends Controller
{
     /**
     * index
     * 
     * @return void
     */

    public function index()
    {
        //get data from table posts
        $post = jadwalkuliahModel::get();
        return response()->json($post);

        //make response JSON
        return response()->json([
            'success' => true,
            'message' => 'List Data Jadwal Kuliah',
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
       $posts = jadwalkuliahModel::where('kode',$id)->first();

       //make response JSON
       return response()->json([
           'success' => true,
           'message' => 'Detail Data Jadwal Kuliah',
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
            'kode_pengampu' => 'required',
            'kode_jam'      => 'required',
            'kode_hari'     => 'required',
            'kode_ruang'    => 'required',
       ]);

       //response error validation
       if ($validator->fails()){
           return response()->json($validator->errors(), 400);
       }

       //save to database
       $post = jadwalkuliahModel::create([
            'kode_pengampu'     => $request->kode_pengampu,
            'kode_jam'          => $request->kode_jam,
            'kode_hari'         => $request->kode_hari,
            'kode_ruang'        => $request->kode_ruang,
       ]);

       //success save to database
       if($post) {
           return response()->json([
               'success' => true,
               'message' => 'Jadwal Kuliah Created',
               'data'    => $post  

           ], 201);
       }

       //failed save to database
       return response()->json([
           'success' => false,
           'message' => 'Jadwal Kuliah Failed to Save',
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
            'kode_pengampu' => 'required',
            'kode_jam'      => 'required',
            'kode_hari'     => 'required',
            'kode_ruang'    => 'required',
       ]);

       //response error validation
       if($validator->fails()){
           return response()->json($validator->errors()->toJson());
       }
       $post= jadwalkuliahModel::where('kode', $id)->update([
            'kode_pengampu'     => $request->kode_pengampu,
            'kode_jam'          => $request->kode_jam,
            'kode_hari'         => $request->kode_hari,
            'kode_ruang'        => $request->kode_ruang,
       ]);
       if($post){
           return response()->json([
               'status'  =>true, 
               'message' =>'Jadwal Kuliah Updated',
            //    'data'    => $post 
           ], 200);
       } else {
           return response()->json([
               'status'  =>false, 
               'message' =>'Jadwal Kuliah Failed to Update'
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
       $post = jadwalkuliahModel::where('kode',$id);

       if($post){
           
           //delete post
           $post->delete();

           return response()->json([
               'success' => true,
               'message' => 'Jadwal Kuliah Deleted',
           ], 200);
       }

       //data post not found
       return response()->json([
           'success' => false,
           'message' => 'Jadwal Kuliah Not Found',
       ], 404);
   }
}
