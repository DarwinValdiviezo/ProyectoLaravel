<x-app-layout>
    <h2 class="text-xl font-bold mb-4">Asignar Rol a Usuario</h2>

    @if(session('success'))
        <div class="bg-green-200 text-green-800 px-4 py-2 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <form method="POST" action="{{ route('usuarios.asignar.store') }}">
        @csrf
        <div class="mb-4">
            <label for="user_id">Usuario:</label>
            <select name="user_id" required class="border rounded px-2 py-1">
                @foreach($usuarios as $user)
                    <option value="{{ $user->id }}">
                        {{ $user->name }} ({{ $user->email }}) - Actual: {{ $user->roles->pluck('name')->join(', ') }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-4">
            <label for="rol">Rol:</label>
            <select name="rol" required class="border rounded px-2 py-1">
                @foreach($roles as $rol)
                    <option value="{{ $rol->name }}">{{ $rol->name }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Asignar Rol</button>
    </form>
</x-app-layout>
