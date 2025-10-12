@extends('layouts.admin')

@section('content')
    <h1 class="text-3xl font-bold mb-6">📊 Panel de Control</h1>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <!-- Tarjeta empleados -->
        <div class="bg-white shadow rounded p-4">
            <h2 class="text-lg font-semibold mb-2">👨‍💼 Empleados</h2>
            <p class="text-gray-600">Gestiona la información de los empleados.</p>
            <a href="{{ route('employees.index') }}" class="mt-3 inline-block px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                Ver empleados
            </a>
        </div>

        <!-- Tarjeta proyectos -->
        <div class="bg-white shadow rounded p-4">
            <h2 class="text-lg font-semibold mb-2">📁 Proyectos</h2>
            <p class="text-gray-600">Administra los proyectos en curso.</p>
            <a href="{{ route('projects.index') }}" class="mt-3 inline-block px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700">
                Ver Proyectos
            </a>
        </div>

        <!-- Tarjeta nómina -->
        <div class="bg-white shadow rounded p-4">
            <h2 class="text-lg font-semibold mb-2">💰 Nómina</h2>
            <p class="text-gray-600">Consulta y administra la nómina.</p>
            <a href="{{ route('contracts.index') }}" class="mt-3 inline-block px-4 py-2 bg-yellow-600 text-white rounded hover:bg-yellow-700">
                Ver nómina
            </a>
        </div>

        <div class="max-w-5xl mx-auto bg-white shadow rounded p-6 text-center">

            <h1 class="text-3xl font-bold mb-6">👋 Bienvenido al Panel de Control</h1>
            <p class="text-gray-600 mb-8">Desde aquí puedes registrar tu asistencia o consultar tus registros.</p>

            <div class="flex flex-col md:flex-row justify-center gap-6">
                <a href="{{ route('attendances.create') }}" 
                class="bg-green-600 text-white text-xl px-8 py-4 rounded-lg shadow hover:bg-green-700 transition">
                    🕒 Registrar Asistencia
                </a>

                <a href="{{ route('attendances.index') }}" 
                class="bg-blue-600 text-white text-xl px-8 py-4 rounded-lg shadow hover:bg-blue-700 transition">
                    📋 Ver Asistencias
                </a>
            </div>
        </div>

        <div class="bg-white shadow rounded p-6">
            <h2 class="text-xl font-semibold mb-4 text-pink-600">🎂 Cumpleaños próximos</h2>

            @if($upcoming->isEmpty())
                <p class="text-gray-500">No hay cumpleaños cercanos.</p>
            @else
                <ul class="divide-y divide-gray-200">
                    @foreach($upcoming as $emp)
                        <li class="py-2 flex items-center justify-between">
                            <span>👤 {{ $emp->first_name }} {{ $emp->last_name }}</span>
                            <span class="text-sm text-gray-500">
                                {{ \Carbon\Carbon::parse($emp->birth_date)->format('d/m') }}
                            </span>
                        </li>
                    @endforeach
                </ul>
            @endif
        </div>

    </div>
@endsection

