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
        Schema::create('solicitudes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('materiales_id')
                    ->constrained('materiales')
                    ->onDelete('cascade');
            $table->foreignId('sectores_id')
                    ->constrained('solicitudes')
                    ->onDelete('cascade');
            $table->integer('cantidad');
            $table->string('medida');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('solicitudes');
    }
};
