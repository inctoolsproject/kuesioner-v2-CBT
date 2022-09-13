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
        Schema::create('detail_respon_fakultas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('responden_fakultas_id');
            $table->foreign('responden_fakultas_id')->references('id')->on('responden_fakultas')->onDelete('cascade');
            $table->unsignedBigInteger('pertanyaan_fakultas_id');
            $table->foreign('pertanyaan_fakultas_id')->references('id')->on('pertanyaan_fakultas')->onDelete('cascade');
            $table->unsignedBigInteger('jawaban_fakultas_id');
            $table->foreign('jawaban_fakultas_id')->references('id')->on('jawaban_fakultas')->onDelete('cascade');
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
        Schema::dropIfExists('detail_respon_fakultas');
    }
};
