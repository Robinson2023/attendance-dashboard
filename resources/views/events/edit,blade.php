@extends('layouts.app')

@section('content')
<div class="p-6">
    <div class="flex items-center justify-between mb-6">
        <h2 class="text-2xl font-bold text-gray-800">✏️ Editar Evento</h2>
        <a href="{{ route('events.index') }}" 
           class="px-4 py-2 bg-gray-600 text-white rounded hover:bg-gray-700 transition">
            ⬅ Volver
        </a>
    </div>

    <div class="bg-white shadow rounded-lg p-6 max-w-2xl mx-auto">
        @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                <strong>⚠️ Error:</strong> Revisa los siguientes campos:
                <ul class="mt-2 list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('events.update', $event) }}" method="POST">
            @csrf
            @method('PUT')

            <!-- Título -->
            <div class="mb-4">
                <label for="title" class="block text-sm font-medium text-gray-700">Título del evento</label>
                <input type="text" name="title" id="title"
                       value="{{ old('title', $event->title) }}" 
                       class="w-full border rounded p-2 focus:ring-2 focus:ring-blue-400" 
                       required>
            </div>

            <!-- Descripción -->
            <div class="mb-4">
                <label for="description" class="block text-sm font-medium text-gray-700">Descripción</label>
                <textarea name="description" id="description" rows="4"
                          class="w-full border rounded p-2 focus:ring-2 focus:ring-blue-400">{{ old('description', $event->description) }}</textarea>
            </div>

            <!-- Fecha -->
            <div class="mb-4">
                <label for="event_date" class="block text-sm font-medium text-gray-700">Fecha del evento</label>
                <input type="date" name="event_date" id="event_date"
                       value="{{ old('event_date', $event->event_date) }}"
                       class="w-full border rounded p-2 focus:ring-2 focus:ring-blue-400" 
                       required>
            </div>

            <!-- Botones -->
            <div class="flex justify-end gap-3 mt-6">
                <a href="{{ route('events.index') }}"
                   class="px-4 py-2 bg-gray-300 text-gray-800 rounded hover:bg-gray-400 transition">
                    Cancelar
                </a>
                <button type="submit"
                        class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition">
                    💾 Actualizar
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
