<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-3">
            <i class="fa-solid fa-cart-shopping text-[#fbbf24]"></i>
            <h2 class="font-semibold text-xl text-white leading-tight">Nueva Venta</h2>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm rounded-xl">
                <div class="p-6">
                    <form method="POST" action="{{ route('ventas.store') }}">
                        @csrf

                        <div class="mb-5">
                            <label for="producto_id" class="block text-sm font-medium text-gray-700 mb-1">Producto</label>
                            <select id="producto_id" name="producto_id"
                                    class="w-full border-gray-300 focus:border-[#3b4a67] focus:ring-[#3b4a67] rounded-md shadow-sm">
                                <option value="">-- Seleccione un producto --</option>
                                @foreach($productos as $producto)
                                    <option value="{{ $producto->id }}" data-precio="{{ $producto->precio_venta }}"
                                        {{ old('producto_id') == $producto->id ? 'selected' : '' }}>
                                        {{ $producto->nombre }} — ${{ number_format($producto->precio_venta, 2) }}
                                    </option>
                                @endforeach
                            </select>
                            @error('producto_id')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="grid grid-cols-2 gap-4 mb-5">
                            <div>
                                <label for="cantidad" class="block text-sm font-medium text-gray-700 mb-1">Cantidad</label>
                                <input type="number" id="cantidad" name="cantidad"
                                       value="{{ old('cantidad') }}"
                                       min="1"
                                       class="w-full border-gray-300 focus:border-[#3b4a67] focus:ring-[#3b4a67] rounded-md shadow-sm">
                                @error('cantidad')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label for="total" class="block text-sm font-medium text-gray-700 mb-1">Total ($)</label>
                                <input type="number" id="total" name="total"
                                       value="{{ old('total') }}"
                                       step="0.01" min="0" readonly
                                       class="w-full border-gray-300 focus:border-[#3b4a67] focus:ring-[#3b4a67] rounded-md shadow-sm">
                                @error('total')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-5">
                            <label for="fecha" class="block text-sm font-medium text-gray-700 mb-1">Fecha</label>
                            <input type="date" id="fecha" name="fecha"
                                   value="{{ old('fecha', date('Y-m-d')) }}"
                                   class="w-full border-gray-300 focus:border-[#3b4a67] focus:ring-[#3b4a67] rounded-md shadow-sm">
                            @error('fecha')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex items-center gap-4 pt-2">
                            <button type="submit"
                                    class="bg-[#3b4a67] hover:bg-[#2f3c55] text-white px-6 py-2 rounded-md text-sm font-semibold transition">
                                Guardar
                            </button>
                            <a href="{{ route('ventas.index') }}" class="text-sm text-gray-500 hover:text-gray-800">
                                Cancelar
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const productoSelect = document.getElementById('producto_id');
            const cantidadInput = document.getElementById('cantidad');
            const totalInput = document.getElementById('total');

            if (!productoSelect || !cantidadInput || !totalInput) {
                return;
            }

            const actualizarTotal = function () {
                const opcionSeleccionada = productoSelect.options[productoSelect.selectedIndex];
                const precio = opcionSeleccionada ? parseFloat(opcionSeleccionada.dataset.precio) : NaN;
                const cantidad = parseFloat(cantidadInput.value);

                if (!Number.isFinite(precio) || !Number.isFinite(cantidad) || cantidad < 0) {
                    totalInput.value = '';
                    return;
                }

                totalInput.value = (cantidad * precio).toFixed(2);
            };

            productoSelect.addEventListener('change', actualizarTotal);
            cantidadInput.addEventListener('input', actualizarTotal);
            actualizarTotal();
        });
    </script>
</x-app-layout>
