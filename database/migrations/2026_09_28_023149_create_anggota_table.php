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
            Schema::create('anggota', function (Blueprint $table) {
            $table->string('id_anggota', 10)->primary();
            $table->string('nama_anggota', 100);
            $table->string('jenis_anggota', 20);
            $table->string('kelas_prodi', 50)->nullable();
            $table->string('tempat_lahir', 30)->nullable();
            $table->date('tgl_lahir')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('anggota');
    }
};
