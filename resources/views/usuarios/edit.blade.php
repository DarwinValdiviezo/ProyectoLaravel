<x-app-layout>
    <h2>Editar Usuario</h2>
    <form method="POST" action="{{ route('usuarios.update', $user) }}">
        @csrf @method('PUT')
        <input type="text" name="name" value="{{ $user->name }}" required>
        <input type="email" name="email" value="{{ $user->email }}" required>

        <select name="rol" required>
            @foreach($roles as $rol)
                <option value="{{ $rol->name }}" @selected($user->hasRole($rol->name))>{{ $rol->name }}</option>
            @endforeach
        </select>

        <button type="submit">Actualizar</button>
    </form>
</x-app-layout>
