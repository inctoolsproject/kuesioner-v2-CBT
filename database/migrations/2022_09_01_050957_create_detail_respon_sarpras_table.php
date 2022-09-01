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
        Schema::create('detail_respon_sarpras', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('responden_sarpras_id');
            $table->foreign('responden_sarpras_id')->references('id')->on('responden_sarpras')->onDelete('cascade');
            $table->unsignedBigInteger('pertanyaan_sarpras_id');
            $table->foreign('pertanyaan_sarpras_id')->references('id')->on('pertanyaan_sarpras')->onDelete('cascade');
            $table->unsignedBigInteger('jawaban_sarpras_id');
            $table->foreign('jawaban_sarpras_id')->references('id')->on('jawaban_sarpras')->onDelete('cascade');
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
        Schema::dropIfExists('detail_respon_sarpras');
    }
};
