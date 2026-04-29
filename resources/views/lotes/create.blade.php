<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Nuevo Lote</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <form method="POST" action="{{ route('lotes.store') }}">
                        @csrf

                        <div class="mb-5">
                            <label for="cantidad" class="block text-sm font-medium text-gray-700 mb-1">Cantidad de Aves</label>
                            <input type="number" id="cantidad" name="cantidad" value="{{ old('cantidad') }}"
                                   min="1"
                                   class="w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                            @error('cantidad')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-5">
                            <label for="fecha_inicio" class="block text-sm font-medium text-gray-700 mb-1">Fecha de Inicio</label>
                            <input type="date" id="fecha_inicio" name="fecha_inicio"
                                   value="{{ old('fecha_inicio', date('Y-m-d')) }}"
                                   class="w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                            @error('fecha_inicio')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-6">
                            <label for="estado" class="block text-sm font-medium text-gray-700 mb-1">Estado</label>
                            <select id="estado" name="estado"
                                    class="w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                <option value="Activo"    {{ old('estado', 'Activo') === 'Activo'     ? 'selected' : '' }}>Activo</option>
                                <option value="Finalizado"{{ old('estado') === 'Finalizado' ? 'selected' : '' }}>Finalizado</option>
                                <option value="En Espera" {{ old('estado') === 'En Espera'  ? 'selected' : '' }}>En Espera</option>
                            </select>
                            @error('estado')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex items-center gap-4">
                            <button type="submit"
                                    class="bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-2 rounded-md text-sm font-medium transition">
                                Guardar
                            </button>
                            <a href="{{ route('lotes.index') }}" class="text-sm text-gray-600 hover:text-gray-900">
                                Cancelar
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
