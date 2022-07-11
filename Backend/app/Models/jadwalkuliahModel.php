<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class jadwalkuliahModel extends Model
{
    use HasFactory;
    protected $table = 'jadwalkuliah';
    protected $primarykey = 'kode';
    public $timestamps = false;
    public $fillable = [
        'kode_pengampu', 'kode_jam', 'kode_hari', 'kode_ruang' 
    ];
}
