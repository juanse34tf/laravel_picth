<div>
    {{-- Barra de búsqueda como tarjeta elevada --}}
    <div class="bg-white rounded-xl shadow-sm px-5 py-4 mb-4 flex items-center gap-3">
        <i class="fa-solid fa-magnifying-glass text-gray-400"></i>
        <input
            wire:model.live="search"
            type="text"
            placeholder="Buscar por estado o fecha (ej: Activo, 2024-01)..."
            class="flex-1 border-gray-200 focus:border-[#3b4a67] focus:ring-[#3b4a67] rounded-md text-sm"
        >
    </div>

    <div class="bg-white overflow-hidden shadow-sm rounded-xl">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-[#3b4a67]">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-white uppercase tracking-wider">#</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-white uppercase tracking-wider">Cantidad (aves)</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-white uppercase tracking-wider">Fecha Inicio</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-white uppercase tracking-wider">Estado</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-white uppercase tracking-wider">Acciones</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-100">
                @forelse($lotes as $lote)
                <tr class="hover:bg-gray-50 transition-colors">
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-400 font-mono">{{ $lote->id }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold text-gray-900">{{ number_format($lote->cantidad) }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{ $lote->fecha_inicio }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        @if($lote->estado === 'Activo')
                            <span class="px-2.5 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">{{ $lote->estado }}</span>
                        @elseif($lote->estado === 'Finalizado')
                            <span class="px-2.5 py-1 text-xs font-semibold rounded-full bg-gray-100 text-gray-600">{{ $lote->estado }}</span>
                        @else
                            <span class="px-2.5 py-1 text-xs font-semibold rounded-full bg-yellow-100 text-yellow-800">{{ $lote->estado }}</span>
                        @endif
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm flex items-center gap-4">
                        <a href="{{ route('lotes.edit', $lote) }}"
                           class="text-[#3b4a67] hover:text-blue-700 font-semibold">
                            <i class="fa-solid fa-pen-to-square mr-1"></i>Editar
                        </a>
                        <form action="{{ route('lotes.destroy', $lote) }}" method="POST"
                              onsubmit="return confirm('¿Eliminar este lote?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-500 hover:text-red-700 font-semibold">
                                <i class="fa-solid fa-trash mr-1"></i>Eliminar
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-6 py-12 text-center text-sm text-gray-400">
                        <i class="fa-solid fa-inbox text-2xl mb-2 block"></i>
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
