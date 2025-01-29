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
        Schema::create('situaciones', function (Blueprint $table) {
            $table->id();
            $table->foreignId('beneficiario_id')->constrained('beneficiarios')->onDelete('cascade');
            $table->enum('tipo', ['familiar', 'salud', 'profesional'])->default('profesional');
            $table->text('comentario');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('situaciones');
    }
};
