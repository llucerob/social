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
        Schema::create('entregados', function (Blueprint $table) {
            $table->id();
            $table->foreignId('materiales_id')
                    ->constrained('materiales')
                    ->onDelete('cascade');
            $table->foreignId('beneficiario_id')
                    ->constrained('beneficiarios')
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
        Schema::dropIfExists('entregados');
    }
};
