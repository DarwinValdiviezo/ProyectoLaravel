<x-app-layout>
    <h2>Mis Ventas</h2>

    @foreach($ventas as $venta)
        <div>
            <strong>Venta #{{ $venta->id }}</strong> - Fecha: {{ $venta->created_at->format('d/m/Y') }}
            <ul>
                @foreach($venta->detalles as $detalle)
                    <li>{{ $detalle->producto->nombre }} - Cantidad: {{ $detalle->cantidad }}</li>
                @endforeach
            </ul>
        </div>
    @endforeach
</x-app-layout>
