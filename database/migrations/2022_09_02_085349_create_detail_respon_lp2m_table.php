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
        Schema::create('detail_respon_lp2m', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('responden_lp2m_id');
            $table->foreign('responden_lp2m_id')->references('id')->on('responden_lp2m')->onDelete('cascade');
            $table->unsignedBigInteger('pertanyaan_lp2m_id');
            $table->foreign('pertanyaan_lp2m_id')->references('id')->on('pertanyaan_lp2m')->onDelete('cascade');
            $table->unsignedBigInteger('jawaban_lp2m_id');
            $table->foreign('jawaban_lp2m_id')->references('id')->on('jawaban_lp2m')->onDelete('cascade');
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
        Schema::dropIfExists('detail_respon_lp2m');
    }
};
