<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kecamatan extends Model
{
    use HasFactory;
    protected $fillable = ['kode_kecamatan','nama_kecamatan','id_kota'];
    public $timestamps = true;

    public function Kota(){
        return $this->belongsTo("App\Models\Kota",'id_kota');
    }

    public function Kelurahan(){
        return $this->hasMany('App\Models\Kelurahan','id_kelurahan');
    }
}