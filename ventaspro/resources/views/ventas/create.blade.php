<x-app-layout>
    <h2>Registrar Venta</h2>
    <form method="POST" action="{{ route('ventas.store') }}">
        @csrf

        @foreach($productos as $producto)
            <div>
                <label>
                    <input type="checkbox" name="productos[]" value="{{ $producto->id }}">
                    {{ $producto->nombre }} (${{ $producto->precio }}) - Stock: {{ $producto->stock }}
                </label>
                <input type="number" name="cantidades[]" placeholder="Cantidad" min="1" value="1">
            </div>
        @endforeach

        <button type="submit">Registrar Venta</button>
    </form>
</x-app-layout>
