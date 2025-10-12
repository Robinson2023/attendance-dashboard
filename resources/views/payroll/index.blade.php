@extends('layouts.app')

@section('content')
<h1 class="text-2xl font-bold mb-4">💵 Nómina diaria</h1>

<!-- Formulario para generar nómina de una fecha -->
<form action="{{ route('payroll.generate', date('Y-m-d')) }}" method="POST"
      class="flex items-center gap-2 mb-6">
    @csrf
    <input type="date" name="date" value="{{ date('Y-m-d') }}"
           class="border rounded p-2" required>
    <button type="submit"
            class="px-4 py-2 bg-green-600 text-white rounded">
        Generar para la fecha
    </button>
</form>

<div class="bg-white shadow rounded p-4">
    <table class="min-w-full border">
        <thead class="bg-gray-100">
            <tr>
                <th class="border px-2 py-1">Empleado</th>
                <th class="border px-2 py-1">Fecha</th>
                <th class="border px-2 py-1">Horas</th>
                <th class="border px-2 py-1">Bruto</th>
                <th class="border px-2 py-1">Salud</th>
                <th class="border px-2 py-1">Pensión</th>
                <th class="border px-2 py-1 font-bold">Neto</th>
            </tr>
        </thead>
        <tbody>
        @forelse($payrolls as $p)
            <tr>
                <td class="border px-2 py-1">{{ $p->employee->name }}</td>
                <td class="border px-2 py-1">{{ $p->fecha }}</td>
                <td class="border px-2 py-1">{{ $p->horas_trabajadas }}</td>
                <td class="border px-2 py-1">${{ number_format($p->bruto_total, 0, ',', '.') }}</td>
                <td class="border px-2 py-1">${{ number_format($p->salud, 0, ',', '.') }}</td>
                <td class="border px-2 py-1">${{ number_format($p->pension, 0, ',', '.') }}</td>
                <td class="border px-2 py-1 font-bold text-green-700">
                    ${{ number_format($p->total_neto, 0, ',', '.') }}
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="7" class="text-center py-2">No hay datos</td>
            </tr>
        @endforelse
        </tbody>
    </table>
    <div class="mt-4">
        {{ $payrolls->links() }}
    </div>
</div>
@endsection
