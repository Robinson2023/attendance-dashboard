@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto p-6">
    <h1 class="text-2xl font-bold mb-6 text-gray-800">📊 Resumen Financiero de Proyectos</h1>

    <div class="bg-white shadow rounded-lg overflow-hidden">
        <table class="min-w-full text-sm text-left border-collapse">
            <thead class="bg-gray-100 text-gray-700 uppercase text-xs">
                <tr>
                    <th class="px-6 py-3 border-b">Proyecto</th>
                    <th class="px-6 py-3 border-b">Costo Empleados</th>
                    <th class="px-6 py-3 border-b">Costo Materiales</th>
                    <th class="px-6 py-3 border-b">Costo Transporte</th>
                    <th class="px-6 py-3 border-b">Costo Alimentación</th>
                    <th class="px-6 py-3 border-b font-semibold">Costo Total</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @forelse($projects as $project)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 font-medium text-gray-900">
                            {{ $project->name }}
                        </td>
                        <td class="px-6 py-4 text-gray-700">
                            ${{ number_format($project->employee_cost, 2, ',', '.') }}
                        </td>
                        <td class="px-6 py-4 text-gray-700">
                            ${{ number_format($project->material_cost, 2, ',', '.') }}
                        </td>
                        <td class="px-6 py-4 text-gray-700">
                            ${{ number_format($project->transport_cost, 2, ',', '.') }}
                        </td>
                        <td class="px-6 py-4 text-gray-700">
                            ${{ number_format($project->meal_cost, 2, ',', '.') }}
                        </td>
                        <td class="px-6 py-4 font-semibold text-blue-700">
                            ${{ number_format($project->total_cost, 2, ',', '.') }}
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-6 py-4 text-center text-gray-500">
                            No hay proyectos registrados aún.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-6 text-right">
        <a href="{{ route('projects.index') }}" class="inline-block bg-gray-700 hover:bg-gray-800 text-white px-4 py-2 rounded">
            ← Volver a Proyectos
        </a>
    </div>
</div>
@endsection
