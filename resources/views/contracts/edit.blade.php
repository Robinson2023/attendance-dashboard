@extends('layouts.app')

@section('content')
        <h2 class="text-xl font-bold">✏️ Editar Contrato</h2>
    <br>

    <div class="bg-white shadow rounded p-6">
        <form action="{{ route('contracts.update', $contract) }}" method="POST" class="space-y-4">
            @csrf
            @method('PUT')

            <!-- Empleado -->
            <div>
                <label for="employee_id" class="block font-medium">Empleado</label>
                <select name="employee_id" id="employee_id" class="w-full border rounded px-3 py-2" required>
                    @foreach($employees as $employee)
                        <option value="{{ $employee->id }}" 
                                @if($contract->employee_id == $employee->id) selected @endif>
                            {{ $employee->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Tipo de contrato -->
            <div>
                <label for="type" class="block font-medium">Tipo de Contrato</label>
                <select name="type" id="type" class="w-full border rounded px-3 py-2" required>
                    <option value="Fijo" @selected($contract->type == 'Fijo')>Fijo</option>
                    <option value="Indefinido" @selected($contract->type == 'Indefinido')>Indefinido</option>
                    <option value="Prestación de Servicios" @selected($contract->type == 'Prestación de Servicios')>
                        Prestación de Servicios
                    </option>
                    <option value="Aprendizaje" @selected($contract->type == 'Aprendizaje')>Aprendizaje</option>
                </select>
            </div>

            <!-- Salario -->
            <div>
                <label for="salary" class="block font-medium">Salario</label>
                <input type="number" step="0.01" name="salary" id="salary"
                       class="w-full border rounded px-3 py-2"
                       value="{{ $contract->salary }}" required>
            </div>

            <!-- Fechas -->
            <div>
                <label for="start_date" class="block font-medium">Fecha de Inicio</label>
                <input type="date" name="start_date" id="start_date"
                       class="w-full border rounded px-3 py-2"
                       value="{{ $contract->start_date }}" required>
            </div>

            <div>
                <label for="end_date" class="block font-medium">Fecha de Fin</label>
                <input type="date" name="end_date" id="end_date"
                       class="w-full border rounded px-3 py-2"
                       value="{{ $contract->end_date }}">
            </div>

            <!-- Botones -->
            <div class="flex justify-end space-x-2">
                <a href="{{ route('contracts.index') }}"
                   class="px-4 py-2 bg-gray-500 text-white rounded">Cancelar</a>
                <button type="submit"
                        class="px-4 py-2 bg-green-600 text-white rounded">Actualizar</button>
            </div>
        </form>
    </div>
@endsection
