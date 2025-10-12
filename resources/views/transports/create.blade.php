@extends('layouts.app')

@section('content')
<h2 class="text-xl font-bold text-gray-800 mb-4">➕ Registrar Gasto de Transporte</h2>

<div class="bg-white shadow rounded-lg p-6">
    <form action="{{ route('transports.store') }}" method="POST">
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

        <!-- Descripción -->
        <div class="mb-4">
            <label for="description" class="block text-sm font-medium">Descripción</label>
            <input type="text" name="description" id="description" class="w-full border rounded p-2" required>
        </div>

        <!-- Costo -->
        <div class="mb-4">
            <label for="cost" class="block text-sm font-medium">Costo</label>
            <input type="number" step="0.01" name="cost" id="cost" class="w-full border rounded p-2" required>
        </div>

        <!-- Fecha -->
        <div class="mb-4">
            <label for="date" class="block text-sm font-medium">Fecha</label>
            <input type="date" name="date" id="date" class="w-full border rounded p-2" required>
        </div>

        <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
            Guardar
        </button>
        <a href="{{ route('transports.index') }}" class="ml-2 text-gray-600 hover:underline">Cancelar</a>
    </form>
</div>
@endsection

