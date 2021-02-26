<?php

namespace App\Http\Controllers\Api;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\kasuses;
use App\Models\provinsi;
use App\Models\kota;
use App\Models\kecamatan;
use App\Models\kelurahan;

use Illuminate\Support\Facades\Http;

class ApiController extends Controller
{
    public function index()
    {
     $hariini = Carbon::now()->format('d-m-Y');
     $data = DB::table('kasuses')
        ->select(DB::raw('sum(jumlah_positif) as jumlah_positif'),
                 DB::raw('sum(jumlah_sembuh) as jumlah_sembuh'),
                 DB::raw('sum(jumlah_meninggal) as jumlah_meninggal'),
                 DB::raw('max(tanggal) as Tanggal'))
        ->whereDay('tanggal', '=' , $hariini)
        ->get();
        
    $hh = DB::table('kasuses')    
      ->select(DB::raw('sum(jumlah_positif) as jumlah_positif'),
               DB::raw('sum(jumlah_sembuh) as jumlah_sembuh'),
               DB::raw('sum(jumlah_meninggal) as jumlah_meninggal'))
      ->get();
      
    $res = [
        'success' => true,
        'Data' => [
            'Hari_Ini' => $data,
            'Total' => $hh
        ],
         'message' => 'Berhasil'
    ];
        return response()->json($res,200);  

    }

    public function provinsi(){

        $nampil  = DB::table('provinsis')
        ->join('kotas','kotas.id_provinsi','=','provinsis.id')
        ->join('kecamatans','kecamatans.id_kota','=','kotas.id')
        ->join('kelurahans','kelurahans.id_kecamatan','=','kecamatans.id')
        ->join('rws','rws.id_kelurahan','=','kelurahans.id')
        ->join('kasuses','kasuses.id_rw','=','rws.id')
        ->select('nama_provinsi',
                DB::raw('sum(kasuses.jumlah_positif) as jumlah_positif'),
                DB::raw('sum(kasuses.jumlah_sembuh) as jumlah_sembuh'),
                DB::raw('sum(kasuses.jumlah_meninggal) as jumlah_meninggal'))
        ->groupBy('nama_provinsi')
        ->get();


        $data = [
            'succes' => true,
            'Data'   => $nampil,
            'message' => "Data Kasus Provinsi Ditampilkan"
                ];
      
                    return response()->json($data,200); 
                  
               
    }


    public function kota(){
        $yy  = DB::table('kotas')
        ->join('kecamatans','kecamatans.id_kota','=','kotas.id')
        ->join('kelurahans','kelurahans.id_kecamatan','=','kecamatans.id')
        ->join('rws','rws.id_kelurahan','=','kelurahans.id')
        ->join('kasuses','kasuses.id_rw','=','rws.id')
        ->select('nama_kota',
                DB::raw('sum(kasuses.jumlah_positif) as jumlah_positif'),
                DB::raw('sum(kasuses.jumlah_sembuh) as jumlah_sembuh'),
                DB::raw('sum(kasuses.jumlah_meninggal) as jumlah_meninggal'))
        ->groupBy('nama_kota')
        ->get();


        $data1 = [
            'succes' => true,
            'Data'   => $yy,
            'message' => "Data Kasus Kota Ditampilkan"
                ];
      
                    return response()->json($data1,200);
    }

    public function kecamatan(){
        $yt  = DB::table('kecamatans')
        ->join('kelurahans','kelurahans.id_kecamatan','=','kecamatans.id')
        ->join('rws','rws.id_kelurahan','=','kelurahans.id')
        ->join('kasuses','kasuses.id_rw','=','rws.id')
        ->select('nama_kecamatan',
                DB::raw('sum(kasuses.jumlah_positif) as jumlah_positif'),
                DB::raw('sum(kasuses.jumlah_sembuh) as jumlah_sembuh'),
                DB::raw('sum(kasuses.jumlah_meninggal) as jumlah_meninggal'))
        ->groupBy('nama_kecamatan')
        ->get();


        $data2 = [
            'succes' => true,
            'Data'   => $yt,
            'message' => "Data Kasus Kecamatan Ditampilkan"
                ];
      
                    return response()->json($data2,200);

    }

    public function kelurahan(){
        $yh  = DB::table('kelurahans')
        ->join('rws','rws.id_kelurahan','=','kelurahans.id')
        ->join('kasuses','kasuses.id_rw','=','rws.id')
        ->select('nama_kelurahan',
                DB::raw('sum(kasuses.jumlah_positif) as jumlah_positif'),
                DB::raw('sum(kasuses.jumlah_sembuh) as jumlah_sembuh'),
                DB::raw('sum(kasuses.jumlah_meninggal) as jumlah_meninggal'))
        ->groupBy('nama_kelurahan')
        ->get();


        $data3 = [
            'succes' => true,
            'Data'   => $yh,
            'message' => "Data Kasus Kelurahan Ditampilkan"
                ];
      
                    return response()->json($data3,200);

    }
      
   


public function indo()
{ 

    
 $rw = DB::table('kasuses')
 ->select([
     DB::raw('SUM(jumlah_positif) as jumlah_positif'),
     DB::raw('SUM(jumlah_sembuh) as jumlah_sembuh'),
     DB::raw('SUM(jumlah_meninggal) as jumlah_meninggal'),
 ])
 ->groupBy('tanggal')->get();

 $positif = DB::table('rws')
     ->select('kasuses.jumlah_positif',
              'kasuses.jumlah_sembuh',
              'kasuses.jumlah_meninggal')
     ->join('kasuses','rws.id', '=' ,'kasuses.id_rw')
     ->sum('kasuses.jumlah_positif');

 $sembuh = DB::table('rws')
     ->select('kasuses.jumlah_positif',
              'kasuses.jumlah_sembuh',
              'kasuses.jumlah_meninggal')
     ->join('kasuses','rws.id', '=' ,'kasuses.id_rw')
     ->sum('kasuses.jumlah_sembuh');

 $meninggal = DB::table('rws')
     ->select('kasuses.jumlah_positif',
              'kasuses.jumlah_sembuh',
              'kasuses.jumlah_meninggal')
     ->join('kasuses','rws.id', '=' ,'kasuses.id_rw')
     ->sum('kasuses.jumlah_meninggal');

     $res = [
         'succes'           => true,
         'data' => ['Hari Ini' => $rw,
                   ],
         'Total' => ['Jumlah Positif'   => $positif,
         'Jumlah Sembuh'    => $sembuh,
         'Jumlah Meninggal' => $meninggal,
                    ],
         'message'          => 'Data Kasus Ditampilkan'
 ];
 return response()->json($res,200);

        $kasuses = kasuses::get('created_at')->last();
        $jumlah_positif = kasuses::where('tanggal',date('Y-m-d')) ->sum('jumlah_positif');
        $jumlah_sembuh = kasuses::where('tanggal',date('Y-m-d')) ->sum('jumlah_sembuh');
        $jumlah_meninggal = kasuses::where('tanggal',date('Y-m-d')) ->sum('jumlah_meninggal');
        
        $join = DB::table('kasuses')
                    ->select('jumlah_positif', 'jumlah_sembuh', 'jumlah_meninggal')
                    ->join('rws', 'kasuses.id_rw', '=', 'rws.id')
                    ->get();
            $arr1 = [
            'data' => 'DATA KASUS INDONESIA',
            'Positif' => $join->sum('jumlah_positif'),
            'Sembuh' => $join->sum('jumlah_sembuh'),
            'Meninggal' => $join->sum('jumlah_meninggal'),
        ];
            $arr2 = [
            'data' => 'DATA KASUS HARI INI ',
            'Positif' => $jumlah_positif,
            'Sembuh' => $jumlah_sembuh,
            'Meninggal' => $jumlah_meninggal,
        ];

$res = [
           'status' => 200,
           'data' => [
                    'Hari Ini' => $arr2,
                    'Total' =>$arr1
           ],
           
];
return response()->json($res,200);


}


public function global() {
        $url = Http::get('https://api.kawalcorona.com/')->json();
        $data = [];
        foreach ($url as $key => $value) {
            $ul  = $value['attributes'];
            $res =[
           'Id'  => $ul['OBJECTID'],
           'Country'  => $ul['Country_Region'],
           'Confirmed' => $ul['Confirmed'],
           'Deaths'  => $ul['Deaths'],
           'Recovered' => $ul['Recovered'],
            ];
            array_push($data,$res);
        }
        $response = [
            'success' => true,
            'Data Provinsi' => $data,
            'message' => 'Data  Dunia Di Tampilkan'
        ];
return response()->json($response,200);


    }

}