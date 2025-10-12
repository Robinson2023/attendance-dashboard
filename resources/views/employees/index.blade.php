@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto p-6 bg-white shadow rounded">
    <h1 class="text-2xl font-bold mb-6 text-blue-600">Listado de Empleados</h1>

    @if(session('success'))
        <div class="mb-4 p-3 bg-green-100 border border-green-300 text-green-800 rounded">
            {{ session('success') }}
        </div>
    @endif

    <div class="mb-4 flex justify-end">
        <a href="{{ route('employees.create') }}"
           class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
           ➕ Nuevo empleado
        </a>
    </div>

    <div class="overflow-x-auto">
        <table class="min-w-full border border-gray-200 divide-y divide-gray-200 rounded-lg shadow-sm">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">Nombre</th>
                    <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">Cargo</th>
                    <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">N° Carnet</th>
                    <th class="px-4 py-2 text-center text-sm font-semibold text-gray-700">Acciones</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @forelse($employees as $employee)
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-2 text-sm text-gray-800">
                            {{ $employee->first_name }} {{ $employee->last_name }}
                        </td>
                        <td class="px-4 py-2 text-sm text-gray-800">
                            {{ $employee->position ?? '—' }}
                        </td>
                        <td class="px-4 py-2 text-sm text-gray-800">
                            {{ $employee->internal_card_number ?? '—' }}
                        </td>
                        <td class="px-4 py-2 text-center space-x-2">
                            <a href="{{ route('employees.show', $employee) }}"
                               class="bg-gray-500 text-white px-3 py-1 rounded text-sm hover:bg-gray-600">
                               👁 Ver
                            </a>
                            <a href="{{ route('employees.edit', $employee) }}"
                               class="bg-blue-600 text-white px-3 py-1 rounded text-sm hover:bg-blue-700">
                               ✏️ Editar
                            </a>
                            <form action="{{ route('employees.destroy', $employee) }}"
                                  method="POST" class="inline-block"
                                  onsubmit="return confirm('¿Seguro que deseas eliminar este empleado?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        class="bg-red-600 text-white px-3 py-1 rounded text-sm hover:bg-red-700">
                                    🗑 Eliminar
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="px-4 py-6 text-center text-gray-500 text-sm">
                            No hay empleados registrados.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Paginación --}}
    <div class="mt-6">
        {{ $employees->links() }}
    </div>
</div>
@endsection
