<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('donasis', function (Blueprint $table) {
            $table->bigIncrements('id'); // Pakai "id" standar Laravel

            $table->unsignedBigInteger('user_id'); // Ganti dari id_user ke user_id (konvensi Laravel)
            $table->unsignedBigInteger('lokasi_id')->nullable(); // Ganti id_lokasi ke lokasi_id untuk konsistensi

            $table->string('alamat');
            $table->string('nama_makanan');
            $table->string('kategori');
            $table->text('deskripsi_makanan');
            $table->integer('jumlah');
            $table->enum('halal', ['halal', 'non-halal']);
            $table->date('kadaluwarsa');
            $table->string('gambar')->nullable(); // Ganti dari binary jadi string (untuk path gambar)
            $table->timestamps(); // created_at & updated_at otomatis

            // Foreign key
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }
   
};
