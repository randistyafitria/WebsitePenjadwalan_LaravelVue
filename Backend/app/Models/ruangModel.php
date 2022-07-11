<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ruangModel extends Model
{
    use HasFactory;
protected $table = 'ruang';
    protected $primarykey = 'kode';
    public $timestamps = false;
    public $fillable = [
        'nama','kapasitas','jenis'
    ];    
}
