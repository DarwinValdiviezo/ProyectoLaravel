<x-app-layout>
    <h2>Crear Producto</h2>
    <form method="POST" action="{{ route('productos.store') }}">
        @csrf
        <input type="text" name="nombre" placeholder="Nombre del producto" required>
        <input type="number" step="0.01" name="precio" placeholder="Precio" required>
        <input type="number" name="stock" placeholder="Stock" required>

        <select name="categoria_id" required>
            <option value="">Seleccione una categoría</option>
            @foreach($categorias as $categoria)
                <option value="{{ $categoria->id }}">{{ $categoria->nombre }}</option>
            @endforeach
        </select>

        <button type="submit">Guardar</button>
    </form>
</x-app-layout>
