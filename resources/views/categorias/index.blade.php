<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <div class="flex items-center gap-3">
                <i class="fa-solid fa-tags text-[#fbbf24]"></i>
                <h2 class="font-semibold text-xl text-white leading-tight">Categorías</h2>
            </div>
            <a href="{{ route('categorias.create') }}"
               class="bg-blue-500 hover:bg-blue-400 text-white px-4 py-2 rounded-md text-sm font-semibold transition">
                <i class="fa-solid fa-plus mr-1"></i> Nueva Categoría
            </a>
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
                            <th class="px-6 py-3 text-left text-xs font-semibold text-white uppercase tracking-wider">Nombre</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-white uppercase tracking-wider">Descripción</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-white uppercase tracking-wider">Estado</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-white uppercase tracking-wider">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-100">
                        @forelse($categorias as $categoria)
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-400 font-mono">{{ $categoria->id }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold text-gray-900">{{ $categoria->nombre }}</td>
                            <td class="px-6 py-4 text-sm text-gray-600">{{ $categoria->descripcion }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if($categoria->status)
                                    <span class="px-2.5 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">Activo</span>
                                @else
                                    <span class="px-2.5 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-700">Inactivo</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm flex items-center gap-4">
                                <a href="{{ route('categorias.edit', $categoria) }}"
                                   class="text-[#3b4a67] hover:text-blue-700 font-semibold">
                                    <i class="fa-solid fa-pen-to-square mr-1"></i>Editar
                                </a>
                                <form action="{{ route('categorias.destroy', $categoria) }}" method="POST"
                                      onsubmit="return confirm('¿Eliminar esta categoría?')">
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
                                No hay categorías registradas.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>

                <div class="px-6 py-4 border-t border-gray-100">
                    {{ $categorias->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
