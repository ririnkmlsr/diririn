<?php

namespace App\Http\Controllers;

use App\Models\Kasuses;
use App\Models\Rw;
use Illuminate\Http\Request;

class KasusesController extends Controller
{
    
    public function index()
    {
        $title ='Kasuses';
        $kasuses = kasuses::with('rw.kelurahan.kecamatan.kota.provinsi')->get();
        return view('kasuses.index',compact('kasuses','title'));
    }

    
    public function create()
    {
        $title = 'Tambah Data';
        return view('kasuses.create', compact('title'));
    }

    
    public function store(Request $request)
    {
        $request->validate([
            'jumlah_positif' => 'required:kasuses',
            'jumlah_meninggal' => 'required:kasuses',
            'jumlah_sembuh' => 'required:kasuses',
            'tanggal' => 'required:kasuses',
        ], [
            'jumlah_positif.required' => 'jumlah positif tidak boleh kosong',
            'jumlah_meninggal.required' => 'jumlah meninggal tidak boleh kosong',
            'jumlah_sembuh.required' => 'jumlah sembuh tidak boleh kosong',
            'tanggal.required' => ' tanggal tidak boleh kosong',

        ]);
        $kasuses = new Kasuses;
        $kasuses->jumlah_positif = $request->jumlah_positif;
        $kasuses->jumlah_sembuh = $request->jumlah_sembuh;
        $kasuses->jumlah_meninggal = $request->jumlah_meninggal;
        $kasuses->tanggal = $request->tanggal;
        $kasuses->id_rw = $request->id_rw;
        $kasuses ->save();
        return redirect()->route('kasuses.index')->with('sukses','Data Berhasil Di Tambah');
    }

    
    public function show($id)
    {
        $kasuses = Kasuses::findOrFail($id);
        $rw = Rw::all();
        return view('kasuses.show',compact('kasuses','rw'));
    }

   
    public function edit($id)
    {
        $title = 'Edit Data';
        $kasuses = Kasuses::findOrFail($id);
        $rw = Rw::all();
        return view('kasuses.edit',compact('rw','title','kasuses'));
    }

   
    public function update(Request $request, $id)
    {
        $kasuses = Kasuses::findOrFail($id);
        $kasuses->jumlah_positif = $request->jumlah_positif;
        $kasuses->jumlah_sembuh = $request->jumlah_sembuh;
        $kasuses->jumlah_meninggal = $request->jumlah_meninggal;
        $kasuses->tanggal = $request->tanggal;
        $kasuses->id_rw = $request->id_rw;
        $kasuses ->save();
        return redirect()->route('kasuses.index')->with('sukses','Data Berhasil Di Update');
    }

    
    public function destroy($id)
    {
        try{
            $kasuses = Kasuses::findOrFail($id)->delete();
            \Session::flash('sukses','Data Berhasil Di Hapus');
        }catch(\Exception $e){
            \Session::flash('gagal',$e->getMessage());
        }
        return redirect()->route("kasuses.index");
    }
}