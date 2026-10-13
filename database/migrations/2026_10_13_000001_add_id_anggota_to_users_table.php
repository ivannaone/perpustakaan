<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('id_anggota', 10)
                ->nullable()
                ->unique()
                ->after('role');

            $table->foreign('id_anggota')
                ->references('id_anggota')
                ->on('anggota')
                ->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['id_anggota']);
            $table->dropColumn('id_anggota');
        });
    }
};
