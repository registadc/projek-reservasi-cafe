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
        Schema::create('detail_reservasi', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('id_reservasi')->unsigned();
            $table->bigInteger('id_menu')->unsigned();
            $table->integer('jumlah');
            $table->decimal('subtotal');
            $table->timestamps();

            $table->foreign('id_reservasi')->references('id')->on('reservasi')->onDelete('cascade');
            $table->foreign('id_menu')->references('id')->on('menu')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_reservasi');
    }
};
