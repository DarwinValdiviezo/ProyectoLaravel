<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - BarEspe VentasPro</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }
    </style>
</head>
<body class="bg-[#0a0a1a] text-white min-h-screen">
    <!-- Navbar -->
    <nav class="bg-white bg-opacity-90 backdrop-blur-sm fixed w-full z-30 shadow-md">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16 items-center">
                <a class="flex items-center space-x-1" href="#">
                    <div class="flex justify-center items-center w-9 h-9 rounded-full bg-[#FF6B3C] text-white font-bold text-lg">
                        VP
                    </div>
                    <span class="text-[#FF6B3C] font-semibold text-xl select-none">
                        VentasPro
                    </span>
                </a>
                <ul class="hidden md:flex space-x-8 font-semibold text-sm text-black">
                    @if(Auth::user()->hasRole('admin'))
                        <li><a href="{{ route('usuarios.index') }}" class="hover:text-[#FF6B3C] transition">Usuarios</a></li>
                        <li><a href="{{ route('usuarios.asignar') }}" class="hover:text-[#FF6B3C] transition">Asignar roles</a></li>
                    @endif
                    @if(Auth::user()->hasRole('bodega'))
                        <li><a href="{{ route('categorias.index') }}" class="hover:text-[#FF6B3C] transition">Categorías</a></li>
                        <li><a href="{{ route('productos.index') }}" class="hover:text-[#FF6B3C] transition">Productos</a></li>
                    @endif
                    @if(Auth::user()->hasRole('cajera'))
                        <li><a href="{{ route('ventas.index') }}" class="hover:text-[#FF6B3C] transition">Ventas</a></li>
                        <li><a href="{{ route('ventas.create') }}" class="hover:text-[#FF6B3C] transition">Nueva venta</a></li>
                    @endif
                </ul>
                <a class="hidden md:inline-flex items-center bg-[#FF6B3C] hover:bg-[#ff7a56] text-white text-sm font-semibold rounded-full px-5 py-2 transition duration-300" href="{{ route('logout') }}"
                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    Salir
                    <i class="fas fa-sign-out-alt ml-2"></i>
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                    @csrf
                </form>
            </div>
        </div>
    </nav>

    <!-- Hero/Header -->
    <header class="pt-28 pb-16 text-center bg-[url('https://storage.googleapis.com/a1aa/image/27c30d24-500c-4751-9749-6ad87db0a8fa.jpg')] bg-no-repeat bg-center bg-cover relative">
        <div class="bg-[#050615]/90 py-12">
            <h1 class="text-white font-semibold text-4xl">Bienvenido, {{ Auth::user()->name }}</h1>
            <p class="text-sm text-white/70 mt-2">Panel principal de control según tu rol asignado</p>
        </div>
    </header>

    <!-- Dashboard content cards -->
    <main class="px-6 max-w-7xl mx-auto py-10">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @if(Auth::user()->hasRole('admin'))
                <a href="{{ route('usuarios.index') }}" class="bg-[#FF6B3C] p-6 rounded-xl shadow-md hover:bg-[#ff7a56] transform hover:-translate-y-1 transition-all">
                    <h2 class="text-lg font-bold">Usuarios</h2>
                    <p class="text-sm mt-2">Gestionar todos los usuarios registrados.</p>
                </a>
                <a href="{{ route('usuarios.asignar') }}" class="bg-[#FF6B3C] p-6 rounded-xl shadow-md hover:bg-[#ff7a56] transform hover:-translate-y-1 transition-all">
                    <h2 class="text-lg font-bold">Asignar roles</h2>
                    <p class="text-sm mt-2">Asignar o modificar los roles de los usuarios.</p>
                </a>
            @endif
            @if(Auth::user()->hasRole('bodega'))
                <a href="{{ route('categorias.index') }}" class="bg-[#FFD580] p-6 rounded-xl text-black shadow-md hover:bg-[#fcd275] transform hover:-translate-y-1 transition-all">
                    <h2 class="text-lg font-bold">Categorías</h2>
                    <p class="text-sm mt-2">Crear y ver categorías de productos.</p>
                </a>
                <a href="{{ route('productos.index') }}" class="bg-[#FFD580] p-6 rounded-xl text-black shadow-md hover:bg-[#fcd275] transform hover:-translate-y-1 transition-all">
                    <h2 class="text-lg font-bold">Productos</h2>
                    <p class="text-sm mt-2">Gestionar productos y su inventario.</p>
                </a>
            @endif
            @if(Auth::user()->hasRole('cajera'))
                <a href="{{ route('ventas.index') }}" class="bg-[#1dbd9d] p-6 rounded-xl shadow-md hover:bg-[#18a88b] transform hover:-translate-y-1 transition-all">
                    <h2 class="text-lg font-bold">Mis Ventas</h2>
                    <p class="text-sm mt-2">Ver el historial de tus ventas.</p>
                </a>
                <a href="{{ route('ventas.create') }}" class="bg-[#1dbd9d] p-6 rounded-xl shadow-md hover:bg-[#18a88b] transform hover:-translate-y-1 transition-all">
                    <h2 class="text-lg font-bold">Registrar venta</h2>
                    <p class="text-sm mt-2">Ingresar una nueva venta con productos.</p>
                </a>
            @endif
        </div>
    </main>
</body>
</html>
