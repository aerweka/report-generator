<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLaporansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('M_LAPORAN', function (Blueprint $table) {
            $table->id();
            $table->foreignId('M_GRUP_ID')->constrained('M_GRUP');
            $table->foreignId('M_JENIS_LAPORAN_ID')->constrained('M_JENIS_LAPORAN');
            $table->string('JUDUL_LAPORAN');
            $table->string('COVER_LAPORAN')->nullable();
            $table->string('KETERANGAN_LAPORAN');
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
        Schema::dropIfExists('M_LAPORAN');
    }
}
