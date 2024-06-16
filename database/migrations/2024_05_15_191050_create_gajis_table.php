<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('gaji', function (Blueprint $table) {
            $table->id();
            $table->string('kode_transaksi');
            $table->string('nama_amil');
            $table->string('email');
            $table->date('periode');
            $table->bigInteger('jumlah_alpa');
            $table->bigInteger('transport')->default(0);
            $table->bigInteger('makan')->default(0);
            $table->bigInteger('lembur')->default(0);
            $table->bigInteger('tunjangan')->default(0);
            $table->bigInteger('bonus')->default(0);
            $table->bigInteger('total_gaji')->default(5000000);
            $table->date('tanggal_dicetak')->nullable();
            $table->timestamps();

            $table->foreignId('kode_amil')->constrained('amil')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gaji');
    }
};
