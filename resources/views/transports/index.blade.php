@extends('layouts.app')

@section('content')
<div class="flex justify-between items-center mb-6">
    <h2 class="text-xl font-bold text-gray-800">🚛 Gastos de Transporte</h2>
    <a href="{{ route('transports.create') }}" 
       class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
       ➕ Nuevo Gasto
    </a>
</div>

<div class="bg-white shadow rounded-lg p-6">
    <table class="min-w-full border border-gray-200 rounded">
        <thead class="bg-gray-100">
            <tr>
                <th class="px-4 py-2 border text-left">Proyecto</th>
                <th class="px-4 py-2 border text-left">Descripción</th>
                <th class="px-4 py-2 border text-right">Costo</th>
                <th class="px-4 py-2 border text-center">Fecha</th>
                <th class="px-4 py-2 border text-center">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($transports as $t)
                <tr class="hover:bg-gray-50">
                    <td class="px-4 py-2 border">{{ $t->project->name ?? '—' }}</td>
                    <td class="px-4 py-2 border">{{ $t->description }}</td>
                    <td class="px-4 py-2 border text-right">${{ number_format($t->cost, 2) }}</td>
                    <td class="px-4 py-2 border text-center">{{ $t->date }}</td>
                    <td class="px-4 py-2 border text-center">
                        <form action="{{ route('transports.destroy', $t->id) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button class="text-red-600 hover:text-red-800">🗑️</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center py-4 text-gray-500">No hay gastos de transporte registrados.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
