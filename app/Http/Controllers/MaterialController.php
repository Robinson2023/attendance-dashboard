<?php

namespace App\Http\Controllers;

use App\Models\Material;
use App\Models\Project;
use Illuminate\Http\Request;

class MaterialController extends Controller
{
    /**
     * Mostrar todos los materiales
     */
    public function index()
    {
        $materials = Material::with('project')->latest()->get();

        return view('materials.index', compact('materials'));
    }

    /**
     * Mostrar formulario para crear material
     */
public function create()
{
    $projects = Project::all();
    return view('materials.create', compact('projects'));
}


    /**
     * Guardar un nuevo material
     */
    public function store(Request $request)
    {
        $request->validate([
            'project_id' => 'required|exists:projects,id',
            'name'       => 'required|string|max:255',
            'quantity'   => 'required|numeric|min:1',
            'unit_cost'  => 'required|numeric|min:0',
        ]);

        Material::create($request->all());

        return redirect()
            ->route('materials.index')
            ->with('success', '✅ Material registrado correctamente.');
    }

    /**
     * Mostrar formulario de edición
     */
    public function edit(Material $material)
    {
        $projects = Project::orderBy('name')->get();

        return view('materials.edit', compact('material', 'projects'));
    }

    /**
     * Actualizar material
     */
    public function update(Request $request, Material $material)
    {
        $request->validate([
            'project_id' => 'required|exists:projects,id',
            'name'       => 'required|string|max:255',
            'quantity'   => 'required|numeric|min:1',
            'unit_cost'  => 'required|numeric|min:0',
        ]);

        $material->update($request->all());

        return redirect()
            ->route('materials.index')
            ->with('success', '✏️ Material actualizado correctamente.');
    }

    /**
     * Eliminar material
     */
    public function destroy(Material $material)
    {
        $material->delete();

        return redirect()
            ->route('materials.index')
            ->with('success', '🗑 Material eliminado correctamente.');
    }
}
