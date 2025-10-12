@extends('layouts.app')

@section('content')
<div class="max-w-lg mx-auto bg-white shadow p-6 rounded">
    <h2 class="text-xl font-bold mb-4">Registrar Salida</h2>

    <form action="{{ route('attendances.update', $attendance->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label class="block font-semibold mb-1">Empleado</label>
            <p>{{ $attendance->employee->name }}</p>
        </div>

        <div class="mb-4">
            <label class="block font-semibold mb-1">Fecha</label>
            <p>{{ $attendance->fecha }}</p>
        </div>

        <div class="mb-4">
            <label for="hora_salida" class="block font-semibold mb-1">Hora de Salida</label>
            <input type="time" name="hora_salida" id="hora_salida"
                   class="w-full border rounded p-2" required
                   value="{{ old('hora_salida', $attendance->hora_salida) }}">
            @error('hora_salida')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <button type="submit"
                class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
            Guardar
        </button>
    </form>
</div>
@endsection