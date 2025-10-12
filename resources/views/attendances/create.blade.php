@extends('layouts.app')

@section('content')
<div class="max-w-lg mx-auto bg-white shadow rounded p-6">
    <h1 class="text-2xl font-bold mb-4">🕒 Registrar asistencia</h1>

<form action="{{ route('attendances.store') }}" method="POST" class="max-w-md bg-white shadow p-4 rounded">
    @csrf

    <label>Empleado:</label>
    <select name="employee_id" class="border rounded w-full mb-3">
        @foreach($employees as $emp)
            <option value="{{ $emp->id }}">{{ $emp->first_name }} {{ $emp->last_name }}</option>
        @endforeach
    </select>

    <label>Fecha:</label>
    <input type="date" name="fecha" value="{{ date('Y-m-d') }}" class="border rounded w-full mb-3">

    <label>Hora actual:</label>
    <input type="time" name="hora" value="{{ date('H:i') }}" class="border rounded w-full mb-3">

    <label>Tipo de registro:</label>
    <select name="tipo" class="border rounded w-full mb-3">
        <option value="entrada">Entrada</option>
        <option value="salida">Salida</option>
    </select>

    <button class="bg-green-600 text-white px-4 py-2 rounded">Registrar</button>
</form>
</div>

<script>
document.addEventListener('DOMContentLoaded', () => {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(
            (pos) => {
                document.getElementById('latitud').value = pos.coords.latitude;
                document.getElementById('longitud').value = pos.coords.longitude;
            },
            (err) => console.warn('⚠️ No se pudo obtener la ubicación:', err.message)
        );
    }
});
</script>
@endsection
