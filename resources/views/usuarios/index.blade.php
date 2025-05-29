<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Usuarios - VentasPro</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet" />
    <style>
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .animate-fade-in {
            animation: fadeIn 0.5s ease-out;
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
        <div class="bg-white/5 backdrop-blur-lg rounded-xl p-6 border border-white/10 shadow-xl hover-scale animate-fade-in">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-2xl font-bold text-white flex items-center">
                    <i class="fas fa-users text-[#FF6B3C] mr-3"></i>
                    Gestión de Usuarios
                </h2>
                <a href="{{ route('usuarios.create') }}" class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-[#FF6B3C] to-[#FF8F6B] text-white rounded-lg hover:from-[#FF8F6B] hover:to-[#FF6B3C] transition-all duration-300 shadow-lg hover:shadow-[#FF6B3C]/50">
                    <i class="fas fa-plus mr-2"></i> Nuevo Usuario
                </a>
            </div>

            @if(session('success'))
                <div class="mb-6 p-4 bg-green-500/20 border border-green-500/50 rounded-lg text-green-400">
                    {{ session('success') }}
                </div>
            @endif

            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="text-left border-b border-white/10">
                            <th class="pb-3 font-semibold text-gray-300">Nombre</th>
                            <th class="pb-3 font-semibold text-gray-300">Email</th>
                            <th class="pb-3 font-semibold text-gray-300">Rol</th>
                            <th class="pb-3 font-semibold text-gray-300 text-right">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-white/10">
                        @foreach($usuarios as $usuario)
                            <tr class="hover:bg-white/5 transition-colors duration-200">
                                <td class="py-4">{{ $usuario->name }}</td>
                                <td class="py-4">{{ $usuario->email }}</td>
                                <td class="py-4">
                                    <span class="px-3 py-1 text-sm rounded-full bg-white/10">
                                        {{ ucfirst($usuario->roles->first()->name ?? 'Sin rol') }}
                                    </span>
                                </td>
                                <td class="py-4 text-right space-x-2">
                                    <a href="{{ route('usuarios.edit', $usuario) }}" 
                                       class="inline-flex items-center px-3 py-1 bg-blue-500/20 text-blue-400 rounded-lg hover:bg-blue-500/30 transition-all duration-300">
                                        <i class="fas fa-edit mr-1"></i> Editar
                                    </a>
                                    <button onclick="openModal('delete-user-{{ $usuario->id }}-modal')"
                                            class="inline-flex items-center px-3 py-1 bg-red-500/20 text-red-400 rounded-lg hover:bg-red-500/30 transition-all duration-300">
                                        <i class="fas fa-trash-alt mr-1"></i> Eliminar
                                    </button>
                                </td>
                            </tr>

                            <!-- Modal de Confirmación -->
                            <x-confirm-modal 
                                id="delete-user-{{ $usuario->id }}-modal"
                                title="Eliminar Usuario"
                                message="¿Está seguro que desea eliminar al usuario {{ $usuario->name }}? Esta acción no se puede deshacer."
                            >
                                <form action="{{ route('usuarios.destroy', $usuario) }}" method="POST" class="hidden">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            </x-confirm-modal>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </main>
</body>
</html>
