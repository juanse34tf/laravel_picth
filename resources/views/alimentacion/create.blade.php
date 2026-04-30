<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-3">
            <i class="fa-solid fa-wheat-awn text-[#fbbf24]"></i>
            <h2 class="font-semibold text-xl text-white leading-tight">Nuevo Registro de Alimentación</h2>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm rounded-xl">
                <div class="p-6">
                    <form method="POST" action="{{ route('alimentacion.store') }}">
                        @csrf

                        <div class="mb-5">
                            <label for="lote_id" class="block text-sm font-medium text-gray-700 mb-1">Lote</label>
                            <select id="lote_id" name="lote_id"
                                    class="w-full border-gray-300 focus:border-[#3b4a67] focus:ring-[#3b4a67] rounded-md shadow-sm">
                                <option value="">-- Seleccione un lote --</option>
                                @foreach($lotes as $lote)
                                    <option value="{{ $lote->id }}"
                                        {{ old('lote_id') == $lote->id ? 'selected' : '' }}>
                                        Lote #{{ $lote->id }} — {{ number_format($lote->cantidad) }} aves ({{ $lote->estado }})
                                    </option>
                                @endforeach
                            </select>
                            @error('lote_id')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-5">
                            <label for="tipo_alimento" class="block text-sm font-medium text-gray-700 mb-1">Tipo de Alimento</label>
                            <input type="text" id="tipo_alimento" name="tipo_alimento"
                                   value="{{ old('tipo_alimento') }}"
                                   placeholder="Ej: Concentrado, Maíz, Soya"
                                   class="w-full border-gray-300 focus:border-[#3b4a67] focus:ring-[#3b4a67] rounded-md shadow-sm">
                            @error('tipo_alimento')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="grid grid-cols-2 gap-4 mb-5">
                            <div>
                                <label for="cantidad_kg" class="block text-sm font-medium text-gray-700 mb-1">Cantidad (kg)</label>
                                <input type="number" id="cantidad_kg" name="cantidad_kg"
                                       value="{{ old('cantidad_kg') }}"
                                       step="0.01" min="0.1"
                                       class="w-full border-gray-300 focus:border-[#3b4a67] focus:ring-[#3b4a67] rounded-md shadow-sm">
                                @error('cantidad_kg')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label for="fecha" class="block text-sm font-medium text-gray-700 mb-1">Fecha</label>
                                <input type="date" id="fecha" name="fecha"
                                       value="{{ old('fecha', date('Y-m-d')) }}"
                                       class="w-full border-gray-300 focus:border-[#3b4a67] focus:ring-[#3b4a67] rounded-md shadow-sm">
                                @error('fecha')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="flex items-center gap-4 pt-2">
                            <button type="submit"
                                    class="bg-[#3b4a67] hover:bg-[#2f3c55] text-white px-6 py-2 rounded-md text-sm font-semibold transition">
                                Guardar
                            </button>
                            <a href="{{ route('alimentacion.index') }}" class="text-sm text-gray-500 hover:text-gray-800">
                                Cancelar
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
