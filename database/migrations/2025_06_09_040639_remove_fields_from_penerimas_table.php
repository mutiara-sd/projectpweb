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
    Schema::table('penerimas', function (Blueprint $table) {
        $table->dropColumn(['nama', 'no_hp', 'alamat', 'tanggal_ambil']);
    });
}

public function down(): void
{
    Schema::table('penerimas', function (Blueprint $table) {
        $table->string('nama')->nullable();
        $table->string('no_hp')->nullable();
        $table->text('alamat')->nullable();
        $table->date('tanggal_ambil')->nullable();
    });
}

};
