<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Iniciar Sesión - VentasPro</title>
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
<body class="bg-gradient-to-br from-gray-900 via-gray-800 to-gray-900 text-white font-[Poppins] min-h-screen flex items-center justify-center">
    <div class="w-full max-w-md p-8 space-y-8 bg-white/5 backdrop-blur-lg rounded-xl border border-white/10 shadow-xl hover-scale animate-fade-in">
        <div class="text-center">
            <div class="flex justify-center mb-6">
                <div class="w-16 h-16 flex items-center justify-center rounded-full bg-gradient-to-r from-[#FF6B3C] to-[#FF8F6B] text-white font-bold text-2xl shadow-lg">
                    VP
                </div>
            </div>
            <h2 class="text-3xl font-bold text-white">Bienvenido a VentasPro</h2>
            <p class="mt-2 text-gray-400">Ingresa tus credenciales para continuar</p>
        </div>

        @if (session('status'))
            <div class="p-4 bg-green-500/20 border border-green-500/50 rounded-lg text-green-400">
                <i class="fas fa-check-circle mr-2"></i>
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}" class="mt-8 space-y-6">
            @csrf

            <div class="space-y-4">
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-300">
                        Correo Electrónico
                    </label>
                    <div class="mt-1 relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-envelope text-gray-400"></i>
                        </div>
                        <input id="email" name="email" type="email" required 
                               class="w-full pl-10 pr-4 py-2 bg-white/5 border border-white/10 rounded-lg text-white placeholder-gray-400 focus:outline-none focus:border-[#FF6B3C] focus:ring-1 focus:ring-[#FF6B3C]"
                               placeholder="usuario@espe.edu.ec"
                               value="{{ old('email') }}">
                    </div>
                    @error('email')
                        <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="password" class="block text-sm font-medium text-gray-300">
                        Contraseña
                    </label>
                    <div class="mt-1 relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-lock text-gray-400"></i>
                        </div>
                        <input id="password" name="password" type="password" required 
                               class="w-full pl-10 pr-10 py-2 bg-white/5 border border-white/10 rounded-lg text-white placeholder-gray-400 focus:outline-none focus:border-[#FF6B3C] focus:ring-1 focus:ring-[#FF6B3C]"
                               placeholder="••••••••">
                        <button type="button" onclick="togglePassword('password')" 
                            class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-400 hover:text-white">
                            <i class="fas fa-eye"></i>
                        </button>
                    </div>
                    @error('password')
                        <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <input id="remember_me" name="remember" type="checkbox" 
                               class="h-4 w-4 bg-white/5 border-white/10 rounded text-[#FF6B3C] focus:ring-[#FF6B3C]">
                        <label for="remember_me" class="ml-2 block text-sm text-gray-300">
                            Recordarme
                        </label>
                    </div>

                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" 
                           class="text-sm text-[#FF6B3C] hover:text-[#FF8F6B] transition-colors">
                            ¿Olvidaste tu contraseña?
                        </a>
                    @endif
                </div>
            </div>

            <div>
                <button type="submit" 
                        class="w-full flex justify-center items-center px-4 py-2 bg-gradient-to-r from-[#FF6B3C] to-[#FF8F6B] text-white rounded-lg hover:from-[#FF8F6B] hover:to-[#FF6B3C] transition-all duration-300 shadow-lg hover:shadow-[#FF6B3C]/50">
                    <i class="fas fa-sign-in-alt mr-2"></i>
                    Iniciar Sesión
                </button>
            </div>
        </form>

        <div class="mt-6 text-center">
            <p class="text-sm text-gray-400">
                ¿No tienes una cuenta? 
                <a href="{{ route('register') }}" class="text-[#FF6B3C] hover:text-[#FF8F6B] transition-colors">
                    Regístrate aquí
                </a>
            </p>
        </div>
    </div>

    <script>
        // Función para mostrar/ocultar contraseña
        function togglePassword(inputId) {
            const input = document.getElementById(inputId);
            const icon = input.nextElementSibling.querySelector('i');
            
            if (input.type === 'password') {
                input.type = 'text';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                input.type = 'password';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        }

        // Validación del formulario
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.querySelector('form');
            const email = document.getElementById('email');
            const password = document.getElementById('password');

            form.addEventListener('submit', function(e) {
                let isValid = true;
                let errorMessage = '';

                // Validar email
                if (!email.value) {
                    isValid = false;
                    errorMessage = 'El correo electrónico es obligatorio';
                } else if (!email.value.match(/^[a-zA-Z0-9._%+-]+@espe\.edu\.ec$/)) {
                    isValid = false;
                    errorMessage = 'Solo se permiten correos de @espe.edu.ec';
                }

                // Validar contraseña
                if (!password.value) {
                    isValid = false;
                    errorMessage = 'La contraseña es obligatoria';
                }

                if (!isValid) {
                    e.preventDefault();
                    alert(errorMessage);
                }
            });
        });
    </script>
</body>
</html>
