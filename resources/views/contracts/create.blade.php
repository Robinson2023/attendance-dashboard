@extends('layouts.app')

@section('content')
        <h2 class="text-xl font-bold">➕ Crear Contrato</h2>
        
    <br>

    <div class="bg-white shadow rounded p-6">
        <form action="{{ route('contracts.store') }}" method="POST" class="space-y-4">
            @csrf

            <!-- Empleado -->
    <div class="col-span-2">
        <label class="block mb-2">Empleado:</label>
            <select name="employees[]" class="w-full border rounded" multiple>
                @foreach ($employees as $emp)
                    <option value="{{ $emp->id }}">
                        {{ $emp->first_name }} {{ $emp->last_name }}
                    </option>
                @endforeach
            </select>
    </div>


            <!-- Tipo de contrato -->
            <div>
                <label for="type" class="block font-medium">Tipo de Contrato</label>
                <select name="type" id="type" class="w-full border rounded px-3 py-2" required>
                    <option value="">-- Seleccionar --</option>
                    <option value="Fijo">Fijo</option>
                    <option value="Indefinido">Indefinido</option>
                    <option value="Prestación de Servicios">Prestación de Servicios</option>
                    <option value="Aprendizaje">Aprendizaje</option>
                </select>
            </div>

            <!-- Salario -->
            <div>
                <label for="salary" class="block font-medium">Salario</label>
                <input type="number" step="0.01" name="salary" id="salary"
                       class="w-full border rounded px-3 py-2" required>
            </div>

            <!-- Fechas -->
            <div>
                <label for="start_date" class="block font-medium">Fecha de Inicio</label>
                <input type="date" name="start_date" id="start_date"
                       class="w-full border rounded px-3 py-2" required>
            </div>

            <div>
                <label for="end_date" class="block font-medium">Fecha de Fin</label>
                <input type="date" name="end_date" id="end_date"
                       class="w-full border rounded px-3 py-2">
            </div>

            <!-- Botones -->
            <div class="flex justify-end space-x-2">
                <a href="{{ route('contracts.index') }}"
                   class="px-4 py-2 bg-gray-500 text-white rounded">Cancelar</a>
                <button type="submit"
                        class="px-4 py-2 bg-blue-600 text-white rounded">Guardar</button>
            </div>
        </form>
    </div>
@endsection
