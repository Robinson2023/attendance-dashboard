@extends('layouts.app')

@section('content')
<div class="max-w-md mx-auto bg-white p-6 rounded shadow">
    <h1 class="text-xl font-bold mb-4">Marcar asistencia</h1>

    @if(session('success'))
        <div class="bg-green-100 text-green-800 p-2 rounded mb-3">
            {{ session('success') }}
        </div>
    @endif

    <form method="POST" action="{{ route('attendance.store') }}" id="attendanceForm">
        @csrf
        <input type="hidden" name="latitud" id="latitud">
        <input type="hidden" name="longitud" id="longitud">

        <label class="block mb-2 font-semibold">Tipo de marcación</label>
        <select name="type" class="border rounded w-full p-2 mb-4" required>
            <option value="">Seleccione</option>
            <option value="entrada">Entrada</option>
            <option value="salida">Salida</option>
        </select>

        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded w-full">
            Marcar ahora
        </button>
    </form>
</div>

<script>
document.addEventListener('DOMContentLoaded', () => {
    if(navigator.geolocation){
        navigator.geolocation.getCurrentPosition((pos)=>{
            document.getElementById('latitud').value = pos.coords.latitude;
            document.getElementById('longitud').value = pos.coords.longitude;
        }, (err)=>{
            alert('No se pudo obtener la ubicación: ' + err.message);
        });
    } else {
        alert('Geolocalización no soportada por este navegador');
    }
});
</script>
@endsection
