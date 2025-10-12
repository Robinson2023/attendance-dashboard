@extends('layouts.app')

@section('content')
<div class="bg-white shadow rounded p-6 max-w-3xl mx-auto">
    <h2 class="text-2xl font-bold text-gray-700 mb-4">✏️ Editar Material</h2>

    <form method="POST" action="{{ route('materials.update', $material->id) }}">
        @csrf
        @method('PUT')
        <div class="grid grid-cols-2 gap-4">

            <!-- Proyecto -->
            <div class="col-span-2">
                <label for="project_id" class="block text-sm font-medium text-gray-700 mb-1">Proyecto</label>
                <select name="project_id" id="project_id" class="w-full border rounded p-2" required>
                    @foreach ($projects as $project)
                        <option value="{{ $project->id }}" {{ $material->project_id == $project->id ? 'selected' : '' }}>
                            {{ $project->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Nombre -->
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Nombre del material</label>
                <input type="text" name="name" id="name" class="w-full border rounded p-2" value="{{ $material->name }}" required>
            </div>

            <!-- Cantidad -->
            <div>
                <label for="quantity" class="block text-sm font-medium text-gray-700 mb-1">Cantidad</label>
                <input type="number" name="quantity" id="quantity" class="w-full border rounded p-2" required min="1" step="any" value="{{ $material->quantity }}">
            </div>

            <!-- Costo unitario -->
            <div>
                <label for="unit_cost" class="block text-sm font-medium text-gray-700 mb-1">Costo unitario</label>
                <input type="number" step="0.01" name="unit_cost" id="unit_cost" class="w-full border rounded p-2" required value="{{ $material->unit_cost }}">
            </div>

            <!-- Total automático -->
            <div>
                <label for="total_cost" class="block text-sm font-medium text-gray-700 mb-1">Costo total (auto)</label>
                <input type="text" id="total_cost" class="w-full border rounded p-2 bg-gray-100" readonly>
            </div>
        </div>

        <div class="mt-6 flex justify-between">
            <a href="{{ route('materials.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">⬅ Volver</a>
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">💾 Actualizar</button>
        </div>
    </form>
</div>

<script>
document.addEventListener("DOMContentLoaded", () => {
    const qtyInput = document.getElementById("quantity");
    const costInput = document.getElementById("unit_cost");
    const totalInput = document.getElementById("total_cost");

    function updateTotal() {
        const qty = parseFloat(qtyInput.value) || 0;
        const cost = parseFloat(costInput.value) || 0;
        const total = qty * cost;
        totalInput.value = total.toLocaleString('es-CO', { style: 'currency', currency: 'COP' });
    }

    qtyInput.addEventListener("input", updateTotal);
    costInput.addEventListener("input", updateTotal);

    // Calcular automáticamente al cargar la página
    updateTotal();
});
</script>
@endsection
