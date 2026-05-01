<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            Gestión de Usuarios
        </h2>
    </x-slot>

    <div class="p-8">
        <div class="bg-white rounded-xl shadow overflow-hidden">
            <table class="w-full text-sm">
                <thead>
                    <tr class="bg-[#3b4a67] text-white text-left">
                        <th class="px-6 py-3">#</th>
                        <th class="px-6 py-3">Nombre</th>
                        <th class="px-6 py-3">Correo</th>
                        <th class="px-6 py-3">Rol</th>
                        <th class="px-6 py-3">Registrado</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($users as $usuario)
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-6 py-4 text-gray-500">{{ $loop->iteration }}</td>
                            <td class="px-6 py-4 font-medium text-gray-800">{{ $usuario->name }}</td>
                            <td class="px-6 py-4 text-gray-600">{{ $usuario->email }}</td>
                            <td class="px-6 py-4">
                                @if($usuario->role === 'admin')
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-[#3b4a67] text-white">
                                        Admin
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-gray-200 text-gray-700">
                                        Operario
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-gray-500">{{ $usuario->created_at->format('d/m/Y') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-8 text-center text-gray-400">
                                No hay usuarios registrados.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
