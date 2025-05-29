<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Panel de Usuario - VentasPro</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet" />
    <style>
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        @keyframes slideIn {
            from { transform: translateX(-20px); opacity: 0; }
            to { transform: translateX(0); opacity: 1; }
        }
        .animate-fade-in {
            animation: fadeIn 0.5s ease-out;
        }
        .animate-slide-in {
            animation: slideIn 0.5s ease-out;
        }
        .hover-scale {
            transition: transform 0.2s ease-in-out;
        }
        .hover-scale:hover {
            transform: scale(1.02);
        }
    </style>
</head>
<body class="bg-gradient-to-br from-gray-900 via-gray-800 to-gray-900 text-white font-[Poppins] min-h-screen">
    <!-- Navbar -->
    <nav class="bg-white/10 backdrop-blur-lg fixed w-full z-30 shadow-lg border-b border-white/10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16 items-center">
                <a class="flex items-center space-x-2 group" href="{{ route('dashboard') }}">
                    <div class="w-9 h-9 flex items-center justify-center rounded-full bg-gradient-to-r from-[#FF6B3C] to-[#FF8F6B] text-white font-bold text-lg shadow-lg group-hover:shadow-[#FF6B3C]/50 transition-all duration-300">VP</div>
                    <span class="text-white font-semibold text-xl group-hover:text-[#FF6B3C] transition-colors duration-300">VentasPro</span>
                </a>
                <div class="flex items-center space-x-4">
                    <span class="hidden md:inline-block text-sm text-gray-300">
                        {{ Auth::user()->name }}
                    </span>
                    <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                       class="inline-flex items-center bg-gradient-to-r from-[#FF6B3C] to-[#FF8F6B] hover:from-[#FF8F6B] hover:to-[#FF6B3C] text-white text-sm font-semibold rounded-full px-5 py-2 transition-all duration-300 shadow-lg hover:shadow-[#FF6B3C]/50">
                        Salir <i class="fas fa-sign-out-alt ml-2"></i>
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">@csrf</form>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="pt-24 pb-12 px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto">
        <!-- Header Section -->
        <div class="mb-8 animate-fade-in">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                <div>
                    <span class="inline-block bg-gradient-to-r from-[#FF6B3C] to-[#FF8F6B] text-white text-sm font-semibold px-4 py-1 rounded-full shadow-lg">
                        {{ Auth::user()->getRoleNames()->first() ?? 'Usuario' }}
                    </span>
                    <h1 class="text-3xl font-bold mt-2 bg-gradient-to-r from-white to-gray-300 bg-clip-text text-transparent">
                        Bienvenido, {{ Auth::user()->name }}
                    </h1>
                </div>
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                    @if(Auth::user()->hasRole(['admin', 'secre']))
                        <div class="bg-white/5 backdrop-blur-lg rounded-xl p-4 border border-white/10 hover-scale">
                            <div class="text-[#FF6B3C] text-2xl mb-2">
                                <i class="fas fa-users"></i>
                            </div>
                            <div class="text-sm text-gray-400">Usuarios</div>
                            <div class="text-xl font-semibold">{{ $usuarios->count() ?? 0 }}</div>
                        </div>
                    @endif

                    @if(Auth::user()->hasRole('bodega'))
                        <div class="bg-white/5 backdrop-blur-lg rounded-xl p-4 border border-white/10 hover-scale">
                            <div class="text-[#FF6B3C] text-2xl mb-2">
                                <i class="fas fa-box"></i>
                            </div>
                            <div class="text-sm text-gray-400">Productos</div>
                            <div class="text-xl font-semibold">{{ $productos->count() ?? 0 }}</div>
                        </div>
                        <div class="bg-white/5 backdrop-blur-lg rounded-xl p-4 border border-white/10 hover-scale">
                            <div class="text-[#FF6B3C] text-2xl mb-2">
                                <i class="fas fa-tags"></i>
                            </div>
                            <div class="text-sm text-gray-400">Categorías</div>
                            <div class="text-xl font-semibold">{{ $categorias->count() ?? 0 }}</div>
                        </div>
                    @endif

                    @if(Auth::user()->hasRole('cajera'))
                        <div class="bg-white/5 backdrop-blur-lg rounded-xl p-4 border border-white/10 hover-scale">
                            <div class="text-[#FF6B3C] text-2xl mb-2">
                                <i class="fas fa-cash-register"></i>
                            </div>
                            <div class="text-sm text-gray-400">Ventas</div>
                            <div class="text-xl font-semibold">{{ $total_ventas }}</div>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Content Sections -->
        <div class="space-y-8 animate-fade-in">
            <!-- Lista de Usuarios (Admin y Secre) -->
            @if(Auth::user()->hasRole(['admin', 'secre']))
                <div class="bg-white/5 backdrop-blur-lg rounded-xl p-6 border border-white/10 shadow-xl hover-scale">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-xl font-semibold text-white flex items-center">
                            <i class="fas fa-users text-[#FF6B3C] mr-3"></i>
                            Lista de Usuarios
                        </h3>
                        <div class="space-x-2">
                            <a href="{{ route('usuarios.create') }}" class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-[#FF6B3C] to-[#FF8F6B] text-white rounded-lg hover:from-[#FF8F6B] hover:to-[#FF6B3C] transition-all duration-300 shadow-lg hover:shadow-[#FF6B3C]/50">
                                <i class="fas fa-plus mr-2"></i> Crear Usuario
                            </a>
                            @if(Auth::user()->hasRole('admin'))
                                <a href="{{ route('usuarios.asignar') }}" class="inline-flex items-center px-4 py-2 bg-white/10 text-white rounded-lg hover:bg-white/20 transition-all duration-300">
                                    <i class="fas fa-user-tag mr-2"></i> Asignar Rol
                                </a>
                            @endif
                        </div>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="min-w-full">
                            <thead>
                                <tr class="text-left border-b border-white/10">
                                    <th class="pb-3 text-sm font-semibold text-gray-400">Nombre</th>
                                    <th class="pb-3 text-sm font-semibold text-gray-400">Email</th>
                                    <th class="pb-3 text-sm font-semibold text-gray-400">Rol</th>
                                    <th class="pb-3 text-sm font-semibold text-gray-400">Acciones</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-white/10">
                                @foreach($usuarios as $usuario)
                                    <tr>
                                        <td class="py-3">{{ $usuario->name }}</td>
                                        <td class="py-3">{{ $usuario->email }}</td>
                                        <td class="py-3">
                                            <span class="inline-block bg-white/10 text-white text-xs px-2 py-1 rounded-full">
                                                {{ $usuario->roles->first()->name ?? 'Sin rol' }}
                                            </span>
                                        </td>
                                        <td class="py-3">
                                            <div class="flex space-x-2">
                                                @if(Auth::user()->hasRole('admin'))
                                                    <a href="{{ route('usuarios.edit', $usuario) }}" class="inline-flex items-center px-3 py-1.5 bg-blue-500/20 text-blue-400 rounded-md hover:bg-blue-500/30 transition-colors">
                                                        <i class="fas fa-edit mr-2"></i>Editar
                                                    </a>
                                                    <form id="delete-form-{{ $usuario->id }}" action="{{ route('usuarios.destroy', $usuario) }}" method="POST" class="inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="button" onclick="confirmDelete('delete-form-{{ $usuario->id }}', '¿Está seguro que desea eliminar al usuario {{ $usuario->name }}?')" class="inline-flex items-center px-3 py-1.5 bg-red-500/20 text-red-400 rounded-md hover:bg-red-500/30 transition-colors">
                                                            <i class="fas fa-trash mr-2"></i>Eliminar
                                                        </button>
                                                    </form>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @endif

            <!-- Lista de Categorías (Bodega) -->
            @if(Auth::user()->hasRole('bodega'))
                <div class="bg-white/5 backdrop-blur-lg rounded-xl p-6 border border-white/10 shadow-xl hover-scale">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-xl font-semibold text-white flex items-center">
                            <i class="fas fa-tags text-[#FF6B3C] mr-3"></i>
                            Lista de Categorías
                        </h3>
                        <a href="{{ route('categorias.create') }}" class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-[#FF6B3C] to-[#FF8F6B] text-white rounded-lg hover:from-[#FF8F6B] hover:to-[#FF6B3C] transition-all duration-300 shadow-lg hover:shadow-[#FF6B3C]/50">
                            <i class="fas fa-plus mr-2"></i> Crear Categoría
                        </a>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="min-w-full">
                            <thead>
                                <tr class="text-left border-b border-white/10">
                                    <th class="pb-3 text-sm font-semibold text-gray-400">Nombre</th>
                                    <th class="pb-3 text-sm font-semibold text-gray-400">Acciones</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-white/10">
                                @foreach($categorias as $categoria)
                                    <tr>
                                        <td class="py-3">{{ $categoria->nombre }}</td>
                                        <td class="py-3">
                                            <div class="flex space-x-2">
                                                <a href="{{ route('categorias.edit', $categoria) }}" class="inline-flex items-center px-3 py-1.5 bg-blue-500/20 text-blue-400 rounded-md hover:bg-blue-500/30 transition-colors">
                                                    <i class="fas fa-edit mr-2"></i>Editar
                                                </a>
                                                <form id="delete-form-{{ $categoria->id }}" action="{{ route('categorias.destroy', $categoria) }}" method="POST" class="inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button" onclick="confirmDelete('delete-form-{{ $categoria->id }}', '¿Está seguro que desea eliminar la categoría {{ $categoria->nombre }}?')" class="inline-flex items-center px-3 py-1.5 bg-red-500/20 text-red-400 rounded-md hover:bg-red-500/30 transition-colors">
                                                        <i class="fas fa-trash mr-2"></i>Eliminar
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @endif

            <!-- Lista de Productos (Bodega) -->
            @if(Auth::user()->hasRole('bodega'))
                <div class="bg-white/5 backdrop-blur-lg rounded-xl p-6 border border-white/10 shadow-xl hover-scale">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-xl font-semibold text-white flex items-center">
                            <i class="fas fa-box text-[#FF6B3C] mr-3"></i>
                            Lista de Productos
                        </h3>
                        <a href="{{ route('productos.create') }}" class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-[#FF6B3C] to-[#FF8F6B] text-white rounded-lg hover:from-[#FF8F6B] hover:to-[#FF6B3C] transition-all duration-300 shadow-lg hover:shadow-[#FF6B3C]/50">
                            <i class="fas fa-plus mr-2"></i> Crear Producto
                        </a>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="min-w-full">
                            <thead>
                                <tr class="text-left border-b border-white/10">
                                    <th class="pb-3 text-sm font-semibold text-gray-400">Nombre</th>
                                    <th class="pb-3 text-sm font-semibold text-gray-400">Categoría</th>
                                    <th class="pb-3 text-sm font-semibold text-gray-400">Precio</th>
                                    <th class="pb-3 text-sm font-semibold text-gray-400">Stock</th>
                                    <th class="pb-3 text-sm font-semibold text-gray-400">Acciones</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-white/10">
                                @foreach($productos as $producto)
                                    <tr>
                                        <td class="py-3">{{ $producto->nombre }}</td>
                                        <td class="py-3">{{ $producto->categoria->nombre }}</td>
                                        <td class="py-3">${{ number_format($producto->precio, 2) }}</td>
                                        <td class="py-3">{{ $producto->stock }}</td>
                                        <td class="py-3">
                                            <div class="flex space-x-2">
                                                <a href="{{ route('productos.edit', $producto) }}" class="inline-flex items-center px-3 py-1.5 bg-blue-500/20 text-blue-400 rounded-md hover:bg-blue-500/30 transition-colors">
                                                    <i class="fas fa-edit mr-2"></i>Editar
                                                </a>
                                                <form id="delete-form-{{ $producto->id }}" action="{{ route('productos.destroy', $producto) }}" method="POST" class="inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button" onclick="confirmDelete('delete-form-{{ $producto->id }}', '¿Está seguro que desea eliminar el producto {{ $producto->nombre }}?')" class="inline-flex items-center px-3 py-1.5 bg-red-500/20 text-red-400 rounded-md hover:bg-red-500/30 transition-colors">
                                                        <i class="fas fa-trash mr-2"></i>Eliminar
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @endif

            <!-- Lista de Ventas (Cajera) -->
            @if(Auth::user()->hasRole('cajera'))
                <div class="bg-white/5 backdrop-blur-lg rounded-xl p-6 border border-white/10 shadow-xl hover-scale">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-xl font-semibold text-white flex items-center">
                            <i class="fas fa-cash-register text-[#FF6B3C] mr-3"></i>
                            Mis Ventas
                        </h3>
                        <a href="{{ route('ventas.create') }}" class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-[#FF6B3C] to-[#FF8F6B] text-white rounded-lg hover:from-[#FF8F6B] hover:to-[#FF6B3C] transition-all duration-300 shadow-lg hover:shadow-[#FF6B3C]/50">
                            <i class="fas fa-plus mr-2"></i> Nueva Venta
                        </a>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="min-w-full">
                            <thead>
                                <tr class="text-left border-b border-white/10">
                                    <th class="pb-3 text-sm font-semibold text-gray-400">ID</th>
                                    <th class="pb-3 text-sm font-semibold text-gray-400">Fecha</th>
                                    <th class="pb-3 text-sm font-semibold text-gray-400">Total</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-white/10">
                                @foreach($ventas as $venta)
                                    <tr>
                                        <td class="py-3">#{{ $venta->id }}</td>
                                        <td class="py-3">{{ $venta->created_at->format('d/m/Y H:i') }}</td>
                                        <td class="py-3">${{ number_format($venta->total, 2) }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @endif
        </div>
    </main>

    <script>
        // Función para mostrar el modal de confirmación
        function confirmDelete(formId, message) {
            if (confirm(message || '¿Está seguro que desea eliminar este registro?')) {
                document.getElementById(formId).submit();
            }
        }
    </script>
</body>
</html>