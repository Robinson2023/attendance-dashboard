@extends('layouts.app')

@section('content')

    <h2 class="text-xl font-bold">📑 Contratos</h2>

    <br>

    <!-- Botón crear -->
    <div class="mb-4">
        <a href="{{ route('contracts.create') }}"
           class="px-4 py-2 bg-blue-600 text-white rounded">
           ➕ Nuevo Contrato
        </a>
    </div>

    <!-- Tabla de contratos -->
    <div class="bg-white shadow rounded p-4">
        <table class="min-w-full border">
            <thead class="bg-gray-100">
                <tr>
                    <th class="border px-2 py-1">Empleado</th>
                    <th class="border px-2 py-1">Tipo</th>
                    <th class="border px-2 py-1">Salario</th>
                    <th class="border px-2 py-1">Inicio</th>
                    <th class="border px-2 py-1">Fin</th>
                    <th class="border px-2 py-1">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse($contracts as $contract)
                    <tr>
                        <td class="border px-2 py-1">{{ $contract->employee->name }}</td>
                        <td class="border px-2 py-1">{{ $contract->type }}</td>
                        <td class="border px-2 py-1">${{ number_format($contract->salary, 0, ',', '.') }}</td>
                        <td class="border px-2 py-1">{{ $contract->start_date }}</td>
                        <td class="border px-2 py-1">{{ $contract->end_date ?? 'Vigente' }}</td>
                        <td class="border px-2 py-1">
                            <a href="{{ route('contracts.edit', $contract) }}"
                               class="px-2 py-1 bg-yellow-500 text-white rounded">✏️</a>
                            <form action="{{ route('contracts.destroy', $contract) }}" method="POST" class="inline">
                                @csrf @method('DELETE')
                                <button onclick="return confirm('¿Eliminar contrato?')"
                                        class="px-2 py-1 bg-red-600 text-white rounded">🗑️</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center py-2">No hay contratos registrados</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
