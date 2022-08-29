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
        Schema::create('jawaban_akademik', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pertanyaan_akademik_id');
            $table->foreign('pertanyaan_akademik_id')->references('id')->on('pertanyaan_akademik')->onDelete('cascade');
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
        Schema::dropIfExists('jawaban_akademik');
    }
};
