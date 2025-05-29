<x-app-layout>
    <h2>Listado de Categorías</h2>
    <a href="{{ route('categorias.create') }}">Crear Categoría</a>
    <ul>
        @foreach($categorias as $categoria)
    <li>
        {{ $categoria->nombre }}
        <a href="{{ route('categorias.edit', $categoria) }}">Editar</a>
        <form action="{{ route('categorias.destroy', $categoria) }}" method="POST" style="display:inline">
            @csrf @method('DELETE')
            <button type="submit" onclick="return confirm('¿Eliminar categoría?')">Eliminar</button>
        </form>
    </li>
@endforeach

    </ul>
</x-app-layout>
