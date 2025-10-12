<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Employee;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
public function index()
    {
        $projects = Project::with('employees')->get();
        return view('projects.index', compact('projects'));
    }
 public function create()
    {
        $employees = Employee::all();
        return view('projects.create', compact('employees'));
    }

public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'client' => 'required|string|max:255',
            'price' => 'required|numeric',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'employees' => 'array',
            'transport_cost' => 'nullable|numeric',
            'meal_cost' => 'nullable|numeric',
            'material_cost' => 'nullable|numeric',
        ]);

        $project = Project::create($validated);

        if ($request->has('employees')) {
            $project->employees()->sync($request->employees);
        }

        return redirect()->route('projects.index')->with('success', 'Proyecto creado correctamente');
    }


    public function edit(Project $project)
    {
        $employees = Employee::all();
        $assigned = $project->employees->pluck('id')->toArray();
        return view('projects.edit', compact('project', 'employees', 'assigned'));
    }

    public function update(Request $request, Project $project)
    {
        $data = $request->validate([
            'name' => 'required|string|min:3',
            'client' => 'required|string',
            'price' => 'required|numeric',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'employees' => 'array'
        ]);

        $project->update($data);
        $project->employees()->sync($data['employees'] ?? []);

        return redirect()->route('projects.index')->with('success', 'Proyecto actualizado correctamente.');
    }

    public function destroy(Project $project)
    {
        $project->delete();
        return redirect()->route('projects.index')->with('success', 'Proyecto eliminado correctamente.');
    }

public function financial()
{
    $projects = Project::with(['workLogs.employee.contract', 'materials', 'transports', 'meals'])->get();

    $projects->map(function ($project) {
        $employeeCost = $project->workLogs->sum(function ($log) {
            $salary = $log->employee->contract->salary ?? 0;
            $hourlyRate = $salary / 160;
            return $log->hours * $hourlyRate;
        });

        $materialCost = $project->materials->sum('cost');
        $transportCost = $project->transports->sum('cost');
        $mealCost = $project->meals->sum('cost');

        $project->total_cost = $employeeCost + $materialCost + $transportCost + $mealCost;
        $project->employee_cost = $employeeCost;
        $project->material_cost = $materialCost;
        $project->transport_cost = $transportCost;
        $project->meal_cost = $mealCost;

        return $project;
    });

    return view('projects.financial', compact('projects'));
}


}
