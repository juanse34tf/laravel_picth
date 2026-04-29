<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Nuevo Registro de Producción</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <form method="POST" action="{{ route('produccion.store') }}">
                        @csrf

                        <div class="mb-5">
                            <label for="lote_id" class="block text-sm font-medium text-gray-700 mb-1">Lote</label>
                            <select id="lote_id" name="lote_id"
                                    class="w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                <option value="">-- Seleccione un lote activo --</option>
                                @foreach($lotes as $lote)
                                    <option value="{{ $lote->id }}"
                                        {{ old('lote_id') == $lote->id ? 'selected' : '' }}>
                                        Lote #{{ $lote->id }} — {{ $lote->cantidad }} aves ({{ $lote->fecha_inicio }})
                                    </option>
                                @endforeach
                            </select>
                            @error('lote_id')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="grid grid-cols-2 gap-4 mb-5">
                            <div>
                                <label for="fecha" class="block text-sm font-medium text-gray-700 mb-1">Fecha</label>
                                <input type="date" id="fecha" name="fecha" value="{{ old('fecha', date('Y-m-d')) }}"
                                       class="w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                @error('fecha')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label for="tipo_huevo" class="block text-sm font-medium text-gray-700 mb-1">Tipo de Huevo</label>
                                <input type="text" id="tipo_huevo" name="tipo_huevo" value="{{ old('tipo_huevo') }}"
                                       placeholder="Ej: Blanco, Marrón, AA"
                                       class="w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                @error('tipo_huevo')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-5">
                            <label for="cantidad" class="block text-sm font-medium text-gray-700 mb-1">Cantidad (unidades)</label>
                            <input type="number" id="cantidad" name="cantidad" value="{{ old('cantidad') }}"
                                   min="1"
                                   class="w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                            @error('cantidad')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-6">
                            <label for="observaciones" class="block text-sm font-medium text-gray-700 mb-1">
                                Observaciones <span class="text-gray-400">(opcional)</span>
                            </label>
                            <textarea id="observaciones" name="observaciones" rows="3"
                                      class="w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">{{ old('observaciones') }}</textarea>
                            @error('observaciones')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex items-center gap-4">
                            <button type="submit"
                                    class="bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-2 rounded-md text-sm font-medium transition">
                                Guardar
                            </button>
                            <a href="{{ route('produccion.index') }}" class="text-sm text-gray-600 hover:text-gray-900">
                                Cancelar
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
