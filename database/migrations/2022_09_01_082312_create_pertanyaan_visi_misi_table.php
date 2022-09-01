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
        Schema::create('pertanyaan_visi_misi', function (Blueprint $table) {
            $table->id();
            $table->string('pertanyaan');
            $table->integer('nomor');
            $table->unsignedBigInteger('kuesioner_visi_misi_id');
            $table->foreign('kuesioner_visi_misi_id')->references('id')->on('kuesioner_visi_misi')->onDelete('cascade');
            $table->tinyInteger('tipe'); // 1 = radio, 2 = checkbox, 3 = textarea, 4 = text
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
        Schema::dropIfExists('pertanyaan_visi_misi');
    }
};
