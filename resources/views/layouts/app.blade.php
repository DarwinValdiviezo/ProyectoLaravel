<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <!-- Tailwind -->
        <script src="https://cdn.tailwindcss.com"></script>

        <!-- Google Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500&display=swap" rel="stylesheet">

        <!-- Font Awesome -->
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">

        <!-- jQuery y jQuery Validate -->
        <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/additional-methods.min.js"></script>

        <!-- Estilo base para fuente -->
        <style>
            body {
                font-family: 'Roboto', sans-serif;
            }
            .error {
                color: #ef4444;
                font-size: 0.875rem;
                margin-top: 0.25rem;
            }
            input.error, select.error, textarea.error {
                border-color: #ef4444 !important;
            }
        </style>

        <link href="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.css" rel="stylesheet" />
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @isset($header)
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>

        <script>
            $(document).ready(function() {
                // Validación para el formulario de registro
                $('#register-form').validate({
                    rules: {
                        name: {
                            required: true,
                            minlength: 3
                        },
                        email: {
                            required: true,
                            email: true,
                            pattern: /^[a-zA-Z0-9._%+-]+@espe\.edu\.ec$/
                        },
                        password: {
                            required: true,
                            minlength: 8,
                            pattern: /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/
                        },
                        password_confirmation: {
                            required: true,
                            equalTo: "#password"
                        }
                    },
                    messages: {
                        name: {
                            required: "El nombre es obligatorio",
                            minlength: "El nombre debe tener al menos 3 caracteres"
                        },
                        email: {
                            required: "El correo electrónico es obligatorio",
                            email: "Ingrese un correo electrónico válido",
                            pattern: "Solo se permiten correos de @espe.edu.ec"
                        },
                        password: {
                            required: "La contraseña es obligatoria",
                            minlength: "La contraseña debe tener al menos 8 caracteres",
                            pattern: "La contraseña debe contener mayúsculas, minúsculas, números y símbolos"
                        },
                        password_confirmation: {
                            required: "Confirme su contraseña",
                            equalTo: "Las contraseñas no coinciden"
                        }
                    },
                    errorElement: 'span',
                    errorClass: 'error',
                    errorPlacement: function(error, element) {
                        error.insertAfter(element);
                    }
                });

                // Validación para el formulario de login
                $('#login-form').validate({
                    rules: {
                        email: {
                            required: true,
                            email: true,
                            pattern: /^[a-zA-Z0-9._%+-]+@espe\.edu\.ec$/
                        },
                        password: {
                            required: true
                        }
                    },
                    messages: {
                        email: {
                            required: "El correo electrónico es obligatorio",
                            email: "Ingrese un correo electrónico válido",
                            pattern: "Solo se permiten correos de @espe.edu.ec"
                        },
                        password: {
                            required: "La contraseña es obligatoria"
                        }
                    },
                    errorElement: 'span',
                    errorClass: 'error',
                    errorPlacement: function(error, element) {
                        error.insertAfter(element);
                    }
                });

                // Validación para el formulario de ventas
                $('#venta-form').validate({
                    rules: {
                        'productos[]': {
                            required: true,
                            minlength: 1
                        },
                        'cantidades[]': {
                            required: true,
                            min: 1,
                            number: true
                        }
                    },
                    messages: {
                        'productos[]': {
                            required: "Debe seleccionar al menos un producto",
                            minlength: "Debe seleccionar al menos un producto"
                        },
                        'cantidades[]': {
                            required: "La cantidad es obligatoria",
                            min: "La cantidad mínima es 1",
                            number: "Debe ingresar un número válido"
                        }
                    },
                    errorElement: 'span',
                    errorClass: 'error',
                    errorPlacement: function(error, element) {
                        error.insertAfter(element);
                    }
                });

                // Validación para el formulario de productos
                $('#producto-form').validate({
                    rules: {
                        nombre: {
                            required: true,
                            minlength: 3
                        },
                        precio: {
                            required: true,
                            number: true,
                            min: 0
                        },
                        stock: {
                            required: true,
                            number: true,
                            min: 0
                        },
                        categoria_id: {
                            required: true
                        }
                    },
                    messages: {
                        nombre: {
                            required: "El nombre es obligatorio",
                            minlength: "El nombre debe tener al menos 3 caracteres"
                        },
                        precio: {
                            required: "El precio es obligatorio",
                            number: "Debe ingresar un número válido",
                            min: "El precio no puede ser negativo"
                        },
                        stock: {
                            required: "El stock es obligatorio",
                            number: "Debe ingresar un número válido",
                            min: "El stock no puede ser negativo"
                        },
                        categoria_id: {
                            required: "Debe seleccionar una categoría"
                        }
                    },
                    errorElement: 'span',
                    errorClass: 'error',
                    errorPlacement: function(error, element) {
                        error.insertAfter(element);
                    }
                });

                // Validación para el formulario de categorías
                $('#categoria-form').validate({
                    rules: {
                        nombre: {
                            required: true,
                            minlength: 3
                        }
                    },
                    messages: {
                        nombre: {
                            required: "El nombre es obligatorio",
                            minlength: "El nombre debe tener al menos 3 caracteres"
                        }
                    },
                    errorElement: 'span',
                    errorClass: 'error',
                    errorPlacement: function(error, element) {
                        error.insertAfter(element);
                    }
                });

                // Función para mostrar el modal de confirmación
                window.confirmDelete = function(formId, message) {
                    if (confirm(message || '¿Está seguro que desea eliminar este registro?')) {
                        document.getElementById(formId).submit();
                    }
                }
            });
        </script>

        <!-- Modal de Confirmación -->
        <div id="deleteModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden overflow-y-auto h-full w-full">
            <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
                <div class="mt-3 text-center">
                    <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-red-100">
                        <i class="fas fa-exclamation-triangle text-red-600"></i>
                    </div>
                    <h3 class="text-lg leading-6 font-medium text-gray-900 mt-4">Confirmar Eliminación</h3>
                    <div class="mt-2 px-7 py-3">
                        <p class="text-sm text-gray-500" id="deleteModalMessage">
                            ¿Está seguro que desea eliminar este registro?
                        </p>
                    </div>
                    <div class="items-center px-4 py-3">
                        <button id="deleteConfirmBtn" class="px-4 py-2 bg-red-500 text-white text-base font-medium rounded-md shadow-sm hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-red-300">
                            Eliminar
                        </button>
                        <button id="deleteCancelBtn" class="ml-3 px-4 py-2 bg-gray-100 text-gray-700 text-base font-medium rounded-md shadow-sm hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-gray-300">
                            Cancelar
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
