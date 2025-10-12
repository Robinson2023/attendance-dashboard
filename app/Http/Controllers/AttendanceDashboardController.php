<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Schedule;
use App\Models\Employee;
use Illuminate\Http\Request;
use Carbon\Carbon;

class AttendanceDashboardController extends Controller
{
    /**
     * Mostrar dashboard de asistencia filtrado
     */
public function index(Request $request)
{
    $desde = $request->input('desde', today()->subDays(15)->toDateString());
    $hasta = $request->input('hasta', today()->toDateString());
    $employeeId = $request->input('employee');

    $employees = \App\Models\Employee::orderBy('first_name')->get();

    $schedulesQuery = \App\Models\Schedule::with('employee')
                        ->whereBetween('fecha', [$desde, $hasta]);

    if($employeeId) $schedulesQuery->where('employee_id', $employeeId);

    $register = $schedulesQuery->get()->map(function($schedule){
        $att = \App\Models\Attendance::where('employee_id', $schedule->employee_id)
                ->whereDate('fecha', $schedule->fecha)
                ->first();

        $status = 'absent';
        $horaEntrada = $horaSalida = $horaInicio = $horaFin = null;
        $workedHours = $extraHours = $deduction = $payment = 0;

        if($att){
            $horaEntrada = \Carbon\Carbon::parse($att->hora_entrada);
            $horaSalida  = \Carbon\Carbon::parse($att->hora_salida ?? $att->hora_entrada);
            $horaInicio  = \Carbon\Carbon::parse($schedule->hora_inicio);
            $horaFin     = \Carbon\Carbon::parse($schedule->hora_fin ?? $horaInicio->addHours(8));

            $status = $horaEntrada->lessThanOrEqualTo($horaInicio->addMinutes(5)) ? 'on_time' : 'late';

            $workedHours = $horaSalida->diffInMinutes($horaEntrada)/60;
            $extraHours  = $horaSalida->greaterThan($horaFin) ? $horaSalida->diffInMinutes($horaFin)/60 : 0;

            $salaryPerHour = $schedule->employee->salary / 30 / $schedule->employee->hours_per_day;
            $deduction     = $att->permission_descontable ? $salaryPerHour * $workedHours : 0;
            $extraRate     = 1.5;
            $payment       = ($workedHours * $salaryPerHour) + ($extraHours * $salaryPerHour * $extraRate) - $deduction;
        }

        return [
            'id' => $att->id ?? null,
            'employee' => $schedule->employee->first_name . ' ' . $schedule->employee->last_name,
            'fecha' => $schedule->fecha,
            'status' => $status,
            'hora' => $att->hora_entrada ?? null,
            'hora_salida' => $att->hora_salida ?? null,
            'worked_hours' => $workedHours,
            'extra_hours'  => $extraHours,
            'deduction'    => $deduction,
            'payment'      => $payment,
            'permission_descontable' => $att->permission_descontable ?? false,
        ];
    });

    return view('dashboard.attendance', [
        'desde' => $desde,
        'hasta' => $hasta,
        'register' => $register,
        'employees' => $employees,
    ]);
}

    /**
     * Actualizar el permiso descontable vía AJAX
     */
    public function updatePermission(Request $request, $id)
    {
        $request->validate([
            'descontable' => 'required|boolean',
        ]);

        $attendance = Attendance::find($id);

        if (!$attendance) {
            return response()->json([
                'success' => false,
                'message' => 'Registro no encontrado.'
            ], 404);
        }
        $att = \App\Models\Attendance::findOrFail($id);
        $att->permission_descontable = $request->input('descontable', 0);
        $att->save();

        return response()->json([
        'success' => true,
        'message' => 'Permiso actualizado correctamente.'
    ]);
        $attendance->permission_descontable = $request->descontable;
        $attendance->save();

        return response()->json([
            'success' => true,
            'message' => 'Permiso actualizado correctamente.'
        ]);
    }

}
