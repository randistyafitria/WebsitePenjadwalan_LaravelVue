<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dosen extends Model
{
    use HasFactory;

    protected $table = 'dosen';
    protected $primarykey ='kode';
    public $timestamps = false;
    protected $fillable = [
        'nidn', 'nama', 'alamat', 'telp'
    ];
}
