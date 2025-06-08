<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('no_telepon')->nullable()->after('email');
            $table->string('lokasi_detail')->nullable()->after('no_telepon');
            $table->unsignedBigInteger('lokasi_id')->nullable()->after('lokasi_detail');

            $table->foreign('lokasi_id')->references('lokasi_id')->on('lokasis')->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['lokasi_id']);
            $table->dropColumn(['no_telepon', 'lokasi_detail', 'lokasi_id']);
        });
    }
};
