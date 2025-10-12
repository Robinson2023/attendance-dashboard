@extends('layouts.app')

@section('content')
<div class="flex justify-between items-center mb-6">
    <h2 class="text-xl font-bold text-gray-800">📦 Materiales del Proyecto</h2>
    <a href="{{ route('materials.create') }}" 
       class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
       ➕ Nuevo Material
    </a>
</div>

<div class="bg-white shadow rounded-lg p-6">
    <table class="min-w-full border border-gray-200 rounded">
        <thead class="bg-gray-100">
            <tr>
                <th class="px-4 py-2 border text-left">Proyecto</th>
                <th class="px-4 py-2 border text-left">Nombre</th>
                <th class="px-4 py-2 border text-left">Unidad</th>
                <th class="px-4 py-2 border text-right">Cantidad</th>
                <th class="px-4 py-2 border text-right">Costo Unitario</th>
                <th class="px-4 py-2 border text-right">Costo Total</th>
                <th class="px-4 py-2 border text-center">Fecha</th>
                <th class="px-4 py-2 border text-center">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($materials as $mat)
                <tr class="hover:bg-gray-50">
                    <td class="px-4 py-2 border">{{ $mat->project->name ?? '—' }}</td>
                    <td class="px-4 py-2 border">{{ $mat->name }}</td>
                    <td class="px-4 py-2 border">{{ $mat->unit }}</td>
                    <td class="px-4 py-2 border text-right">{{ $mat->quantity }}</td>
                    <td class="px-4 py-2 border text-right">${{ number_format($mat->unit_cost, 2) }}</td>
                    <td class="px-4 py-2 border text-right">${{ number_format($mat->total_cost, 2) }}</td>
                    <td class="px-4 py-2 border text-center">{{ $mat->date }}</td>
                    <td class="px-4 py-2 border text-center">
                        <form action="{{ route('materials.destroy', $mat->id) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button class="text-red-600 hover:text-red-800">🗑️</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" class="text-center py-4 text-gray-500">No hay materiales registrados.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
