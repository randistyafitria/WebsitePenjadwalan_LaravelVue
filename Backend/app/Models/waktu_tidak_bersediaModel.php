<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class waktu_tidak_bersediaModel extends Model
{
    protected $table = 'waktu_tidak_bersedia';
    protected $primarykey = 'kode';
    public $timestamps = false;
    protected $fillable = [
        'kode','kode_dosen','kode_hari','kode_jam'
    ];
}
