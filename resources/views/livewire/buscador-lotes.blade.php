<div>
    {{-- Buscador reactivo en tiempo real --}}
    <div class="mb-4">
        <input
            wire:model.live="search"
            type="text"
            placeholder="Buscar por estado o fecha (ej: Activo, 2024-01)..."
            class="w-full sm:w-96 border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
        >
    </div>

    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">#</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Cantidad (aves)</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Fecha Inicio</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Estado</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Acciones</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($lotes as $lote)
                    <tr>
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
                               class="text-indigo-600 hover:text-indigo-900 font-medium">Editar</a>
                            <form action="{{ route('lotes.destroy', $lote) }}" method="POST"
                                  onsubmit="return confirm('¿Eliminar este lote?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-900 font-medium">Eliminar</button>
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

            <div class="mt-4">
                {{ $lotes->links() }}
            </div>
        </div>
    </div>
</div>
