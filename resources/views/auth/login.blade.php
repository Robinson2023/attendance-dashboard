<!DOCTYPE html>

<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar sesión</title>
    @vite('resources/css/app.css')
    <style>
        body {
            background-image: url('https://images.unsplash.com/photo-1522202176988-66273c2fd55f?auto=format&fit=crop&w=1400&q=80');
            background-size: cover;
            background-position: center;
            min-height: 100vh;
            position: relative;
        }
        .overlay {
            position: absolute;
            top: 0; left: 0;
            width: 100%; height: 100%;
            background-color: rgba(0, 0, 0, 0.55);
            z-index: 0;
        }
    </style>
</head>
<body class="flex items-center justify-center min-h-screen relative">

```
<div class="overlay"></div>

<div class="z-10 bg-white/95 backdrop-blur-sm rounded-2xl shadow-2xl p-10 w-full max-w-md border border-gray-100">
    <h1 class="text-3xl font-bold text-gray-800 mb-8 text-center">
        Bienvenido a <span class="text-indigo-600">Gestión</span>
    </h1>

    @if (session('status'))
        <div class="mb-4 text-green-600 text-center">{{ session('status') }}</div>
    @endif

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div class="mb-5">
            <label for="email" class="block text-gray-700 font-semibold mb-2">Correo electrónico</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus
                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
            @error('email')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-5">
            <label for="password" class="block text-gray-700 font-semibold mb-2">Contraseña</label>
            <input id="password" type="password" name="password" required
                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
            @error('password')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <div class="flex items-center justify-between mb-5 text-sm">
            <label class="flex items-center text-gray-700">
                <input type="checkbox" name="remember" class="mr-2 accent-indigo-600">
                Recordarme
            </label>
            @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}" class="text-indigo-600 hover:underline">
                    ¿Olvidaste tu contraseña?
                </a>
            @endif
        </div>

        <button type="submit"
            class="w-full bg-indigo-600 text-white py-2.5 rounded-lg hover:bg-indigo-700 transition font-semibold shadow">
            Iniciar sesión
        </button>

        <p class="mt-6 text-center text-gray-700">
            ¿No tienes cuenta?
            <a href="{{ route('register') }}" class="text-indigo-600 font-semibold hover:underline">Regístrate</a>
        </p>
    </form>
</div>
```

</body>
</html>
