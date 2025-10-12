<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net" />
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Vite / Assets -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Libraries -->
    <script src="//unpkg.com/alpinejs" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body class="font-sans antialiased bg-gray-100">
    <div class="flex min-h-screen">

        <!-- Sidebar -->
        <aside class="w-64 bg-gray-800 text-white" x-data="{ openEmployees: false, openProjects: false }">
            <div class="p-4 text-lg font-bold border-b border-gray-700">
                Gestión de Proyectos
            </div>

            <nav class="p-4 space-y-1">
                <a href="{{ route('dashboard') }}" class="block px-4 py-2 rounded hover:bg-gray-700">📊 Dashboard</a>

                <!-- Empleados -->
                <button @click="openEmployees = !openEmployees"
                        class="w-full text-left px-4 py-2 rounded hover:bg-gray-700 flex justify-between items-center">
                    👥 Empleados
                    <span x-text="openEmployees ? '▲' : '▼'"></span>
                </button>
                <div x-show="openEmployees" x-cloak class="ml-6 mt-2 space-y-2">
                    <a href="{{ route('employees.index') }}" class="block px-4 py-2 rounded hover:bg-gray-700">📋 Listar</a>
                    <a href="{{ route('employees.create') }}" class="block px-4 py-2 rounded hover:bg-gray-700">➕ Crear</a>
                </div>

                <!-- Proyectos -->
                <button @click="openProjects = !openProjects"
                        class="w-full text-left px-4 py-2 rounded hover:bg-gray-700 flex justify-between items-center">
                    🗂️ Proyectos
                    <span x-text="openProjects ? '▲' : '▼'"></span>
                </button>
                <div x-show="openProjects" x-cloak class="ml-6 mt-2 space-y-2">
                    <a href="{{ route('projects.index') }}" class="block px-4 py-2 rounded hover:bg-gray-700">📋 Listar</a>
                    <a href="{{ route('projects.create') }}" class="block px-4 py-2 rounded hover:bg-gray-700">➕ Crear</a>
                </div>

                <a href="{{ route('worklogs.index') }}" class="block px-4 py-2 rounded hover:bg-gray-700">🕒 WorkLogs</a>
                <a href="{{ route('worklogs.report') }}" class="block px-4 py-2 rounded hover:bg-gray-700">📊 Reportes</a>
                <a href="{{ route('projects.financial') }}" class="block px-4 py-2 rounded hover:bg-gray-700">💰 Balance Financiero</a>
                <a href="{{ route('contracts.index') }}" class="block px-4 py-2 rounded hover:bg-gray-700">📑 Contratos</a>
            </nav>
        </aside>

        <!-- Contenido principal -->
        <main class="flex-1 p-6">
            @isset($header)
                <header class="bg-white shadow mb-6">
                    <div class="max-w-7xl mx-auto py-4 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <!-- Aquí viene el contenido de cada vista -->
            {{ $slot }}
        </main>
    </div>
</body>
</html>
