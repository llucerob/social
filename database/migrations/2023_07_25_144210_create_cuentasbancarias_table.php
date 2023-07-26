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
        Schema::create('cuentasbancarias', function (Blueprint $table) {
            $table->id();
            $table->foreignId('beneficiario_id')->constrained('beneficiarios')->onDelete('cascade');
            $table->enum('tipocuenta', ['Cuenta Vista/Rut', 'Cuenta Corriente', 'Cuenta Ahorro'])->default('Cuenta Vista/Rut');
            $table->integer('numerocuenta');
            $table->string('banco');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cuentasbancarias');
    }
};
