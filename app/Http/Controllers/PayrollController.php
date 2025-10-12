<?php

namespace App\Http\Controllers;

use App\Models\PayrollDetail;
use App\Models\Attendance;
use App\Models\Employee;
use Illuminate\Http\Request;

class PayrollController extends Controller
{
    public function index()
    {
        $payrolls = PayrollDetail::with('employee')->latest()->paginate(20);
        return view('payroll.index', compact('payrolls'));
    }

    public function generateDaily($date)
    {
        $attendances = Attendance::with('employee')
            ->whereDate('fecha', $date)->get();

        foreach ($attendances as $att) {
            $emp  = $att->employee;
            $salarioDiario = $emp->salary / 30;

            // cálculos básicos
            $bruto = $salarioDiario;
            $salud = $bruto * 0.04;
            $pension = $bruto * 0.04;
            $neto = $bruto - $salud - $pension;

            PayrollDetail::create([
                'employee_id' => $employee->id,
                'fecha'             => $date,
                'horas_trabajadas'  => $att->horas_trabajadas,
                'salario_base_dia'  => $salarioDiario,
                'pago_extras'       => 0,
                'bruto_total'       => $bruto,
                'salud'             => $salud,
                'pension'           => $pension,
                'total_neto'        => $neto,
            ]);
        }

        return redirect()->route('payroll.index')
            ->with('success','Nómina generada para '.$date);
    }
}
