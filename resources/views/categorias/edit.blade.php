<x-app-layout>
    <h2>Editar Categoría</h2>
    <form method="POST" action="{{ route('categorias.update', $categoria) }}">
        @csrf @method('PUT')
        <input type="text" name="nombre" value="{{ $categoria->nombre }}" required>
        <button type="submit">Actualizar</button>
    </form>
</x-app-layout>
