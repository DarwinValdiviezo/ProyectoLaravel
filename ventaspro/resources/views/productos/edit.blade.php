<x-app-layout>
    <h2>Editar Producto</h2>
    <form method="POST" action="{{ route('productos.update', $producto) }}">
        @csrf @method('PUT')
        <input type="text" name="nombre" value="{{ $producto->nombre }}" required>
        <input type="number" step="0.01" name="precio" value="{{ $producto->precio }}" required>
        <input type="number" name="stock" value="{{ $producto->stock }}" required>

        <select name="categoria_id" required>
            @foreach($categorias as $categoria)
                <option value="{{ $categoria->id }}" @selected($producto->categoria_id == $categoria->id)>
                    {{ $categoria->nombre }}
                </option>
            @endforeach
        </select>

        <button type="submit">Actualizar</button>
    </form>
</x-app-layout>
