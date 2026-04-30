<div>
    {{-- Barra de búsqueda como tarjeta elevada --}}
    <div class="bg-white rounded-lg shadow-sm px-5 py-4 mb-4">
        <div class="flex items-center gap-3">
            <i class="fa-solid fa-magnifying-glass text-gray-400"></i>
            <input
                wire:model.live="search"
                type="text"
                placeholder="Buscar por estado o fecha (ej: Activo, 2024-01)..."
                class="flex-1 border-gray-300 focus:border-blue-500 focus:ring-blue-500 rounded-md shadow-sm text-sm"
            >
        </div>
    </div>

    <div class="bg-white overflow-hidden shadow-sm rounded-lg">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-[#1e293b]">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">#</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Cantidad (aves)</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Fecha Inicio</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Estado</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Acciones</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-100">
                @forelse($lotes as $lote)
                <tr class="hover:bg-gray-50 transition-colors">
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $lote->id }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ number_format($lote->cantidad) }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{ $lote->fecha_inicio }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        @if($lote->estado === 'Activo')
                            <span class="px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">{{ $lote->estado }}</span>
                        @elseif($lote->estado === 'Finalizado')
                            <span class="px-2 py-1 text-xs font-semibold rounded-full bg-gray-100 text-gray-600">{{ $lote->estado }}</span>
                        @else
                            <span class="px-2 py-1 text-xs font-semibold rounded-full bg-yellow-100 text-yellow-800">{{ $lote->estado }}</span>
                        @endif
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm flex items-center gap-3">
                        <a href="{{ route('lotes.edit', $lote) }}"
                           class="text-blue-600 hover:text-blue-800 font-medium">Editar</a>
                        <form action="{{ route('lotes.destroy', $lote) }}" method="POST"
                              onsubmit="return confirm('¿Eliminar este lote?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:text-red-800 font-medium">Eliminar</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-6 py-10 text-center text-sm text-gray-500">
                        @if($search)
                            No se encontraron lotes con "{{ $search }}".
                        @else
                            No hay lotes registrados.
                        @endif
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>

        <div class="px-6 py-4 border-t border-gray-100">
            {{ $lotes->links() }}
        </div>
    </div>
</div>
