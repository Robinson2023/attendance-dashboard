@extends('layouts.app')

@section('content')

<h2 class="text-2xl font-bold text-gray-800 mb-4">➕ Crear Proyecto</h2>

<div class="bg-white shadow rounded p-6">
    <form action="{{ route('projects.store') }}" method="POST">
        @csrf

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-600">Nombre del Proyecto</label>
                <input type="text" name="name" class="w-full border rounded p-2" required>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-600">Cliente</label>
                <input type="text" name="client" class="w-full border rounded p-2" required>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-600">Precio Total</label>
                <input type="number" step="0.01" name="price" class="w-full border rounded p-2" required>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-600">Fecha Inicio</label>
                <input type="date" name="start_date" class="w-full border rounded p-2" required>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-600">Fecha Fin</label>
                <input type="date" name="end_date" class="w-full border rounded p-2" required>
            </div>

            <div class="col-span-2">
                <label class="block text-sm font-medium text-gray-600">Asignar Empleados</label>
                <select name="employees[]" class="w-full border rounded p-2" multiple>
                    @foreach ($employees as $emp)
                        <option value="{{ $emp->id }}">
                            {{ $emp->first_name }} {{ $emp->last_name }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>

        <!-- Sección de costos -->
        <div class="mt-6 bg-gray-50 p-4 rounded border border-gray-200">
            <h3 class="text-lg font-semibold mb-3 text-gray-700">💰 Costos Estimados</h3>

            <div class="grid grid-cols-3 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-600">Transporte</label>
                    <input type="number" step="0.01" name="transport_cost" class="w-full border rounded p-2" placeholder="0.00">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-600">Alimentación</label>
                    <input type="number" step="0.01" name="meal_cost" class="w-full border rounded p-2" placeholder="0.00">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-600">Materiales</label>
                    <input type="number" step="0.01" name="material_cost" class="w-full border rounded p-2" placeholder="0.00">
                </div>
            </div>
        </div>

        <button type="submit" class="mt-6 px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded shadow">
            Guardar Proyecto
        </button>
    </form>
</div>

@endsection
