<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('payroll_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('employee_id')->constrained()->onDelete('cascade');
            $table->date('fecha');

            // Horas y extras
            $table->decimal('horas_trabajadas', 5, 2);
            $table->decimal('horas_extra_diurna', 5, 2)->default(0);
            $table->decimal('horas_extra_nocturna', 5, 2)->default(0);
            $table->decimal('recargo_nocturno', 5, 2)->default(0);

            // Valores monetarios
            $table->decimal('salario_base_dia', 12, 2);
            $table->decimal('pago_extras', 12, 2)->default(0);
            $table->decimal('bruto_total', 12, 2);
            $table->decimal('salud', 12, 2);
            $table->decimal('pension', 12, 2);
            $table->decimal('otros_descuentos', 12, 2)->default(0);
            $table->decimal('total_neto', 12, 2);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('payroll_details');
    }
};
