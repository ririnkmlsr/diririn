<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\provinsi;

class ProvinsiController extends Controller
{
    public function index() {

        $provinsi = Provinsi::latest()->get();
        $res = [
            'succees' => true,
            'data' => $provinsi,
            'message' => 'Data Provinsi Ditampilkan'
        ];
        
        return response()->json($res,200);

    }

    public function store(Request $request)
    {

        $provinsi = new Provinsi;
        $provinsi->kode_provinsi = $request->kode_provinsi;
        $provinsi->nama_provinsi = $request->nama_provinsi;
        $provinsi->save();
        

        $res = [
            'succees' => true,
            'data' => $provinsi,
            'message' => 'Data Berhasil Ditambahkan'
        ];
        return response()->json($res,200);
    }

     public function show($id)
    {
        $provinsi = Provinsi::whereId($id)->first();

        if ($provinsi) {
            $res = [
                'succees' => true,
                'data' => $provinsi,
                'message' => 'Data Provinsi Berhasil Ditampilkan'
            ];
            
            return response()->json($res,200);
        } else {
            return response()->json([
                'succees' => false,
            'data' => '',
            'message' => 'Data Provinsi Tidak Ada'
            ], 404);
        }
    }

    public function destroy($id)
    {
        $provinsi = Provinsi::findOrFail($id);
        $provinsi->delete();

        if ($provinsi) {
            return response()->json([
                'success' => true,
                'message' => 'Post Berhasil Dihapus!',
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Post Gagal Dihapus!',
            ], 200);
        }
    }   

}