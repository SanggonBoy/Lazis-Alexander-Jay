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
        Schema::create('penyerahan', function (Blueprint $table) {
            $table->id();
            $table->string('nama_amil');
            $table->string('nama_mustahik');
            $table->string('jenis_zakat');
            $table->integer('jumlah');
            $table->date('tanggal');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penyerahan');
    }
};
