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
        Schema::create('jawaban_lp2m', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pertanyaan_lp2m_id');
            $table->foreign('pertanyaan_lp2m_id')->references('id')->on('pertanyaan_lp2m')->onDelete('cascade');
            $table->string('jawaban');
            $table->integer('nilai');
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
        Schema::dropIfExists('jawaban_lp2m');
    }
};
