<x-app-layout>
    <h2>Listado de Productos</h2>
    <a href="{{ route('productos.create') }}">Crear Producto</a>
    <ul>
@foreach($productos as $producto)
    <li>
        {{ $producto->nombre }} - ${{ $producto->precio }} - Stock: {{ $producto->stock }} - Categoría: {{ $producto->categoria->nombre }}
        <a href="{{ route('productos.edit', $producto) }}">Editar</a>

        <form action="{{ route('productos.destroy', $producto) }}" method="POST" style="display:inline">
            @csrf @method('DELETE')
            <button type="submit" onclick="return confirm('¿Eliminar producto?')">Eliminar</button>
        </form>
    </li>
@endforeach
    </ul>
</x-app-layout>
