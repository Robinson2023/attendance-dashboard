@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6">
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-2xl font-semibold text-indigo-700">📅 Lista de Eventos</h2>
        <a href="{{ route('events.create') }}" class="bg-indigo-600 text-white px-4 py-2 rounded">Nuevo Evento</a>
    </div>

    <table class="min-w-full bg-white rounded shadow">
        <thead class="bg-gray-100">
            <tr>
                <th class="px-4 py-2 text-left">Título</th>
                <th class="px-4 py-2 text-left">Fecha</th>
                <th class="px-4 py-2 text-left">Categoría</th>
                <th class="px-4 py-2 text-left">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($events as $event)
            <tr class="border-b">
                <td class="px-4 py-2">{{ $event->title }}</td>
                <td class="px-4 py-2">{{ $event->event_date }}</td>
                <td class="px-4 py-2 capitalize">{{ $event->category ?? '-' }}</td>
                <td class="px-4 py-2">
                    <a href="{{ route('events.edit', $event) }}" class="text-blue-600 hover:underline">Editar</a> |
                    <form action="{{ route('events.destroy', $event) }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button onclick="return confirm('¿Eliminar evento?')" class="text-red-600 hover:underline">Eliminar</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="mt-4">
        {{ $events->links() }}
    </div>
</div>
@endsection
