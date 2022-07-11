<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\http\Controllers\MatakuliahController;

class Matakuliah extends Model
{
    use HasFactory;

    protected $table = 'matakuliah';
    protected $primarykey = 'kode';
    public $timestamps = false;
    protected $fillable = [
         'kode_MK','nama', 'sks', 'semester', 'aktif', 'jenis'
     ];
}
