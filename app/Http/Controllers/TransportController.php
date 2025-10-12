<?php

namespace App\Http\Controllers;

use App\Models\TransportExpense;
use App\Models\Project;
use Illuminate\Http\Request;

class TransportController extends Controller
{
    public function index()
    {
        $transports = TransportExpense::with('project')->latest()->get();
        return view('transports.index', compact('transports'));
    }

    public function create()
    {
        $projects = Project::all();
        return view('transports.create', compact('projects'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'project_id'   => 'required|exists:projects,id',
            'description'  => 'required|string|max:255',
            'cost'         => 'required|numeric|min:0',
            'date'         => 'required|date',
        ]);

        TransportExpense::create($request->all());

        return redirect()->route('transports.index')
                         ->with('success', 'Gasto de transporte registrado correctamente.');
    }

    public function destroy($id)
    {
        $transport = TransportExpense::findOrFail($id);
        $transport->delete();

        return redirect()->route('transports.index')
                         ->with('success', 'Gasto eliminado correctamente.');
    }
}
