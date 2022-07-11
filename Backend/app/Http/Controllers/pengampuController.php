<?php

namespace App\Http\Controllers;

use App\Models\pengampu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class pengampuController extends Controller
{
    public function index()
    {
      
        $pengampu = pengampu::get();
        return response()->json($pengampu);

       
        return response()->json([
            'success' => true,
            'message' => 'List Data Pengampu',
            'data'    => $pengampu
        ], 200);

    }
   public function show($kode)
   {
      
       $pengampu = pengampu::where('kode',$kode)->first();

      
       return response()->json([
           'success' => true,
           'message' => 'Detail Data Pengampu',
           'data'    => $pengampu
       ], 200);
   }

      
   public function store(Request $request)
   {
       $validator = Validator::make($request->all(), [
           'kode_mk'      => 'required',
           'kode_dosen' => 'required',
           'kelas'     => 'required',
           'tahun_akademik' => 'required'
       ]);


       if ($validator->fails()){
           return response()->json($validator->errors(), 400);
       }

      
       $pengampu = pengampu::create([
           'kode_mk'      => $request->kode_mk,
           'kode_dosen' => $request->kode_dosen,
           'kelas'     => $request->kelas,
           'tahun_akademik'     => $request->tahun_akademik
       ]);

       
       if($pengampu) {
           return response()->json([
               'success' => true,
               'message' => 'Pengampu Created',
               'data'    => $pengampu 

           ], 201);
       }

       return response()->json([
           'success' => false,
           'message' => 'Pengampu Failed to Save',
       ], 409);
   }
   public function update(Request $request, $kode)
   {
       $validator = Validator::make($request->all(),[
        'kode_mk'      => 'required',
        'kode_dosen' => 'required',
        'kelas'     => 'required',
        'tahun_akademik'     => 'required',
       ]);

       //response error valkodeation
       if($validator->fails()){
           return response()->json($validator->errors()->toJson());
       }
       $pengampu=pengampu::where('kode', $kode)->update([
        'kode_mk'      => $request->kode_mk,
        'kode_dosen' => $request->kode_dosen,
        'kelas'     => $request->kelas,
        'tahun_akademik'     => $request->tahun_akademik
       ]);
       if($pengampu){
           return response()->json([
               'status'  =>true, 
               'message' =>'Pengampu Updated',
           ], 200);
       } else {
           return response()->json([
               'status'  =>false, 
               'message' =>'Pengampu Failed to Update'
           ], 404);
       }
   }
   public function destroy($kode)
   {
       //find pengampu by kode
       $pengampu= pengampu::where('kode',$kode);

       if($pengampu){
           
           //delete pengampu
           $pengampu->delete();

           return response()->json([
               'success' => true,
               'message' => 'pengampu Deleted',
           ], 200);
       }

       //data pengampu not found
       return response()->json([
           'success' => false,
           'message' => 'pengampu Not Found',
       ], 404);
   }
}