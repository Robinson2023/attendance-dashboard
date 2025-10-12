<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PayrollDetail extends Model
{
    use HasFactory;

    // Nombre EXACTO de la tabla
    protected $table = 'payroll_details';

    protected $fillable = [
        'employee_id','fecha','horas_trabajadas',
        'horas_extra_diurna','horas_extra_nocturna','recargo_nocturno',
        'salario_base_dia','pago_extras','bruto_total',
        'salud','pension','otros_descuentos','total_neto'
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}
