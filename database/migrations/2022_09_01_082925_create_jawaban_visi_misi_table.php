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
        Schema::create('jawaban_visi_misi', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pertanyaan_visi_misi_id');
            $table->foreign('pertanyaan_visi_misi_id')->references('id')->on('pertanyaan_visi_misi')->onDelete('cascade');
            $table->string('jawaban');
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
        Schema::dropIfExists('jawaban_visi_misi');
    }
};
