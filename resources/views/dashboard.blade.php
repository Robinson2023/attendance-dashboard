@extends('layouts.app')

@section('content')

<style>
    body {
        background: url('{{ asset('public/storage/empleados/UW75NTEypH9EcPpJJ6aawVGHlFOPVUiPsy5Ydt9P.png') }}') no-repeat center center fixed;
        background-size: cover;
        background-attachment: fixed;
    }

    /* Efecto de sombreado y contraste para el contenido */
    .dashboard-container {
        background-color: rgba(255, 255, 255, 0.9);
        border-radius: 12px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.1);
        padding: 2rem;
    }
</style>

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
    </div>

<br>
     {{-- === Tarjeta del próximo evento === --}}
    <div class="bg-gradient-to-r from-blue-600 to-indigo-600 text-white rounded-xl shadow-lg p-6">
        <h2 class="text-xl font-semibold mb-2">📅 Próximo evento</h2>
        @if($nextEvent)
            <div class="flex justify-between items-center">
                <div>
                    <p class="text-2xl font-bold">{{ $nextEvent->title }}</p>
                    <p class="text-sm text-blue-100">{{ $nextEvent->type ?? 'Evento' }}</p>
                    @if($nextEvent->description)
                        <p class="mt-2 text-blue-50">{{ $nextEvent->description }}</p>
                    @endif
                </div>
                <div class="text-right">
                    <p class="text-lg font-semibold">
                        {{ \Carbon\Carbon::parse($nextEvent->event_date)->translatedFormat('d F Y') }}
                    </p>
                </div>
            </div>
        @else
            <p class="text-blue-100">No hay eventos programados próximamente.</p>
        @endif
    </div>
<br>
    {{-- === Secciones principales === --}}
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

        {{-- 🎂 Cumpleaños próximos --}}
        <div class="bg-white shadow-md rounded-lg p-6">
            <h2 class="text-xl font-semibold text-pink-600 mb-4">🎂 Cumpleaños próximos</h2>

            @if(isset($upcoming) && $upcoming->isNotEmpty())
                <ul class="divide-y divide-gray-200">
                    @foreach($upcoming as $emp)
                        <li class="py-3 flex justify-between items-center">
                            <div class="flex items-center gap-3">
                                @if(!empty($emp->photo))
                                    <img src="{{ asset('storage/'.$emp->photo) }}" class="w-10 h-10 rounded-full object-cover">
                                @else
                                    <div class="w-10 h-10 rounded-full bg-gray-200 flex items-center justify-center text-sm">👤</div>
                                @endif
                                <div>
                                    <p class="font-medium">{{ $emp->first_name }} {{ $emp->last_name }}</p>
                                    <p class="text-xs text-gray-500">{{ $emp->position ?? '—' }}</p>
                                </div>
                            </div>
                            <p class="text-sm text-gray-500">
                                🎈 {{ \Carbon\Carbon::parse($emp->birth_date)->format('d/m') }}
                            </p>
                        </li>
                    @endforeach
                </ul>
            @else
                <p class="text-gray-500">No hay cumpleaños cercanos.</p>
            @endif
        </div>

        {{-- 🗓️ Eventos del día --}}
        <div class="bg-white shadow-md rounded-lg p-6">
            <h2 class="text-xl font-semibold text-green-600 mb-4">🗓️ Eventos del día</h2>

            @if(isset($todayEvents) && $todayEvents->isNotEmpty())
                <ul class="divide-y divide-gray-200">
                    @foreach($todayEvents as $event)
                        <li class="py-3">
                            <div class="font-medium text-gray-800">{{ $event->title }}</div>
                            <div class="text-sm text-gray-500">
                                {{ $event->type ?? 'Evento' }} — 
                                {{ \Carbon\Carbon::parse($event->event_date)->format('d/m/Y') }}
                            </div>
                            @if($event->description)
                                <p class="text-sm text-gray-600 mt-1">{{ $event->description }}</p>
                            @endif
                        </li>
                    @endforeach
                </ul>
            @else
                <p class="text-gray-500">No hay eventos programados para hoy.</p>
            @endif
        </div>


</div>
@endsection
