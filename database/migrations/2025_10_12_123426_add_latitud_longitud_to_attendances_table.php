<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
public function up()
{
    Schema::table('attendances', function (Blueprint $table) {
        $table->decimal('latitud', 10, 7)->nullable()->after('hora_salida');
        $table->decimal('longitud', 10, 7)->nullable()->after('latitud');
    });
}

public function down()
{
    Schema::table('attendances', function (Blueprint $table) {
        $table->dropColumn(['latitud', 'longitud']);
    });
}
};

