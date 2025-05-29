<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Panel de Usuario - VentasPro</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('css/dashboard-user.css') }}">
</head>
<body class="bg-[#050615] text-white font-[Poppins]">

<!-- Navbar -->
<nav class="bg-white bg-opacity-90 backdrop-blur-sm fixed w-full z-30 shadow-md">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16 items-center">
            <a class="flex items-center space-x-2" href="{{ route('dashboard') }}">
                <div class="w-9 h-9 flex items-center justify-center rounded-full bg-[#FF6B3C] text-white font-bold text-lg">VP</div>
                <span class="text-[#FF6B3C] font-semibold text-xl">VentasPro</span>
            </a>
            <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
               class="hidden md:inline-flex items-center bg-[#FF6B3C] hover:bg-[#ff7a56] text-white text-sm font-semibold rounded-full px-5 py-2 transition-all duration-200">
                Salir <i class="fas fa-sign-out-alt ml-2"></i>
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">@csrf</form>
        </div>
    </div>
</nav>

<!-- Hero Section -->
<header class="">
    <div class="bg-[#050615]/80 py-12">
    </div>
</header>

<!-- Main Content -->
<main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 flex flex-col md:flex-row items-center md:items-start gap-10 md:gap-20 animate-fade-in">

    <!-- Imagen Usuario -->
    <div class="relative w-56 h-56 sm:w-64 sm:h-64">
        <img src="https://img.freepik.com/vector-premium/circulo-gris-redondo-simple-silueta-humana-sombra-gris-claro-alrededor-circulo_213497-4963.jpg"
             alt="Usuario" class="rounded-full border-4 border-[#FF6B3C] object-cover w-full h-full shadow-lg transition-transform duration-300 hover:scale-105">
        <div class="absolute -top-6 -left-6 w-14 h-14 rounded-full bg-[#FF6B3C] animate-bounce"></div>
        <div class="absolute -bottom-4 -right-4 w-10 h-10 rounded-full bg-[#FFCB7A] animate-pulse"></div>
    </div>

    <!-- Panel de Usuario -->
    <section class="flex-1 max-w-2xl space-y-6">
        <!-- Badge de rol -->
        <span class="inline-block border border-[#FF6B3C] rounded-full px-3 py-1 text-xs text-[#FF6B3C] font-semibold select-none">
            {{ Auth::user()->getRoleNames()->first() ?? 'Usuario' }}
        </span>

        <h2 class="text-2xl sm:text-3xl font-semibold text-white">Bienvenido, {{ Auth::user()->name }}</h2>
        <p class="text-white/70 text-sm leading-relaxed">
            Este es tu panel de control en el sistema de ventas.
        </p>

        <div class="bg-[#0B0D1B] rounded-lg p-6 grid grid-cols-1 sm:grid-cols-2 gap-y-4 gap-x-8 text-sm text-white/70 shadow-md">
            <div class="space-y-1">
                <p><span class="text-[#FF6B3C] font-semibold">Nombre:</span><br>{{ Auth::user()->name }}</p>
                <p><span class="text-[#FF6B3C] font-semibold">Email:</span><br>{{ Auth::user()->email }}</p>
            </div>
            <div class="space-y-1">
                <p><span class="text-[#FF6B3C] font-semibold">Rol:</span><br>{{ Auth::user()->getRoleNames()->first() }}</p>
                <p><span class="text-[#FF6B3C] font-semibold">Acceso:</span><br>Sistema de Ventas</p>
            </div>
        </div>

        <!-- Listas según rol -->
        <div class="space-y-8">
            <!-- Lista de Usuarios (Admin y Secre) -->
            @if(Auth::user()->hasRole(['admin', 'secre']))
                <div class="bg-[#0B0D1B] rounded-lg p-6 shadow-md">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-xl font-semibold text-[#FF6B3C]">Lista de Usuarios</h3>
                        <div class="space-x-2">
                            <a href="{{ route('usuarios.create') }}" class="inline-flex items-center px-4 py-2 bg-[#FF6B3C] text-white rounded-lg hover:bg-[#ff7a56] transition">
                                <i class="fas fa-plus mr-2"></i> Crear Usuario
                            </a>
                            @if(Auth::user()->hasRole('admin'))
                                <a href="{{ route('usuarios.asignar') }}" class="inline-flex items-center px-4 py-2 bg-[#0B0D1B] border border-[#FF6B3C] text-[#FF6B3C] rounded-lg hover:bg-[#FF6B3C] hover:text-white transition">
                                    <i class="fas fa-user-tag mr-2"></i> Asignar Rol
                                </a>
                            @endif
                        </div>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="min-w-full text-sm">
                            <thead>
                                <tr class="text-left border-b border-gray-700">
                                    <th class="pb-2">Nombre</th>
                                    <th class="pb-2">Email</th>
                                    <th class="pb-2">Rol</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($usuarios as $usuario)
                                    <tr class="border-b border-gray-700">
                                        <td class="py-2">{{ $usuario->name }}</td>
                                        <td class="py-2">{{ $usuario->email }}</td>
                                        <td class="py-2">{{ $usuario->roles->first()->name ?? 'Sin rol' }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @endif

            <!-- Lista de Categorías (Bodega) -->
            @if(Auth::user()->hasRole('bodega'))
                <div class="bg-[#0B0D1B] rounded-lg p-6 shadow-md">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-xl font-semibold text-[#FF6B3C]">Lista de Categorías</h3>
                        <a href="{{ route('categorias.create') }}" class="inline-flex items-center px-4 py-2 bg-[#FF6B3C] text-white rounded-lg hover:bg-[#ff7a56] transition">
                            <i class="fas fa-plus mr-2"></i> Crear Categoría
                        </a>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="min-w-full text-sm">
                            <thead>
                                <tr class="text-left border-b border-gray-700">
                                    <th class="pb-2">Nombre</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($categorias as $categoria)
                                    <tr class="border-b border-gray-700">
                                        <td class="py-2">{{ $categoria->nombre }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Lista de Productos (Bodega) -->
                <div class="bg-[#0B0D1B] rounded-lg p-6 shadow-md">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-xl font-semibold text-[#FF6B3C]">Lista de Productos</h3>
                        <a href="{{ route('productos.create') }}" class="inline-flex items-center px-4 py-2 bg-[#FF6B3C] text-white rounded-lg hover:bg-[#ff7a56] transition">
                            <i class="fas fa-plus mr-2"></i> Crear Producto
                        </a>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="min-w-full text-sm">
                            <thead>
                                <tr class="text-left border-b border-gray-700">
                                    <th class="pb-2">Nombre</th>
                                    <th class="pb-2">Precio</th>
                                    <th class="pb-2">Stock</th>
                                    <th class="pb-2">Categoría</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($productos as $producto)
                                    <tr class="border-b border-gray-700">
                                        <td class="py-2">{{ $producto->nombre }}</td>
                                        <td class="py-2">${{ number_format($producto->precio, 2) }}</td>
                                        <td class="py-2">{{ $producto->stock }}</td>
                                        <td class="py-2">{{ $producto->categoria->nombre }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @endif

            <!-- Lista de Ventas (Cajera) -->
            @if(Auth::user()->hasRole('cajera'))
                <div class="bg-[#0B0D1B] rounded-lg p-6 shadow-md">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-xl font-semibold text-[#FF6B3C]">Mis Ventas</h3>
                        <a href="{{ route('ventas.create') }}" class="inline-flex items-center px-4 py-2 bg-[#FF6B3C] text-white rounded-lg hover:bg-[#ff7a56] transition">
                            <i class="fas fa-plus mr-2"></i> Nueva Venta
                        </a>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="min-w-full text-sm">
                            <thead>
                                <tr class="text-left border-b border-gray-700">
                                    <th class="pb-2">ID</th>
                                    <th class="pb-2">Fecha</th>
                                    <th class="pb-2">Productos</th>
                                    <th class="pb-2">Cantidad</th>
                                    <th class="pb-2">Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($ventas as $venta)
                                    <tr class="border-b border-gray-700">
                                        <td class="py-2">{{ $venta->id }}</td>
                                        <td class="py-2">{{ $venta->created_at->format('d/m/Y H:i') }}</td>
                                        <td class="py-2">
                                            @foreach($venta->detalles as $detalle)
                                                {{ $detalle->producto->nombre }}<br>
                                            @endforeach
                                        </td>
                                        <td class="py-2">
                                            @foreach($venta->detalles as $detalle)
                                                {{ $detalle->cantidad }}<br>
                                            @endforeach
                                        </td>
                                        <td class="py-2">
                                            ${{ number_format($venta->detalles->sum(function($detalle) {
                                                return $detalle->producto->precio * $detalle->cantidad;
                                            }), 2) }}
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="py-4 text-center text-gray-500">
                                            No has realizado ninguna venta aún
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            @endif
        </div>
    </section>
</main>

</body>
</html>