<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel principal - Gestión</title>
    @vite('resources/css/app.css')
    <style>
        /* Fondo animado más sutil */
        body {
            background-image: url('https://images.unsplash.com/photo-1581092580497-e0d23cbdf1dc?auto=format&fit=crop&w=1920&q=80');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            animation: moveBackground 60s ease-in-out infinite alternate;
            color: white;
        }

        @keyframes moveBackground {
            0% {
                background-position: center;
                filter: brightness(0.8);
            }
            50% {
                background-position: center 10%;
                filter: brightness(0.9);
            }
            100% {
                background-position: center 20%;
                filter: brightness(0.8);
            }
        }

        .panel {
            background-color: rgba(0, 0, 0, 0.6);
            backdrop-filter: blur(12px);
        }

        .menu-btn {
            @apply bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded-lg transition duration-200;
        }

        .menu-btn.secondary {
            @apply bg-gray-700 hover:bg-gray-800;
        }
    </style>
</head>

<body class="min-h-screen flex flex-col">

    <!-- Encabezado -->
    <header class="panel p-6 flex justify-between items-center shadow-lg">
        <h1 class="text-2xl font-bold tracking-wide">
            Bienvenido a <span class="text-blue-400">Gestión</span>
        </h1>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="menu-btn secondary">Cerrar sesión</button>
        </form>
    </header>

    <!-- Contenido principal -->
    <main class="flex-grow flex flex-col items-center justify-center text-center p-8">

        <div class="panel p-10 rounded-2xl shadow-2xl max-w-2xl w-full">
            <h2 class="text-3xl font-bold mb-8">Panel de Control</h2>

            <p class="mb-8 text-gray-300">Selecciona una opción para continuar:</p>

            <div class="flex flex-wrap justify-center gap-4">
                <a href="{{ route('clientes.index') }}" class="menu-btn">Gestión de Clientes</a>
                <a href="{{ route('reportes.index') }}" class="menu-btn">Reportes</a>
            </div>
        </div>
    </main>

    <!-- Pie de página -->
    <footer class="text-center py-4 text-gray-400 text-sm">
        &copy; {{ date('Y') }} Gestión Industrial · Todos los derechos reservados.
    </footer>

</body>
</html>
