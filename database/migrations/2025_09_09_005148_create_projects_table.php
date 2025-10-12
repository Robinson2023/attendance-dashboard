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
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('name');          // Nombre del proyecto
            $table->string('client');        // Cliente
            $table->decimal('price', 12, 2); // Precio pactado
            $table->decimal('cost', 12, 2)->default(0); // Costos asociados
            $table->date('start_date');      // Fecha inicio
            $table->date('end_date');        // Fecha fin (entrega)
            $table->decimal('transport_cost', 10, 2)->nullable();
            $table->decimal('meal_cost', 10, 2)->nullable();
            $table->decimal('material_cost', 10, 2)->nullable();
            $table->timestamps();
        }); // 👈 aquí faltaba el ;
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
