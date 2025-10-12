<?php

namespace App\Http\Controllers;

use App\Models\MealExpense;
use App\Models\Project;
use Illuminate\Http\Request;

class MealExpenseController extends Controller
{
    public function index()
    {
        $meals = MealExpense::with('project')->latest()->get();
        return view('meals.index', compact('meals'));
    }

    public function create()
    {
        $projects = Project::all();
        return view('meals.create', compact('projects'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'project_id'   => 'required|exists:projects,id',
            'description'  => 'required|string|max:255',
            'cost'         => 'required|numeric|min:0',
            'date'         => 'required|date',
        ]);

        MealExpense::create($request->all());

        return redirect()->route('meals.index')
                         ->with('success', 'Gasto de alimentación registrado correctamente.');
    }

    public function destroy($id)
    {
        $meal = MealExpense::findOrFail($id);
        $meal->delete();

        return redirect()->route('meals.index')
                         ->with('success', 'Gasto eliminado correctamente.');
    }
}
