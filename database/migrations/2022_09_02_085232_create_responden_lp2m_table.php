<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('responden_lp2m', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('username');
            $table->tinyInteger('kode_fakultas');
            $table->tinyInteger('kode_prodi');
            $table->enum('tipe', ['mahasiswa', 'dosen', 'tendik']);
            $table->string('saran');
            $table->float('indeks');
            $table->unsignedBigInteger('kuesioner_lp2m_id');
            $table->foreign('kuesioner_lp2m_id')->references('id')->on('kuesioner_lp2m')->onDelete('cascade');
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
        Schema::dropIfExists('responden_lp2m');
    }
};
