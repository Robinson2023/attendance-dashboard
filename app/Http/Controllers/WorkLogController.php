<?php

namespace App\Http\Controllers;

use App\Models\WorkLog;
use App\Models\Employee;
use App\Models\Project;
use Illuminate\Http\Request;

class WorkLogController extends Controller
{
    /**
     * Mostrar todos los registros de horas.
     */
public function index(Request $request)
{
    $query = WorkLog::with(['employee', 'project']);

    // Si el usuario selecciona un empleado o proyecto, filtramos
    if ($request->filled('employee_id')) {
        $query->where('employee_id', $request->employee_id);
    }

    if ($request->filled('project_id')) {
        $query->where('project_id', $request->project_id);
    }

    $worklogs = $query->orderBy('date', 'desc')->get();

    // Enviamos los empleados y proyectos para llenar los filtros
    $employees = \App\Models\Employee::orderBy('first_name')->get();
    $projects = \App\Models\Project::orderBy('name')->get();

    return view('worklogs.index', compact('worklogs', 'employees', 'projects'));
}

    /**
     * Mostrar formulario para crear un nuevo registro.
     */
    public function create()
    {
        $employees = Employee::all();
        $projects = Project::all();
        return view('worklogs.create', compact('employees', 'projects'));
    }

    /**
     * Guardar un nuevo registro de horas.
     */
 public function store(Request $request)
{
    $request->validate([
        'employee_id' => 'required|exists:employees,id',
        'project_id'  => 'required|exists:projects,id',
        'date'        => 'required|date',
        'start_time'  => 'required|date_format:H:i',
        'end_time'    => 'required|date_format:H:i|after:start_time',
        'notes'       => 'nullable|string',
    ]);

    $start = \Carbon\Carbon::parse($request->start_time);
    $end   = \Carbon\Carbon::parse($request->end_time);
    $hours = $end->diffInHours($start);

    WorkLog::create([
        'employee_id' => $request->employee_id,
        'project_id'  => $request->project_id,
        'date'        => $request->date,
        'start_time'  => $request->start_time,
        'end_time'    => $request->end_time,
        'notes'       => $request->notes,
        'hours'       => $hours,
    ]);

    return redirect()->route('worklogs.index')->with('success', 'Registro creado correctamente.');
}
    /**
     * Mostrar formulario para editar un registro existente.
     */
    public function edit(WorkLog $worklog)
    {
        $employees = Employee::all();
        $projects = Project::all();
        return view('worklogs.edit', compact('worklog', 'employees', 'projects'));
    }

    /**
     * Actualizar un registro existente.
     */
    public function update(Request $request, WorkLog $worklog)
{
    $request->validate([
        'employee_id' => 'required|exists:employees,id',
        'project_id'  => 'required|exists:projects,id',
        'date'        => 'required|date',
        'start_time'  => 'required|date_format:H:i',
        'end_time'    => 'required|date_format:H:i|after:start_time',
        'notes'       => 'nullable|string',
    ]);

    // Calcular horas
    $start = \Carbon\Carbon::parse($request->start_time);
    $end   = \Carbon\Carbon::parse($request->end_time);
    $hours = $end->diffInHours($start);

    $worklog->update([
        'employee_id' => $request->employee_id,
        'project_id'  => $request->project_id,
        'date'        => $request->date,
        'start_time'  => $request->start_time,
        'end_time'    => $request->end_time,
        'notes'       => $request->notes,
        'hours'       => $hours, // ✅ recalculado
    ]);

    return redirect()->route('worklogs.index')->with('success', 'Registro actualizado correctamente.');
}

    /**
     * Eliminar un registro.
     */
    public function destroy(WorkLog $worklog)
    {
        $worklog->delete();
        return redirect()->route('worklogs.index')->with('success', 'Registro eliminado correctamente.');
    }

    public function report()
    {
        $logs = WorkLog::with(['employee', 'project'])->get();
    
        // Horas agrupadas por empleado
        $hoursByEmployee = $logs->groupBy('employee.name')->map->sum('hours');
    
        // Horas agrupadas por proyecto
        $hoursByProject = $logs->groupBy('project.name')->map->sum('hours');
    
        // Horas agrupadas por fecha
        $hoursByDate = $logs->groupBy('date')->map->sum('hours');
    
        return view('worklogs.report', [
            'labelsEmployees' => $hoursByEmployee->keys(),
            'dataEmployees' => $hoursByEmployee->values(),
    
            'labelsProjects' => $hoursByProject->keys(),
            'dataProjects' => $hoursByProject->values(),
    
            'labelsDates' => $hoursByDate->keys(),
            'dataDates' => $hoursByDate->values(),
        ]);
    }
    
}
