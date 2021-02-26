<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kasus2 extends Model
{
    use HasFactory;

    protected $fillable = ['jumlah_positif','jumlah_sembuh','jumlah_meninggal','tanggal','id_rw'];
    public $timestamps = true;

    public function Rw(){
        return $this->belongsTo('App\Models\Rw','id_rw');
    }
}