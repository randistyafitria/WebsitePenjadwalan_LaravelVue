<?php

namespace App\Http\Controllers;

use App\Models\Matakuliah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MatakuliahController extends Controller
{
    /**
     * index
     * 
     * @return void
     */

     public function index()
     {
         //get data from table matakuliahs
         $post = Matakuliah::get();
         return response()->json($post);

         //make response JSON
         return response()->json([
             'success' => true,
             'message' => 'List Data Matakuliah',
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
        //find matakuliah by ID
        $posts = Matakuliah::where('kode',$id)->first();

        //make response JSON
        return response()->json([
            'success' => true,
            'message' => 'Detail Data Matakuliah',
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
           'kode_mk'   => 'required',
            'nama' => 'required',
            'sks' => 'required',
            'semester' => 'required',
            'aktif' => 'required',
            'jenis' => 'required'
        ]);

        //response error validation
        if ($validator->fails()){
            return response()->json($validator->errors(), 400);
        }

        //save to database
        $post = Matakuliah::create([
            'kode_mk'=> $request->kode_mk,
            'nama'=> $request->nama,
            'sks'=> $request->sks,
            'semester'=> $request->semester,
            'aktif'=> $request->aktif,
            'jenis'=> $request->jenis
        ]);

        //success save to database
        if($post) {
            return response()->json([
                'success' => true,
                'message' => 'Matakuliah Created',
                'data'    => $post  

            ], 201);
        }

        //failed save to database
        return response()->json([
            'success' => false,
            'message' => 'Matakuliah Failed to Save',
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
            'kode_mk'   => 'required',
            'nama' => 'required',
            'sks' => 'required',
            'semester' => 'required',
            'aktif' => 'required',
            'jenis' => 'required'
        ]);

        //response error validation
        if($validator->fails()){
            return response()->json($validator->errors()->toJson());
        }
        $post=Matakuliah::where('kode', $id)->update([
            'kode_mk'=> $request->kode_mk,
            'nama'=> $request->nama,
            'sks'=> $request->sks,
            'semester'=> $request->semester,
            'aktif'=> $request->aktif,
            'jenis'=> $request->jenis
        ]);
        if($post){
            return response()->json([
                'status'  =>true, 
                'message' =>'Matakuliah Updated',
                // 'data'    => $post 
            ], 200);
        } else {
            return response()->json([
                'status'  =>false, 
                'message' =>'Matakuliah Failed to Update'
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
        //find matakuliah by ID
        $post = Matakuliah::where('kode',$id);

        if($post){
            
            //delete matakuliah
            $post->delete();

            return response()->json([
                'success' => true,
                'message' => 'Matakuliah Deleted',
            ], 200);
        }

        //data matakuliah not found
        return response()->json([
            'success' => false,
            'message' => 'Matakuliah Not Found',
        ], 404);
    }
}