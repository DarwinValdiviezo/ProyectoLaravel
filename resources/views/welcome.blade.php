<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>VentasPro - Sistema de Gestión de Ventas</title>
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
        .gradient-text {
            background: linear-gradient(45deg, #FF6B3C, #FF8F6B);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
    </style>
</head>
<body class="bg-gradient-to-br from-gray-900 via-gray-800 to-gray-900 text-white font-[Poppins] min-h-screen">
    <!-- Navbar -->
    <nav class="bg-white/5 backdrop-blur-lg border-b border-white/10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <div class="flex-shrink-0 flex items-center">
                        <div class="w-10 h-10 flex items-center justify-center rounded-full bg-gradient-to-r from-[#FF6B3C] to-[#FF8F6B] text-white font-bold text-xl">
                            VP
                        </div>
                        <span class="ml-2 text-xl font-bold gradient-text">VentasPro</span>
                    </div>
                </div>
                <div class="flex items-center space-x-4">
                    @if (Route::has('login'))
                        @auth
                            <a href="{{ url('/dashboard') }}" class="text-gray-300 hover:text-white transition-colors">
                                Dashboard
                            </a>
                        @else
                            <a href="{{ route('login') }}" class="text-gray-300 hover:text-white transition-colors">
                                Iniciar Sesión
                            </a>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="bg-gradient-to-r from-[#FF6B3C] to-[#FF8F6B] text-white px-4 py-2 rounded-lg hover:from-[#FF8F6B] hover:to-[#FF6B3C] transition-all duration-300">
                                    Registrarse
                                </a>
                            @endif
                        @endauth
                    @endif
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <div class="relative overflow-hidden">
        <div class="max-w-7xl mx-auto">
            <div class="relative z-10 pb-8 sm:pb-16 md:pb-20 lg:max-w-2xl lg:w-full lg:pb-28 xl:pb-32">
                <main class="mt-10 mx-auto max-w-7xl px-4 sm:mt-12 sm:px-6 md:mt-16 lg:mt-20 lg:px-8 xl:mt-28">
                    <div class="sm:text-center lg:text-left">
                        <h1 class="text-4xl tracking-tight font-extrabold text-white sm:text-5xl md:text-6xl">
                            <span class="block">Sistema de Gestión</span>
                            <span class="block gradient-text">VentasPro</span>
                        </h1>
                        <p class="mt-3 text-base text-gray-300 sm:mt-5 sm:text-lg sm:max-w-xl sm:mx-auto md:mt-5 md:text-xl lg:mx-0">
                            Gestiona tus ventas de manera eficiente y profesional. Control de inventario, seguimiento de ventas y gestión de usuarios en una sola plataforma.
                        </p>
                        <div class="mt-5 sm:mt-8 sm:flex sm:justify-center lg:justify-start">
                            <div class="rounded-md shadow">
                                <a href="{{ route('login') }}" class="w-full flex items-center justify-center px-8 py-3 border border-transparent text-base font-medium rounded-lg text-white bg-gradient-to-r from-[#FF6B3C] to-[#FF8F6B] hover:from-[#FF8F6B] hover:to-[#FF6B3C] transition-all duration-300 md:py-4 md:text-lg md:px-10">
                                    Comenzar
                                </a>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
        </div>
    </div>

    <!-- Features Section -->
    <div class="py-12 bg-white/5">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="lg:text-center">
                <h2 class="text-base text-[#FF6B3C] font-semibold tracking-wide uppercase">Características</h2>
                <p class="mt-2 text-3xl leading-8 font-extrabold tracking-tight text-white sm:text-4xl">
                    Todo lo que necesitas para gestionar tus ventas
                </p>
            </div>

            <div class="mt-10">
                <div class="space-y-10 md:space-y-0 md:grid md:grid-cols-2 md:gap-x-8 md:gap-y-10">
                    <div class="relative hover-scale">
                        <div class="absolute flex items-center justify-center h-12 w-12 rounded-md bg-gradient-to-r from-[#FF6B3C] to-[#FF8F6B] text-white">
                            <i class="fas fa-users text-xl"></i>
                        </div>
                        <div class="ml-16">
                            <h3 class="text-lg leading-6 font-medium text-white">Gestión de Usuarios</h3>
                            <p class="mt-2 text-base text-gray-400">
                                Control de acceso basado en roles para administradores, secretarias, bodegueros y cajeras.
                            </p>
                        </div>
                    </div>

                    <div class="relative hover-scale">
                        <div class="absolute flex items-center justify-center h-12 w-12 rounded-md bg-gradient-to-r from-[#FF6B3C] to-[#FF8F6B] text-white">
                            <i class="fas fa-box text-xl"></i>
                        </div>
                        <div class="ml-16">
                            <h3 class="text-lg leading-6 font-medium text-white">Control de Inventario</h3>
                            <p class="mt-2 text-base text-gray-400">
                                Gestión de productos y categorías con control de stock en tiempo real.
                            </p>
                        </div>
                    </div>

                    <div class="relative hover-scale">
                        <div class="absolute flex items-center justify-center h-12 w-12 rounded-md bg-gradient-to-r from-[#FF6B3C] to-[#FF8F6B] text-white">
                            <i class="fas fa-cash-register text-xl"></i>
                        </div>
                        <div class="ml-16">
                            <h3 class="text-lg leading-6 font-medium text-white">Registro de Ventas</h3>
                            <p class="mt-2 text-base text-gray-400">
                                Sistema completo de registro y seguimiento de ventas con historial detallado.
                            </p>
                        </div>
                    </div>

                    <div class="relative hover-scale">
                        <div class="absolute flex items-center justify-center h-12 w-12 rounded-md bg-gradient-to-r from-[#FF6B3C] to-[#FF8F6B] text-white">
                            <i class="fas fa-chart-line text-xl"></i>
                        </div>
                        <div class="ml-16">
                            <h3 class="text-lg leading-6 font-medium text-white">Dashboard</h3>
                            <p class="mt-2 text-base text-gray-400">
                                Panel de control con estadísticas y métricas importantes para la toma de decisiones.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-white/5 border-t border-white/10">
        <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <p class="text-base text-gray-400">
                    &copy; {{ date('Y') }} VentasPro. Todos los derechos reservados.
                </p>
            </div>
        </div>
    </footer>
</body>
</html>
