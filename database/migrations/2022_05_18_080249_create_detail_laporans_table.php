<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetailLaporansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('M_DETAIL_LAPORAN', function (Blueprint $table) {
            $table->id();
            $table->foreignId('M_LAPORAN_ID')->constrained('M_LAPORAN');
            $table->string('NOMOR_HALAMAN');
            $table->string('JUDUL_HALAMAN');
            $table->longText('EMBED_CODE');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('M_DETAIL_LAPORAN');
    }
}
