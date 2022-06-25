<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisLaporan extends Model
{
    use HasFactory;

    protected $table = 'M_JENIS_LAPORAN';

    protected $fillable = [
        'JENIS_LAPORAN', 
        'KETERANGAN_LAPORAN'
    ];
}
