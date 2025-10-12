@extends('layouts.app')

@section('content')

<h2 class="text-xl font-bold mb-4">📋 Registros de Horas</h2>

<!-- Filtros -->
<div class="bg-white shadow rounded p-4 mb-4">
    <form method="GET" action="{{ route('worklogs.index') }}" class="grid grid-cols-3 gap-4 items-end">
        <!-- Filtro por empleado -->
        <div>
            <label class="block text-sm font-medium">Empleado</label>
            <select name="employee_id" class="w-full border rounded p-2">
                <option value="">Todos</option>
                @foreach($employees as $emp)
                    <option value="{{ $emp->id }}" {{ request('employee_id') == $emp->id ? 'selected' : '' }}>
                        {{ $emp->first_name }} {{ $emp->last_name }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Filtro por proyecto -->
        <div>
            <label class="block text-sm font-medium">Proyecto</label>
            <select name="project_id" class="w-full border rounded p-2">
                <option value="">Todos</option>
                @foreach($projects as $proj)
                    <option value="{{ $proj->id }}" {{ request('project_id') == $proj->id ? 'selected' : '' }}>
                        {{ $proj->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Botones -->
        <div class="flex space-x-2">
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Filtrar</button>
            <a href="{{ route('worklogs.index') }}" class="bg-gray-400 text-white px-4 py-2 rounded">Limpiar</a>
        </div>
    </form>
</div>

<!-- Botón crear -->
<a href="{{ route('worklogs.create') }}" class="bg-green-600 text-white px-4 py-2 rounded mb-4 inline-block">
    ➕ Nuevo Registro
</a>

<!-- Tabla -->
<div class="bg-white shadow rounded overflow-hidden">
    <table class="min-w-full bg-white">
        <thead class="bg-gray-100">
            <tr>
                <th class="border px-4 py-2">Empleado</th>
                <th class="border px-4 py-2">Proyecto</th>
                <th class="border px-4 py-2">Fecha</th>
                <th class="border px-4 py-2">Inicio</th>
                <th class="border px-4 py-2">Fin</th>
                <th class="border px-4 py-2">Horas</th>
                <th class="border px-4 py-2">Notas</th>
                <th class="border px-4 py-2 text-center">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($worklogs as $log)
                <tr class="hover:bg-gray-50">
                    <td class="border px-4 py-2">
                        {{ $log->employee ? $log->employee->first_name . ' ' . $log->employee->last_name : '—' }}
                    </td>
                    <td class="border px-4 py-2">
                        {{ $log->project ? $log->project->name : '—' }}
                    </td>
                    <td class="border px-4 py-2">{{ $log->date }}</td>
                    <td class="border px-4 py-2">{{ $log->start_time }}</td>
                    <td class="border px-4 py-2">{{ $log->end_time }}</td>
                    <td class="border px-4 py-2 text-center">{{ $log->hours }}</td>
                    <td class="border px-4 py-2">{{ $log->notes }}</td>
                    <td class="border px-4 py-2 text-center">
                        <a href="{{ route('worklogs.edit', $log) }}" class="text-blue-600 hover:underline">Editar</a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" class="text-center py-4 text-gray-500">No hay registros disponibles</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <!-- Resumen total -->
    @if ($worklogs->count() > 0)
        <div class="bg-gray-50 border-t px-6 py-3 text-right font-semibold">
            Total de horas registradas:
            <span class="text-blue-700">
                {{ $worklogs->sum('hours') }}
            </span>
        </div>
    @endif
</div>

@endsection
