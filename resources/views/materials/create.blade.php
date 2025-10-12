@extends('layouts.app')

@section('content')
<h2 class="text-xl font-bold text-gray-800 mb-4">➕ Registrar Material</h2>

<div class="bg-white shadow rounded-lg p-6">
    <form action="{{ route('materials.store') }}" method="POST">
        @csrf

        <!-- Proyecto -->
        <div class="mb-4">
            <label for="project_id" class="block text-sm font-medium">Proyecto</label>
            <select name="project_id" id="project_id" class="w-full border rounded p-2">
                @foreach($projects as $project)
                    <option value="{{ $project->id }}">{{ $project->name }}</option>
                @endforeach
            </select>
        </div>

        <!-- Nombre -->
        <div class="mb-4">
            <label for="name" class="block text-sm font-medium">Nombre del Material</label>
            <input type="text" name="name" id="name" class="w-full border rounded p-2" required>
        </div>

        <!-- Unidad -->
        <div class="mb-4">
            <label for="unit" class="block text-sm font-medium">Unidad</label>
            <input type="text" name="unit" id="unit" class="w-full border rounded p-2" placeholder="Ej: kg, m³, unidad">
        </div>

        <!-- Cantidad -->
        <div class="mb-4">
            <label for="quantity" class="block text-sm font-medium">Cantidad</label>
            <input type="number" name="quantity" id="quantity" class="w-full border rounded p-2" min="1" value="1" required>
        </div>

        <!-- Costo Unitario -->
        <div class="mb-4">
            <label for="unit_cost" class="block text-sm font-medium">Costo Unitario</label>
            <input type="number" name="unit_cost" id="unit_cost" step="0.01" class="w-full border rounded p-2" required>
        </div>

        <!-- Fecha -->
        <div class="mb-4">
            <label for="date" class="block text-sm font-medium">Fecha</label>
            <input type="date" name="date" id="date" class="w-full border rounded p-2" required>
        </div>

        <!-- Botón -->
        <div class="mt-6">
            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                Guardar
            </button>
            <a href="{{ route('materials.index') }}" class="ml-2 text-gray-600 hover:underline">Cancelar</a>
        </div>

        <div class="mb-4">
             <label for="project_id" class="block text-sm font-medium">Proyecto</label>
            <select name="project_id" id="project_id" class="w-full border rounded p-2" required>
             @foreach ($projects as $project)
                    <option value="{{ $project->id }}">{{ $project->name }}</option>
             @endforeach
            </select>
        </div>

    </form>
</div>
@endsection
