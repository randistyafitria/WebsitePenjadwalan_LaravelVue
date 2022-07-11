<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class hariModel extends Model
{
    protected $table = 'hari';
    protected $primarykey = 'kode';
    public $timestamps = false;
    protected $fillable = [
        'nama'
    ];
}
