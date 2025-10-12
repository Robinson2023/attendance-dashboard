@extends('layouts.app')

@section('content')
<div class="p-6 bg-gray-100 rounded-lg shadow">
    <h2 class="text-xl font-semibold mb-4 text-gray-800">Registro de Asistencias</h2>

    <form method="GET" action="{{ route('attendances.index') }}" class="mb-4 flex flex-wrap gap-3 items-center">
        <input type="date" name="desde" value="{{ $desde }}" class="border border-gray-300 rounded px-3 py-2">
        <input type="date" name="hasta" value="{{ $hasta }}" class="border border-gray-300 rounded px-3 py-2">
        <button class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Filtrar</button>
    </form>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        @forelse($registros as $r)
            <div class="bg-white p-4 rounded-xl shadow hover:shadow-md transition">
                <p class="text-gray-800 font-semibold">
                    <span class="text-blue-600">Empleado:</span> {{ $r->employee->first_name }} {{ $r->employee->last_name }}
                </p>

                <p class="text-gray-800">
                    <span class="text-blue-600">Entrada:</span> {{ $r->hora_entrada ?? '—' }}
                </p>

                @if($r->hora_salida)
                    <p class="text-gray-800">
                        <span class="text-green-600">Salida:</span> {{ $r->hora_salida }}
                    </p>
                @endif

                @if($r->latitud && $r->longitud)
                    <a href="https://www.google.com/maps?q={{ $r->latitud }},{{ $r->longitud }}" 
                       target="_blank" 
                       class="text-blue-600 underline text-sm mt-2 inline-block">
                       Ver ubicación en mapa
                    </a>
                @endif

                <p class="text-gray-500 text-xs mt-2">
                    {{ $r->fecha }}
                </p>
            </div>
        @empty
            <p class="col-span-3 text-gray-500 text-center py-4">No hay registros en el rango seleccionado.</p>
        @endforelse
    </div>
</div>
@endsection
