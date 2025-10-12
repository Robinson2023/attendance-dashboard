@extends('layouts.app')

@section('content')
    <h2 class="text-xl font-bold mb-4">✏️ Editar Gasto de Transporte</h2>

    <div class="bg-white shadow rounded p-6">
        <form method="POST" action="{{ route('transports.update', $transport) }}">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label>Proyecto</label>
                    <select name="project_id" class="w-full border rounded p-2" required>
                        @foreach($projects as $p)
                            <option value="{{ $p->id }}" {{ $transport->project_id == $p->id ? 'selected' : '' }}>
                                {{ $p->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label>Fecha</label>
                    <input type="date" name="date" value="{{ $transport->date }}" class="w-full border rounded p-2" required>
                </div>

                <div class="col-span-2">
                    <label>Descripción</label>
                    <input type="text" name="description" value="{{ $transport->description }}" class="w-full border rounded p-2" required>
                </div>

                <div>
                    <label>Costo</label>
                    <input type="number" step="0.01" name="cost" value="{{ $transport->cost }}" class="w-full border rounded p-2" required>
                </div>
            </div>

            <button type="submit" class="mt-4 px-4 py-2 bg-blue-600 text-white rounded">Actualizar</button>
        </form>
    </div>
@endsection
