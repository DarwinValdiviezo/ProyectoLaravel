<x-app-layout>
    <h2>Registrar Venta</h2>
    <form method="POST" action="{{ route('ventas.store') }}" id="venta-form">
        @csrf
        <div class="space-y-4">
            <div>
                <label for="productos" class="block text-sm font-medium text-gray-700">Productos</label>
                <select name="productos[]" id="productos" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" multiple required>
                    @foreach($productos as $producto)
                        <option value="{{ $producto->id }}">{{ $producto->nombre }} - Stock: {{ $producto->stock }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label for="cantidades" class="block text-sm font-medium text-gray-700">Cantidades</label>
                <input type="number" name="cantidades[]" id="cantidades" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" min="1" required>
            </div>
        </div>

        <button type="submit">Registrar Venta</button>
    </form>
</x-app-layout>
