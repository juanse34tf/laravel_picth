<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-3">
            <i class="fa-solid fa-receipt text-[#fbbf24]"></i>
            <h2 class="font-semibold text-xl text-white leading-tight">Editar Gasto</h2>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm rounded-xl">
                <div class="p-6">
                    <form method="POST" action="{{ route('gastos.update', $gasto) }}">
                        @csrf
                        @method('PUT')

                        <div class="mb-5">
                            <label for="descripcion" class="block text-sm font-medium text-gray-700 mb-1">Descripción</label>
                            <input type="text" id="descripcion" name="descripcion"
                                   value="{{ old('descripcion', $gasto->descripcion) }}"
                                   class="w-full border-gray-300 focus:border-[#3b4a67] focus:ring-[#3b4a67] rounded-md shadow-sm">
                            @error('descripcion')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="grid grid-cols-2 gap-4 mb-5">
                            <div>
                                <label for="monto" class="block text-sm font-medium text-gray-700 mb-1">Monto ($)</label>
                                <input type="number" id="monto" name="monto"
                                       value="{{ old('monto', $gasto->monto) }}"
                                       step="0.01" min="0"
                                       class="w-full border-gray-300 focus:border-[#3b4a67] focus:ring-[#3b4a67] rounded-md shadow-sm">
                                @error('monto')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label for="fecha" class="block text-sm font-medium text-gray-700 mb-1">Fecha</label>
                                <input type="date" id="fecha" name="fecha"
                                       value="{{ old('fecha', $gasto->fecha) }}"
                                       class="w-full border-gray-300 focus:border-[#3b4a67] focus:ring-[#3b4a67] rounded-md shadow-sm">
                                @error('fecha')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="flex items-center gap-4 pt-2">
                            <button type="submit"
                                    class="bg-[#3b4a67] hover:bg-[#2f3c55] text-white px-6 py-2 rounded-md text-sm font-semibold transition">
                                Actualizar
                            </button>
                            <a href="{{ route('gastos.index') }}" class="text-sm text-gray-500 hover:text-gray-800">
                                Cancelar
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
