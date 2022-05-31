<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Laporan extends Model
{
    use HasFactory;

    protected $table = 'M_LAPORAN';
    protected $primaryKey = 'ID';
    protected $fillable = [
        'M_GRUP_ID',
        'M_JENIS_LAPORAN_ID',
        'JUDUL_LAPORAN',
        'COVER_LAPORAN',
        'KETERANGAN_LAPORAN',
    ];
}
