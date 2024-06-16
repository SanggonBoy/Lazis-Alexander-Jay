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
        Schema::create('fidyah', function (Blueprint $table) {
            $table->id();
            $table->string('kode_transaksi');
            $table->string('email');
            $table->string('full_name');
            $table->string('jenis_transaksi');
            $table->bigInteger('jumlah');
            $table->bigInteger('nominal');
            $table->date('tanggal_pembayaran');
            $table->string('status_pembayaran');
            $table->string('kategori');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fidyah');
    }
};
