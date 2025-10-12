@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto bg-white p-6 shadow rounded">
    <h2 class="text-2xl font-semibold mb-4 text-indigo-700">➕ Nuevo Evento</h2>

    <form action="{{ route('events.store') }}" method="POST">
        @csrf

        <div class="mb-4">
            <label class="block text-sm font-medium">Título</label>
            <input type="text" name="title" class="w-full border rounded p-2" required>
        </div>

        <div class="mb-4">
            <label class="block text-sm font-medium">Fecha del evento</label>
            <input type="date" name="event_date" class="w-full border rounded p-2" required>
        </div>

        <div class="mb-4">
            <label class="block text-sm font-medium">Categoría</label>
            <select name="category" class="w-full border rounded p-2">
                <option value="">Seleccionar</option>
                <option value="visita">Visita Técnica</option>
                <option value="entrega">Entrega Proyecto</option>
                <option value="cronograma">Cronograma</option>
            </select>
        </div>

        <div class="mb-4">
            <label class="block text-sm font-medium">Descripción</label>
            <textarea name="description" rows="3" class="w-full border rounded p-2"></textarea>
        </div>

        <button class="bg-indigo-600 text-white px-4 py-2 rounded">Guardar</button>
    </form>
</div>
@endsection
