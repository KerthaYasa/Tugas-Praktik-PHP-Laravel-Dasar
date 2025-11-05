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
        Schema::create('mahasiswas', function (Blueprint $table) {
            $table->id();
            $table->string('nim', 20)->unique();
            $table->string('nama', 100);
            $table->unsignedBigInteger('prodi_id');
            $table->string('email', 100)->nullable();
            $table->string('alamat', 255)->nullable();
            $table->string('telepon', 20)->nullable();
            $table->timestamps();

            // Foreign key constraint
            $table->foreign('prodi_id')
                  ->references('id')
                  ->on('program_studis')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mahasiswas');
    }
};