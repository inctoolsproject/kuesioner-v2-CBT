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
        Schema::create('detail_respon_akademik', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('responden_akademik_id');
            $table->foreign('responden_akademik_id')->references('id')->on('responden_akademik')->onDelete('cascade');
            $table->unsignedBigInteger('pertanyaan_akademik_id');
            $table->foreign('pertanyaan_akademik_id')->references('id')->on('pertanyaan_akademik')->onDelete('cascade');
            $table->unsignedBigInteger('jawaban_akademik_id');
            $table->foreign('jawaban_akademik_id')->references('id')->on('jawaban_akademik')->onDelete('cascade');
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
        Schema::dropIfExists('detail_respon_akademik');
    }
};
