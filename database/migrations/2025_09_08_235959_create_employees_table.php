<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->id();

            // 1️⃣ Datos básicos
            $table->string('first_name');
            $table->string('last_name');
            $table->string('document_type', 20);   // CC, CE, Pasaporte
            $table->string('document_number')->unique();
            $table->date('birth_date');
            $table->string('birth_place')->nullable();
            $table->enum('gender', ['Masculino','Femenino','Otro'])->nullable();
            $table->enum('marital_status', ['Soltero', 'Casado', 'Unión Libre', 'Divorciado', 'Viudo'])->nullable();
            $table->string('address');
            $table->string('phone')->nullable();
            $table->string('email')->unique();
            $table->string('photo')->nullable();   // ruta en storage

            // 2️⃣ Información laboral
            $table->string('position');            // Cargo
            $table->string('department')->nullable();
            $table->enum('contract_type', ['Fijo', 'Indefinido', 'Prestación', 'Aprendiz', 'Otro']);
            $table->date('hire_date');
            $table->date('termination_date')->nullable();
            $table->decimal('salary', 12, 2);
            $table->string('schedule')->nullable(); // descripción de horario
            $table->decimal('salary', 12, 2);       // salario mensual
            $table->integer('hours_per_day')->default(8); // jornada estándar

            // 3️⃣ Seguridad social
            $table->string('eps');
            $table->string('pension_fund');
            $table->string('cesantias_fund')->nullable();
            $table->string('arl')->nullable();
            $table->string('compensation_fund')->nullable();
            $table->string('cotizante_type')->nullable();

            // 4️⃣ Contacto de emergencia
            $table->string('emergency_contact_name');
            $table->string('emergency_contact_relationship')->nullable();
            $table->string('emergency_contact_phone');

            // 5️⃣ Información bancaria
            $table->string('bank')->nullable();
            $table->enum('account_type', ['Ahorros', 'Corriente'])->nullable();
            $table->string('account_number')->nullable();

            // 6️⃣ Dotación y extras
            $table->string('shirt_size', 10)->nullable();
            $table->string('pants_size', 10)->nullable();
            $table->string('shoe_size', 10)->nullable();
            $table->text('training_certificates')->nullable(); // texto o JSON con enlaces a archivos
            $table->string('internal_card_number')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
