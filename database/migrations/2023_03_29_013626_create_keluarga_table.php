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
        Schema::create('keluarga', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('parentId',false);
            $table->unsignedInteger('generasiKe',false);
            $table->unsignedInteger('urutKe',false);
            $table->string('nama',50);
            $table->enum('jnKelamin',['Laki-laki','Perempuan'])->default('Laki-laki');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('keluarga');
    }
};
