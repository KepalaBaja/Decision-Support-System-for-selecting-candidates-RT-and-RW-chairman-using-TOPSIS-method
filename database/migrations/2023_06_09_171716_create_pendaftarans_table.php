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
        Schema::create('pendaftarans', function (Blueprint $table) {
            $table->id();
            $table->string('nama_lengkap');
            $table->string('tempat_lahir');
            $table->date('tanggal_lahir');
            $table->enum('jenis_kelamin',['Laki-laki','Perempuan']);
            $table->string('telpon');
            $table->string('pendidikan');
            $table->string('pekerjaan');
            $table->string('berkas');
            $table->unsignedBigInteger('id_calon');
            $table->unsignedBigInteger('user_id');
            $table->timestamps();

            $table->foreign('id_calon')->references('calon_id')->on('calons')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pendaftarans');
    }
};