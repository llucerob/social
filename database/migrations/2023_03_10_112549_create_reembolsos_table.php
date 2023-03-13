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
        Schema::create('reembolsos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('beneficiarios_id')
                    ->constrained('beneficiarios')
                    ->onDelete('cascade');
<<<<<<<< HEAD:database/migrations/2023_03_11_030046_create_reembolsos_table.php
            $table->integer('total')->default('0');
            $table->string('mes');
            $table->enum('entregado', [1,0])->default('0');
            
========
            $table->integer('total')->nullable();
            $table->enum('entregado', [1,0])->default('0');
>>>>>>>> 6b14d747092eb6c2ebee19d3be15fb05683f8c5d:database/migrations/2023_03_10_112549_create_reembolsos_table.php
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reembolsos');
    }
};
