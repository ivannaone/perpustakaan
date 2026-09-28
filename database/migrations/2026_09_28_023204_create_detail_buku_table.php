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
        Schema::create('detail_buku', function (Blueprint $table) {
            $table->string('no_buku', 20)->primary();
            $table->string('id_buku', 10);
            $table->enum('status', ['ada', 'dipinjam'])->default('ada');
            $table->timestamps();

            $table->foreign('id_buku')
                ->references('id_buku')
                ->on('buku')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_buku');
    }
};
