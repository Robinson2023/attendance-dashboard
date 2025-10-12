@extends('layouts.app')

@section('content')
        <h2 class="text-xl font-bold">✏️ Editar Registro</h2>


    <div class="bg-white shadow rounded p-6">
        <form method="POST" action="{{ route('worklogs.update', $worklog) }}">
            @csrf
            @method('PUT')

            <!-- Empleado -->
            <div class="mb-4">
                <label for="employee_id" class="block text-sm font-medium">Empleado</label>
                <select name="employee_id" id="employee_id" class="w-full border rounded p-2">
                    @foreach($employees as $employee)
                        <option value="{{ $employee->id }}" @if($employee->id == $worklog->employee_id) selected @endif>
                            {{ $employee->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Proyecto -->
            <div class="mb-4">
                <label for="project_id" class="block text-sm font-medium">Proyecto</label>
                <select name="project_id" id="project_id" class="w-full border rounded p-2">
                    @foreach($projects as $project)
                        <option value="{{ $project->id }}" @if($project->id == $worklog->project_id) selected @endif>
                            {{ $project->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Fecha -->
            <div class="mb-4">
                <label for="date" class="block text-sm font-medium">Fecha</label>
                <input type="date" name="date" id="date" class="w-full border rounded p-2" value="{{ $worklog->date }}" required>
            </div>

            <!-- Inicio -->
            <div class="mb-4">
                <label for="start_time" class="block text-sm font-medium">Hora Inicio</label>
                <input type="time" name="start_time" id="start_time" class="w-full border rounded p-2" value="{{ $worklog->start_time }}" required>
            </div>

            <!-- Fin -->
            <div class="mb-4">
                <label for="end_time" class="block text-sm font-medium">Hora Fin</label>
                <input type="time" name="end_time" id="end_time" class="w-full border rounded p-2" value="{{ $worklog->end_time }}" required>
            </div>

            <!-- Notas -->
            <div class="mb-4">
                <label for="notes" class="block text-sm font-medium">Notas</label>
                <textarea name="notes" id="notes" rows="3" class="w-full border rounded p-2">{{ $worklog->notes }}</textarea>
            </div>

            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded">Actualizar</button>
        </form>
    </div>
@endsection

