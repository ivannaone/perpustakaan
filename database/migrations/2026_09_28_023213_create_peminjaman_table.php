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
        Schema::create('peminjaman', function (Blueprint $table) {
            $table->string('id_pinjam', 10)->primary();
            $table->date('tgl_pinjam');
            $table->string('id_anggota', 10);
            $table->string('no_buku', 20);
            $table->date('tgl_kembali')->nullable();
            $table->enum('status', ['dipinjam', 'dikembalikan'])->default('dipinjam');
            $table->timestamps();

            $table->foreign('id_anggota')
                ->references('id_anggota')
                ->on('anggota')
                ->onUpdate('cascade')
                ->onDelete('restrict');

            $table->foreign('no_buku')
                ->references('no_buku')
                ->on('detail_buku')
                ->onUpdate('cascade')
                ->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('peminjaman');
    }
};
