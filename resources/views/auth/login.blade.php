<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar sesión - Gestión</title>
    @vite('resources/css/app.css')
    <style>
        /* Fondo animado */
        body {
            background-image: url('https://images.unsplash.com/photo-1581092580497-e0d23cbdf1dc?auto=format&fit=crop&w=1920&q=80');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            animation: moveBackground 30s ease-in-out infinite alternate;
        }

        @keyframes moveBackground {
            0% {
                background-position: center;
                filter: brightness(0.8);
            }
            50% {
                background-position: center 20%;
                filter: brightness(0.9);
            }
            100% {
                background-position: center 40%;
                filter: brightness(0.8);
            }
        }

        .card {
            background-color: rgba(0, 0, 0, 0.7);
            backdrop-filter: blur(10px);
        }
    </style>
</head>

<body class="h-screen flex items-center justify-center text-white">

    <div class="card p-8 rounded-2xl shadow-2xl w-full max-w-md transition-transform duration-500 hover:scale-[1.02]">
        <h1 class="text-3xl font-bold text-center mb-6">
            Bienvenido a <span class="text-blue-400">Gestión</span>
        </h1>

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Correo -->
            <div class="mb-4">
                <label for="email" class="block text-sm font-medium mb-2">Correo electrónico</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus
                    class="w-full px-4 py-2 rounded-lg bg-gray-800 text-white border border-gray-700 focus:ring-2 focus:ring-blue-500 outline-none">
                @error('email')
                    <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Contraseña -->
            <div class="mb-4">
                <label for="password" class="block text-sm font-medium mb-2">Contraseña</label>
                <input id="password" type="password" name="password" required
                    class="w-full px-4 py-2 rounded-lg bg-gray-800 text-white border border-gray-700 focus:ring-2 focus:ring-blue-500 outline-none">
                @error('password')
                    <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Recordarme -->
            <div class="flex items-center justify-between mb-6">
                <label class="flex items-center space-x-2">
                    <input type="checkbox" name="remember" class="text-blue-500 focus:ring-blue-500">
                    <span class="text-sm text-gray-300">Recordarme</span>
                </label>

                @if (Route::has('password.request'))
                    <a class="text-sm text-blue-400 hover:text-blue-300" href="{{ route('password.request') }}">
                        ¿Olvidaste tu contraseña?
                    </a>
                @endif
            </div>

            <!-- Botón -->
            <button type="submit" 
                class="w-full bg-blue-600 hover:bg-blue-700 font-semibold py-2 rounded-lg transition duration-200">
                Iniciar sesión
            </button>
        </form>

        <p class="mt-6 text-center text-sm text-gray-300">
            ¿No tienes cuenta?
            <a href="{{ route('register') }}" class="text-blue-400 hover:text-blue-300 font-semibold">Regístrate</a>
        </p>
    </div>

</body>
</html>
