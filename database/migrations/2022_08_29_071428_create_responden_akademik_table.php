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
        Schema::create('responden_akademik', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('username');
            $table->tinyInteger('kode_fakultas');
            $table->tinyInteger('kode_prodi');
            $table->integer('kode_matkkul')->index();
            $table->string('kelas', 2)->index();
            $table->string('nama_matkul');
            $table->string('nodos', 9)->nullable();
            $table->string('nama_dosen')->nullable();
            $table->enum('tipe', ['mahasiswa', 'dosen', 'tendik']);
            $table->string('saran');
            $table->float('indeks');
            $table->unsignedBigInteger('kuesioner_akademik_id');
            $table->foreign('kuesioner_akademik_id')->references('id')->on('kuesioner_akademik')->onDelete('cascade');
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
        Schema::dropIfExists('responden_akademik');
    }
};
