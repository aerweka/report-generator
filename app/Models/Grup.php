<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grup extends Model
{
    use HasFactory;

    protected $table = 'M_GRUP';

    protected $fillable = [
        'NAMA_GRUP', 
        'KETERANGAN_GRUP'
    ];
}
