<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('materials', function (Blueprint $table) {
            $table->id();
            $table->foreignId('project_id')->constrained()->onDelete('cascade');
            $table->string('name');
            $table->string('unit')->nullable(); // Ej: kg, m³, etc.
            $table->integer('quantity')->default(1);
            $table->decimal('unit_cost', 12, 2)->default(0);
            $table->decimal('total_cost', 12, 2)->default(0);
            $table->date('date')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('materials');
    }
};
