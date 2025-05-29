<x-app-layout>
    <h2>Crear Usuario</h2>
    <form method="POST" action="{{ route('usuarios.store') }}">
        @csrf
        <input type="text" name="name" placeholder="Nombre" required>
        <input type="email" name="email" placeholder="Correo" required>
        <input type="password" name="password" placeholder="Contraseña" required>

        <select name="rol" required>
            <option value="">Seleccionar Rol</option>
            @foreach($roles as $rol)
                <option value="{{ $rol->name }}">{{ $rol->name }}</option>
            @endforeach
        </select>

        <button type="submit">Crear</button>
    </form>
</x-app-layout>
