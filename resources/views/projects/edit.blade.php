@extends('layouts.app')

@section('content')
    
        <h2 class="text-xl font-bold">✏️ Editar Proyecto</h2>
    

    <form action="{{ route('projects.update', $project) }}" method="POST" class="bg-white shadow rounded p-4">
        @csrf @method('PUT')
        <div class="grid grid-cols-2 gap-4">
            <div>
                <label>Nombre</label>
                <input type="text" name="name" class="w-full border rounded" value="{{ $project->name }}" required>
            </div>
            <div>
                <label>Cliente</label>
                <input type="text" name="client" class="w-full border rounded" value="{{ $project->client }}" required>
            </div>
            <div>
                <label>Precio</label>
                <input type="number" step="0.01" name="price" class="w-full border rounded" value="{{ $project->price }}" required>
            </div>
            <div>
                <label>Fecha inicio</label>
                <input type="date" name="start_date" class="w-full border rounded" value="{{ $project->start_date }}" required>
            </div>
            <div>
                <label>Fecha fin</label>
                <input type="date" name="end_date" class="w-full border rounded" value="{{ $project->end_date }}" required>
            </div>
            <div class="col-span-2">
                <label>Asignar empleados</label>
                <select name="employees[]" class="w-full border rounded" multiple>
                    @foreach ($employees as $emp)
                        <option value="{{ $emp->id }}">
                            {{ $emp->first_name }} {{ $emp->last_name }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>
        <button class="mt-4 px-4 py-2 bg-blue-600 text-white rounded">Actualizar</button>
    </form>
@endsection
