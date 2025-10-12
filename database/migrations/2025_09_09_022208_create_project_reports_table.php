<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('project_reports', function (Blueprint $table) {
            $table->id();
            $table->foreignId('project_id')->constrained()->onDelete('cascade');
            $table->foreignId('employee_id')->nullable()->constrained()->onDelete('set null');
            $table->string('type')->default('novedad'); // avance, problema, novedad
            $table->text('description')->nullable();
            $table->string('attachment')->nullable(); // foto o video
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('project_reports');
    }
};

