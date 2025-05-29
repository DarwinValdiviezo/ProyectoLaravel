<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro - VentasPro</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
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
<body class="bg-gradient-to-br from-gray-900 via-gray-800 to-gray-900 text-white font-[Poppins] min-h-screen flex items-center justify-center p-4">
    <div class="w-full max-w-md animate-fade-in">
        <!-- Logo y Título -->
        <div class="text-center mb-8">
            <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-gradient-to-r from-[#FF6B3C] to-[#FF8F6B] mb-4">
                <span class="text-2xl font-bold text-white">VP</span>
            </div>
            <h1 class="text-3xl font-bold gradient-text">VentasPro</h1>
            <p class="text-gray-400 mt-2">Crea tu cuenta para comenzar</p>
        </div>

        <!-- Formulario de Registro -->
        <div class="bg-white/5 backdrop-blur-lg rounded-xl p-8 shadow-xl border border-white/10">
            <form method="POST" action="{{ route('register') }}" class="space-y-6">
                @csrf

                <!-- Nombre -->
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-300">Nombre</label>
                    <div class="mt-1 relative">
                        <input type="text" name="name" id="name" value="{{ old('name') }}" required autofocus
                            class="w-full px-4 py-2 bg-white/5 border border-white/10 rounded-lg focus:ring-2 focus:ring-[#FF6B3C] focus:border-transparent text-white placeholder-gray-400"
                            placeholder="Ingresa tu nombre">
                        @error('name')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Email -->
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-300">Correo Electrónico</label>
                    <div class="mt-1 relative">
                        <input type="email" name="email" id="email" value="{{ old('email') }}" required
                            class="w-full px-4 py-2 bg-white/5 border border-white/10 rounded-lg focus:ring-2 focus:ring-[#FF6B3C] focus:border-transparent text-white placeholder-gray-400"
                            placeholder="ejemplo@espe.edu.ec">
                        @error('email')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Contraseña -->
                <div>
                    <label for="password" class="block text-sm font-medium text-gray-300">Contraseña</label>
                    <div class="mt-1 relative">
                        <input type="password" name="password" id="password" required
                            class="w-full px-4 py-2 bg-white/5 border border-white/10 rounded-lg focus:ring-2 focus:ring-[#FF6B3C] focus:border-transparent text-white placeholder-gray-400"
                            placeholder="••••••••">
                        <button type="button" onclick="togglePassword('password')" 
                            class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-400 hover:text-white">
                            <i class="fas fa-eye"></i>
                        </button>
                        @error('password')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Confirmar Contraseña -->
                <div>
                    <label for="password_confirmation" class="block text-sm font-medium text-gray-300">Confirmar Contraseña</label>
                    <div class="mt-1 relative">
                        <input type="password" name="password_confirmation" id="password_confirmation" required
                            class="w-full px-4 py-2 bg-white/5 border border-white/10 rounded-lg focus:ring-2 focus:ring-[#FF6B3C] focus:border-transparent text-white placeholder-gray-400"
                            placeholder="••••••••">
                        <button type="button" onclick="togglePassword('password_confirmation')" 
                            class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-400 hover:text-white">
                            <i class="fas fa-eye"></i>
                        </button>
                    </div>
                </div>

                <!-- Botones -->
                <div class="flex flex-col space-y-4">
                    <button type="submit"
                        class="w-full py-2 px-4 bg-gradient-to-r from-[#FF6B3C] to-[#FF8F6B] hover:from-[#FF8F6B] hover:to-[#FF6B3C] text-white font-medium rounded-lg transition-all duration-300 hover-scale">
                        Registrarse
                    </button>
                    <a href="{{ route('login') }}"
                        class="text-center text-sm text-gray-400 hover:text-white transition-colors">
                        ¿Ya tienes una cuenta? Inicia sesión
                    </a>
                </div>
            </form>
        </div>

        <!-- Footer -->
        <div class="text-center mt-8">
            <p class="text-sm text-gray-400">
                &copy; {{ date('Y') }} VentasPro. Todos los derechos reservados.
            </p>
        </div>
    </div>

    <script>
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
    </script>
</body>
</html>
