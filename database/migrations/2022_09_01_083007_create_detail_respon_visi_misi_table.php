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
        Schema::create('detail_respon_visi_misi', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('responden_visi_misi_id');
            $table->foreign('responden_visi_misi_id')->references('id')->on('responden_visi_misi')->onDelete('cascade');
            $table->unsignedBigInteger('pertanyaan_visi_misi_id');
            $table->foreign('pertanyaan_visi_misi_id')->references('id')->on('pertanyaan_visi_misi')->onDelete('cascade');
            $table->unsignedBigInteger('jawaban_visi_misi_id');
            $table->foreign('jawaban_visi_misi_id')->references('id')->on('jawaban_visi_misi')->onDelete('cascade');
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
        Schema::dropIfExists('detail_respon_visi_misi');
    }
};
