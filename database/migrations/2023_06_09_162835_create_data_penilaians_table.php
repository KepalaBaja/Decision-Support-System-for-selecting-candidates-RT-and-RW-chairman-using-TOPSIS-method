<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('data_penilaians', function (Blueprint $table) {
            $table->bigIncrements('nilai_id');
            $table->unsignedBigInteger('id_kriteria');
            $table->unsignedBigInteger('id_calon');
            $table->unsignedBigInteger('penilai_id');
            $table->integer('nilai');
            $table->timestamps();

            $table->foreign('id_calon')->references('calon_id')->on('calons')->onDelete('cascade');
            $table->foreign('id_kriteria')->references('kriteria_id')->on('kriterias')->onDelete('cascade');
            $table->foreign('penilai_id')->references('id')->on('penilais')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data_penilaians');
    }
};