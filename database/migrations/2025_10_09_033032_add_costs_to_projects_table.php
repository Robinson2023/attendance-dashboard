<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('projects', function (Blueprint $table) {
            if (!Schema::hasColumn('projects', 'transport_cost')) {
                $table->decimal('transport_cost', 10, 2)->nullable()->after('price');
            }

            if (!Schema::hasColumn('projects', 'meal_cost')) {
                $table->decimal('meal_cost', 10, 2)->nullable()->after('transport_cost');
            }

            if (!Schema::hasColumn('projects', 'material_cost')) {
                $table->decimal('material_cost', 10, 2)->nullable()->after('meal_cost');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('projects', function (Blueprint $table) {
            if (Schema::hasColumn('projects', 'transport_cost')) {
                $table->dropColumn('transport_cost');
            }

            if (Schema::hasColumn('projects', 'meal_cost')) {
                $table->dropColumn('meal_cost');
            }

            if (Schema::hasColumn('projects', 'material_cost')) {
                $table->dropColumn('material_cost');
            }
        });
    }
};