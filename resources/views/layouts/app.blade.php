<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="//unpkg.com/alpinejs" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <!-- Bootstrap JS bundle (opcional) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    {{-- 🔹 ESTILOS en el HEAD, no al final --}}
 @stack('styles')  
</head>
<body class="font-sans antialiased bg-gray-100">
<div class="flex min-h-screen">

    <!-- Sidebar -->
    <nav class="p-4 bg-gray-800 text-white w-64"
         x-data="{ openEmployees:false, openProjects:false, openEvents:false,  openPayroll:false, openAttendence:false }">

        <a href="{{ route('dashboard') }}"
           class="block px-4 py-2 rounded hover:bg-gray-700">📊 Indumet</a>

        <!-- Empleados -->
        <button @click="openEmployees = !openEmployees"
                class="w-full text-left px-4 py-2 mt-4 rounded hover:bg-gray-700 flex justify-between items-center">
            👥 Empleados
            <span x-text="openEmployees ? '▲' : '▼'"></span>
        </button>
        <div x-show="openEmployees" x-transition class="ml-6 mt-2 space-y-2">
            <a href="{{ route('employees.index') }}" class="block px-4 py-2 rounded hover:bg-gray-700">📋 Listar</a>
            <a href="{{ route('employees.create') }}" class="block px-4 py-2 rounded hover:bg-gray-700">➕ Crear</a>
        </div>

        <!-- Proyectos -->
        <button @click="openProjects = !openProjects"
                class="w-full text-left px-4 py-2 mt-4 rounded hover:bg-gray-700 flex justify-between items-center">
            🗂️ Proyectos
            <span x-text="openProjects ? '▲' : '▼'"></span>
        </button>
        <div x-show="openProjects" x-transition class="ml-6 mt-2 space-y-2">
            <a href="{{ route('projects.index') }}" class="block px-4 py-2 rounded hover:bg-gray-700">📋 Listar</a>
            <a href="{{ route('projects.create') }}" class="block px-4 py-2 rounded hover:bg-gray-700">➕ Crear</a>
            <a href="{{ route('worklogs.index') }}" class="block px-4 py-2 rounded hover:bg-gray-700">🕒 WorkLogs</a>
            <a href="{{ route('worklogs.report') }}" class="block px-4 py-2 rounded hover:bg-gray-700">📈 Reportes</a>
            <a href="{{ route('projects.financial') }}" class="block px-4 py-2 rounded hover:bg-gray-700">💰 Balance Financiero</a>
            <a href="{{ route('dashboard.attendance') }}" class="block px-4 py-2 rounded hover:bg-gray-700"> 📊 Asistencia (Jefe) </a>
        </div>

        <!-- Eventos -->
        <button @click="openEvents = !openEvents"
                class="w-full text-left px-4 py-2 mt-4 rounded hover:bg-gray-700 flex justify-between items-center">
            🗂️ Eventos
            <span x-text="openEvents ? '▲' : '▼'"></span>
        </button>
        <div x-show="openEvents" x-transition class="ml-6 mt-2 space-y-2">
            <a href="{{ route('events.index') }}" class="block px-4 py-2 rounded hover:bg-gray-700">Administrar eventos</a>
            <a href="{{ route('events.calendar') }}" class="block px-4 py-2 rounded hover:bg-gray-700">Ver Calendario</a>
        </div>   


        <!-- Nómina -->
        <button @click="openPayroll = !openPayroll"
                class="w-full text-left px-4 py-2 mt-4 rounded hover:bg-gray-700 flex justify-between items-center">
            💵 Nómina
            <span x-text="openPayroll ? '▲' : '▼'"></span>
        </button>
        <div x-show="openPayroll" x-transition class="ml-6 mt-2 space-y-2">
            <a href="{{ route('contracts.index') }}" class="block px-4 py-2 rounded hover:bg-gray-700">📑 Contratos</a>
            <a href="{{ route('payroll.index') }}" class="block px-4 py-2 rounded hover:bg-gray-700">📑 Nómina diaria</a>
        </div>

        <!-- Asistencias -->
        <button @click="openAttendence = !openAttendence"
                class="w-full text-left px-4 py-2 mt-4 rounded hover:bg-gray-700 flex justify-between items-center">
            🕒 Asistencias
            <span x-text="openAttendence ? '▲' : '▼'"></span>
        </button>
            <div x-show="openAttendence" x-transition class="ml-6 mt-2 space-y-2">
                <a href="{{ route('attendances.index') }}" class="block px-4 py-2 rounded hover:bg-gray-700">Asistencia</a>
            </div>

</form>

    </nav>

    <!-- Contenido principal -->
    <main class="flex-1 p-6">
        @yield('content')
        @if(session('success'))
<script>
    Swal.fire({
        icon: 'success',
        title: '¡Éxito!',
        text: '{{ session('success') }}',
        showConfirmButton: false,
        timer: 2000,
        timerProgressBar: true
    });
</script>
@endif

@if($errors->any())
<script>
    Swal.fire({
        icon: 'error',
        title: 'Error al guardar',
        html: '{!! implode("<br>", $errors->all()) !!}',
        confirmButtonText: 'Entendido'
    });
</script>
@endif

    </main>

    {{-- 🔹 SCRIPTS al final del body --}}
    @stack('scripts')

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>
</html>
