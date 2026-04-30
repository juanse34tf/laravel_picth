<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <div class="flex items-center gap-3">
                <i class="fa-solid fa-egg text-[#fbbf24]"></i>
                <h2 class="font-semibold text-xl text-white leading-tight">Producción</h2>
            </div>
            <div class="flex items-center gap-3">
                <a href="{{ route('produccion.pdf') }}"
                   class="bg-rose-600 hover:bg-rose-500 text-white px-4 py-2 rounded-md text-sm font-semibold transition">
                    <i class="fa-solid fa-file-pdf mr-1"></i> Exportar PDF
                </a>
                <a href="{{ route('produccion.create') }}"
                   class="bg-blue-500 hover:bg-blue-400 text-white px-4 py-2 rounded-md text-sm font-semibold transition">
                    <i class="fa-solid fa-plus mr-1"></i> Nuevo Registro
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if(session('success'))
                <div class="mb-4 flex items-center gap-2 bg-green-100 border border-green-400 text-green-800 px-4 py-3 rounded-lg">
                    <i class="fa-solid fa-circle-check text-green-600"></i>
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm rounded-xl">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-[#3b4a67]">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-white uppercase tracking-wider">#</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-white uppercase tracking-wider">Lote</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-white uppercase tracking-wider">Fecha</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-white uppercase tracking-wider">Tipo Huevo</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-white uppercase tracking-wider">Cantidad</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-white uppercase tracking-wider">Observaciones</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-white uppercase tracking-wider">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-100">
                        @forelse($producciones as $prod)
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-400 font-mono">{{ $prod->id }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold text-gray-900">
                                Lote #{{ $prod->lote->id }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{ $prod->fecha }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{ $prod->tipo_huevo }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold text-gray-900">{{ number_format($prod->cantidad) }}</td>
                            <td class="px-6 py-4 text-sm text-gray-600 max-w-xs truncate">
                                {{ $prod->observaciones ?? '—' }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm flex items-center gap-4">
                                <a href="{{ route('produccion.edit', $prod) }}"
                                   class="text-[#3b4a67] hover:text-blue-700 font-semibold">
                                    <i class="fa-solid fa-pen-to-square mr-1"></i>Editar
                                </a>
                                <form action="{{ route('produccion.destroy', $prod) }}" method="POST"
                                      onsubmit="return confirm('¿Eliminar este registro?')">
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
                            <td colspan="7" class="px-6 py-12 text-center text-sm text-gray-400">
                                <i class="fa-solid fa-inbox text-2xl mb-2 block"></i>
                                No hay registros de producción.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>

                <div class="px-6 py-4 border-t border-gray-100">
                    {{ $producciones->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
