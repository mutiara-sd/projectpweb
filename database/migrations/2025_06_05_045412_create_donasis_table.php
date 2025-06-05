<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('donasis', function (Blueprint $table) {
            $table->bigIncrements('id_donasi');

            $table->unsignedBigInteger('id_user');
            $table->unsignedBigInteger('id_lokasi')->nullable(); // opsional, karena belum ada tabel lokasi

            $table->string('alamat');
            $table->string('nama_makanan');
            $table->string('kategori');
            $table->text('deskripsi_makanan');
            $table->integer('jumlah');
            $table->enum('halal', ['halal', 'non-halal']);
            $table->date('kadaluwarsa');
            $table->binary('gambar')->nullable();
            $table->timestamp('created_at')->useCurrent();

            // Foreign key ke tabel users
            $table->foreign('id_user')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::table('donasis', function (Blueprint $table) {
            $table->dropForeign(['id_user']);
        });

        Schema::dropIfExists('donasis');
    }
};
