<x-app-layout>
    <h2>Crear Categoría</h2>
    <form method="POST" action="{{ route('categorias.store') }}">
        @csrf
        <input type="text" name="nombre" placeholder="Nombre de la categoría" required>
        <button type="submit">Guardar</button>
    </form>
</x-app-layout>
