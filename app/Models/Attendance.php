<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;

protected $fillable = [
    'employee_id',
    'fecha',
    'hora_entrada',
    'hora_salida',
    'status',
    'latitud',
    'longitud',
    'permission_descontable', // 🔹 agregar
];


    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}
