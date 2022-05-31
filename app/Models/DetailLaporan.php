<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailLaporan extends Model
{
    use HasFactory;

    protected $table = 'M_DETAIL_LAPORAN';

    protected $fillable = [
        'M_LAPORAN_ID',
        'NOMOR_HALAMAN',
        'JUDUL_HALAMAN',
        'EMBED_CODE'
    ];
}
