<x-app-layout>
    <h2>Lista de Usuarios</h2>
    <a href="{{ route('usuarios.create') }}">Crear Usuario</a>
    <ul>
@foreach($usuarios as $user)
    <li>
        {{ $user->name }} - {{ $user->email }} - {{ $user->roles->pluck('name')->join(', ') }}
        @if(auth()->user()->hasRole('admin'))
            <a href="{{ route('usuarios.edit', $user) }}">Editar</a>
            <form action="{{ route('usuarios.destroy', $user) }}" method="POST" style="display:inline">
                @csrf @method('DELETE')
                <button type="submit" onclick="return confirm('¿Eliminar usuario?')">Eliminar</button>
            </form>
        @endif
    </li>
@endforeach

    </ul>
</x-app-layout>
