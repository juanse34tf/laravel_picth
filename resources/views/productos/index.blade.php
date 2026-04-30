<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <div class="flex items-center gap-3">
                <i class="fa-solid fa-box text-[#fbbf24]"></i>
                <h2 class="font-semibold text-xl text-white leading-tight">Productos</h2>
            </div>
            <a href="{{ route('productos.create') }}"
               class="bg-blue-500 hover:bg-blue-400 text-white px-4 py-2 rounded-md text-sm font-semibold transition">
                <i class="fa-solid fa-plus mr-1"></i> Nuevo Producto
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
                            <th class="px-6 py-3 text-left text-xs font-semibold text-white uppercase tracking-wider">Categoría</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-white uppercase tracking-wider">Precio</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-white uppercase tracking-wider">Precio Venta</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-white uppercase tracking-wider">Stock</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-white uppercase tracking-wider">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-100">
                        @forelse($productos as $producto)
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-400 font-mono">{{ $producto->id }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold text-gray-900">{{ $producto->nombre }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">{{ $producto->categoria->nombre }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">${{ number_format($producto->precio, 2) }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">${{ number_format($producto->precio_venta, 2) }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{ $producto->stock }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm flex items-center gap-4">
                                <a href="{{ route('productos.edit', $producto) }}"
                                   class="text-[#3b4a67] hover:text-blue-700 font-semibold">
                                    <i class="fa-solid fa-pen-to-square mr-1"></i>Editar
                                </a>
                                <form action="{{ route('productos.destroy', $producto) }}" method="POST"
                                      onsubmit="return confirm('¿Eliminar este producto?')">
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
                                No hay productos registrados.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>

                <div class="px-6 py-4 border-t border-gray-100">
                    {{ $productos->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
