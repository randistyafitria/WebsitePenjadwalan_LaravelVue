<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jammodel extends Model
{
    protected $table = 'jam';
    protected $primarykey = 'kode';
    public $timestamps = false;
    protected $fillable = [
        'kode', 'range_jam', 'aktif'
    ];
}