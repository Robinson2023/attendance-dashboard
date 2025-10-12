<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('attendances', function (Blueprint $table) {
            $table->id();
            $table->foreignId('employee_id')->constrained()->onDelete('cascade');
            $table->date('fecha');
            $table->time('hora')->nullable();
            $table->string('status')->default('on_time');
            $table->time('hora_entrada')->nullable();
            $table->time('hora_salida')->nullable();
            $table->boolean('permission_descontable')->default(false);


            $table->timestamps();
        });

    }

    public function down(): void
    {
        Schema::dropIfExists('attendances');
    }
};
