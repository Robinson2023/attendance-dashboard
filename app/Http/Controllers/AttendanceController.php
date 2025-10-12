<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Employee;
use Illuminate\Http\Request;
use Carbon\Carbon;

class AttendanceController extends Controller
{
    /** 
     * Mostrar el listado y los filtros 
     */
    public function index(Request $request)
    {
        $today = Carbon::today();

        // Filtrar por rango de fechas
        $desde = $request->input('desde');
        $hasta = $request->input('hasta');

        $query = Attendance::with('employee');

        if ($desde && $hasta) {
            $query->whereBetween('fecha', [$desde, $hasta]);
        } else {
            $query->whereDate('fecha', $today);
        }

        $registros = $query->orderBy('fecha', 'desc')->get();

        // Para registrar nuevas asistencias (lista empleados)
        $employees = Employee::orderBy('first_name')->get();

        return view('attendances.index', compact('registros', 'employees', 'desde', 'hasta'));
    }

    /** 
     * Registrar entrada o salida
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'employee_id' => 'required|exists:employees,id',
            'fecha' => 'required|date',
            'tipo' => 'required|in:entrada,salida',
            'latitud' => 'nullable|numeric',
            'longitud' => 'nullable|numeric',
        ]);

        $attendance = Attendance::firstOrCreate(
            ['employee_id' => $validated['employee_id'], 'fecha' => $validated['fecha']],
            ['hora_entrada' => null, 'hora_salida' => null]
        );

        $horaActual = Carbon::now('America/Bogota')->format('H:i:s');

        if ($validated['tipo'] === 'entrada') {
            $attendance->hora_entrada = $horaActual;
        } else {
            $attendance->hora_salida = $horaActual;
        }

        // Guardar ubicación si viene desde el móvil
        $attendance->latitud = $validated['latitud'] ?? null;
        $attendance->longitud = $validated['longitud'] ?? null;

        $attendance->save();

        return redirect()->route('attendances.index')->with('success', 'Asistencia registrada correctamente');
    }
}
