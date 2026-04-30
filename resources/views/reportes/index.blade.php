<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-3">
            <i class="fa-solid fa-chart-bar text-[#fbbf24]"></i>
            <h2 class="font-semibold text-xl text-white leading-tight">Reportes del Sistema</h2>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            {{-- Tarjetas de resumen --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">

                <div class="bg-white rounded-xl shadow-sm p-5 flex items-center gap-4">
                    <div class="w-12 h-12 rounded-full bg-green-100 flex items-center justify-center shrink-0">
                        <i class="fa-solid fa-sack-dollar text-green-600 text-lg"></i>
                    </div>
                    <div>
                        <p class="text-xs text-gray-500 uppercase tracking-wide">Total Ventas</p>
                        <p class="text-xl font-bold text-gray-900">${{ number_format($totalVentas, 2) }}</p>
                    </div>
                </div>

                <div class="bg-white rounded-xl shadow-sm p-5 flex items-center gap-4">
                    <div class="w-12 h-12 rounded-full bg-red-100 flex items-center justify-center shrink-0">
                        <i class="fa-solid fa-receipt text-red-500 text-lg"></i>
                    </div>
                    <div>
                        <p class="text-xs text-gray-500 uppercase tracking-wide">Total Gastos</p>
                        <p class="text-xl font-bold text-gray-900">${{ number_format($totalGastos, 2) }}</p>
                    </div>
                </div>

                <div class="bg-white rounded-xl shadow-sm p-5 flex items-center gap-4">
                    <div class="w-12 h-12 rounded-full bg-yellow-100 flex items-center justify-center shrink-0">
                        <i class="fa-solid fa-wheat-awn text-yellow-600 text-lg"></i>
                    </div>
                    <div>
                        <p class="text-xs text-gray-500 uppercase tracking-wide">Alimento Usado</p>
                        <p class="text-xl font-bold text-gray-900">{{ number_format($totalAlimento, 2) }} kg</p>
                    </div>
                </div>

                <div class="bg-white rounded-xl shadow-sm p-5 flex items-center gap-4">
                    <div class="w-12 h-12 rounded-full bg-blue-100 flex items-center justify-center shrink-0">
                        <i class="fa-solid fa-egg text-blue-600 text-lg"></i>
                    </div>
                    <div>
                        <p class="text-xs text-gray-500 uppercase tracking-wide">Huevos Producidos</p>
                        <p class="text-xl font-bold text-gray-900">{{ number_format($totalProduccion) }}</p>
                    </div>
                </div>

            </div>

            {{-- Fila inferior: dos tablas --}}
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

                {{-- Ventas por mes --}}
                <div class="bg-white rounded-xl shadow-sm overflow-hidden">
                    <div class="bg-[#3b4a67] px-6 py-3">
                        <h3 class="text-sm font-semibold text-white uppercase tracking-wider">
                            <i class="fa-solid fa-calendar-days mr-2"></i>Ventas por Mes
                        </h3>
                    </div>
                    <table class="min-w-full divide-y divide-gray-100">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Mes</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Total</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @forelse($ventasPorMes as $fila)
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-3 text-sm text-gray-700">{{ $fila->mes }}</td>
                                <td class="px-6 py-3 text-sm font-semibold text-gray-900">${{ number_format($fila->total, 2) }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="2" class="px-6 py-6 text-center text-sm text-gray-400">Sin ventas registradas.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                {{-- Producción por tipo de huevo --}}
                <div class="bg-white rounded-xl shadow-sm overflow-hidden">
                    <div class="bg-[#3b4a67] px-6 py-3">
                        <h3 class="text-sm font-semibold text-white uppercase tracking-wider">
                            <i class="fa-solid fa-egg mr-2"></i>Producción por Tipo de Huevo
                        </h3>
                    </div>
                    <table class="min-w-full divide-y divide-gray-100">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Tipo</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Unidades</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @forelse($produccionPorTipo as $fila)
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-3 text-sm text-gray-700">{{ $fila->tipo_huevo }}</td>
                                <td class="px-6 py-3 text-sm font-semibold text-gray-900">{{ number_format($fila->total) }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="2" class="px-6 py-6 text-center text-sm text-gray-400">Sin producción registrada.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

            </div>

            {{-- Balance general --}}
            <div class="bg-white rounded-xl shadow-sm px-6 py-5 flex flex-wrap items-center justify-between gap-4">
                <div class="flex items-center gap-3">
                    <i class="fa-solid fa-scale-balanced text-[#3b4a67] text-xl"></i>
                    <span class="text-sm font-semibold text-gray-600">Balance (Ventas − Gastos)</span>
                </div>
                @php $balance = $totalVentas - $totalGastos; @endphp
                <span class="text-2xl font-bold {{ $balance >= 0 ? 'text-green-600' : 'text-red-600' }}">
                    ${{ number_format($balance, 2) }}
                </span>
            </div>

        </div>
    </div>
</x-app-layout>
