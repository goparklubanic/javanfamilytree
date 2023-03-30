<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Keluarga extends Model
{
    /*
        parentId int(4) NOT NULL,
        generasiKe int(2) NOT NULL,
        urutKe int(2) NOT NULL DEFAULT 1,
        nama varchar(50) NOT NULL,
        jnKelamin enum('Laki-laki','Perempuan') DEFAULT 'Laki-laki',
        */
    use HasFactory;
    protected $table = 'keluarga';
    protected $primaryKey  = 'id';
    protected $fillable=['parentId','generasiKe','urutKe','nama','jnKelamin'];
}
