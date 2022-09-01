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
        Schema::create('pertanyaan_sarpras', function (Blueprint $table) {
            $table->id();
            $table->string('pertanyaan');
            $table->integer('nomor');
            $table->unsignedBigInteger('kuesioner_sarpras_id');
            $table->foreign('kuesioner_sarpras_id')->references('id')->on('kuesioner_sarpras')->onDelete('cascade');
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
        Schema::dropIfExists('pertanyaan_sarpras');
    }
};
