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
        Schema::create('materialesmunicipales', function (Blueprint $table) {
            $table->id();

            $table->foreignId('solicitudesmunicipales_id')->constrained('solicitudesmunicipales')->onDelete('cascade');

            $table->foreignId('material_id')->constrained('materiales')->onDelete('cascade');
            $table->integer('cantidad')->default(0);
            $table->string('unidad');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('materialesmunicipales');
    }
};
