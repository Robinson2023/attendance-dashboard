@extends('layouts.app')

@section('content')

    <h2 class="text-xl font-bold">📂 Proyectos</h2>

<br>
    <div class="mb-4">
        <a href="{{ route('projects.create') }}"
           class="px-4 py-2 bg-blue-600 text-white rounded">+ Crear Proyecto</a>
    </div>

    <div class="bg-white shadow rounded p-4">
        <table class="min-w-full border">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-2 py-1 border">Nombre</th>
                    <th class="px-2 py-1 border">Cliente</th>
                    <th class="px-2 py-1 border">Precio</th>
                    <th class="px-2 py-1 border">Fechas</th>
                    <th class="px-2 py-1 border">Empleados</th>
                    <th class="px-2 py-1 border">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($projects as $project)
                    <tr>
                        <td class="border px-2 py-1">{{ $project->name }}</td>
                        <td class="border px-2 py-1">{{ $project->client }}</td>
                        <td class="border px-2 py-1">${{ number_format($project->price, 2) }}</td>
                        <td class="border px-2 py-1">{{ $project->start_date }} → {{ $project->end_date }}</td>
                        <td class="border px-2 py-1">
                            @foreach ($project->employees as $emp)
                                <span class="bg-gray-200 rounded px-2">{{ $emp->name }}</span>
                            @endforeach
                        </td>
                        <td class="border px-2 py-1">
                            <a href="{{ route('projects.edit', $project) }}" class="px-2 py-1 bg-yellow-500 text-white rounded">Editar</a>
                            <form action="{{ route('projects.destroy', $project) }}" method="POST" class="inline">
                                @csrf @method('DELETE')
                                <button type="submit" class="px-2 py-1 bg-red-600 text-white rounded"
                                        onclick="return confirm('¿Eliminar este proyecto?')">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection

