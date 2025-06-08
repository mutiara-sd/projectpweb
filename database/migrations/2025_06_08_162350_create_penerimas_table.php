<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
    Schema::create('penerimas', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('donasi_id');
        $table->string('nama');
        $table->string('no_hp');
        $table->text('alamat');
        $table->date('tanggal_ambil');
        $table->integer('jumlah_diambil');
        $table->timestamps();

        $table->foreign('donasi_id')->references('id')->on('donasis')->onDelete('cascade');
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penerimas');
    }
};
