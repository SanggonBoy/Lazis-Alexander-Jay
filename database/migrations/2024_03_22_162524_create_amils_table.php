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
        Schema::create('amil', function (Blueprint $table) {
            $table->id();
            $table->string('kode_amil');
            $table->string('email');
            $table->string('nama_amil');
            $table->string('password');
            $table->string('no_telp', 13);
            $table->string('alamat');
            $table->enum('jenis_kelamin', ['Laki-Laki', 'Perempuan']);
            $table->string('status');
            $table->string('qr_token');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('amil');
    }
};
