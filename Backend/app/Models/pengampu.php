<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class pengampu extends Model
{
    use HasFactory;
    
        protected $table = 'pengampu';
        protected $primarykey = 'kode';
        public $timestamps = false;
        protected $fillable = [
            'kode_mk','kode_dosen','kelas','tahun_akademik'
        ];
    
}
