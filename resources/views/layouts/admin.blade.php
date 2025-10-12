<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Administración - Panel</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100">

    <div class="flex h-screen">

        <!-- Sidebar -->
        <aside class="w-64 bg-gray-900 text-white flex flex-col">
            <div class="px-6 py-4 text-xl font-bold border-b border-gray-700">
                INDUMET
            </div>
            <nav class="flex-1 px-4 py-6 space-y-2">
                <a href="{{ route('dashboard') }}" class="block px-3 py-2 rounded hover:bg-gray-700">🏠 Indumet</a>
                <a href="{{ route('employees.index') }}" class="block px-3 py-2 rounded hover:bg-gray-700">👨‍💼 Empleados</a>
                <a href="{{ route('projects.index') }}" class="block px-3 py-2 rounded hover:bg-gray-700">📁 Proyectos</a>
                <a href="{{ route('contracts.index') }}" class="block px-3 py-2 rounded hover:bg-gray-700">💰 Nómina</a>

            </nav>
            <div class="px-4 py-4 border-t border-gray-700">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full text-left px-3 py-2 rounded bg-red-600 hover:bg-red-700">
                        🚪 Cerrar sesión
                    </button>
                </form>
            </div>
        </aside>

        <!-- Main content -->
        <div class="flex-1 flex flex-col">
            
            <!-- Navbar -->
            <header class="bg-white shadow px-6 py-4 flex justify-between items-center">
                <h1 class="text-2xl font-semibold">Panel de Administración</h1>
                <div class="flex items-center space-x-4">
                    <span class="text-gray-700">👤 {{ Auth::user()->name }}</span>
                    <img src="https://ui-avatars.com/api/?name={{ Auth::user()->name }}" 
                         alt="Avatar" 
                         class="w-8 h-8 rounded-full">
                </div>
            </header>

            <!-- Page Content -->
            <main class="flex-1 p-6 overflow-y-auto">
                @yield('content')
            </main>
        </div>
    </div>

</body>
</html>
