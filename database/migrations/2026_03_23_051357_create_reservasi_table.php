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
        Schema::create('reservasi', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('id_user')->unsigned();
            $table->bigInteger('id_meja')->unsigned();
            $table->date('tanggal_reservasi');
            $table->time('jam_reservasi');
            $table->integer('jumlah_orang');
            $table->decimal('total_harga');
            $table->enum('metode_pembayaran', ['cash', 'transfer']);
            $table->string('bukti_pembayaran');
            $table->enum('status', ['pending','approved','rejected'])->default('pending');
            $table->timestamps();

            $table->foreign('id_user')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('id_meja')->references('id')->on('meja')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservasi');
    }
};
