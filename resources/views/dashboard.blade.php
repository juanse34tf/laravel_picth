<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            Dashboard
        </h2>
    </x-slot>

    <div class="p-8 space-y-8">

        {{-- ── Tarjetas resumen ───────────────────────────────────────────── --}}
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">

            <div class="bg-white rounded-xl shadow p-6 flex items-center gap-5">
                <div class="w-14 h-14 rounded-full bg-[#eef0f5] flex items-center justify-center shrink-0">
                    <i class="fa-solid fa-egg text-[#3b4a67] text-2xl"></i>
                </div>
                <div>
                    <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider">Huevos esta semana</p>
                    <p class="text-3xl font-bold text-[#3b4a67]">{{ number_format($totalSemana) }}</p>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow p-6 flex items-center gap-5">
                <div class="w-14 h-14 rounded-full bg-[#fef9ec] flex items-center justify-center shrink-0">
                    <i class="fa-solid fa-boxes-stacked text-[#fbbf24] text-2xl"></i>
                </div>
                <div>
                    <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider">Lotes activos</p>
                    <p class="text-3xl font-bold text-[#fbbf24]">{{ $lotesActivos }}</p>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow p-6 flex items-center gap-5">
                <div class="w-14 h-14 rounded-full bg-[#eef0f5] flex items-center justify-center shrink-0">
                    <i class="fa-solid fa-chart-simple text-[#3b4a67] text-2xl"></i>
                </div>
                <div>
                    <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider">Total histórico</p>
                    <p class="text-3xl font-bold text-[#3b4a67]">{{ number_format($totalHistorico) }}</p>
                </div>
            </div>

        </div>

        {{-- ── Gráficos ───────────────────────────────────────────────────── --}}
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

            {{-- Línea: Tendencia últimos 7 días --}}
            <div class="bg-white rounded-xl shadow p-6">
                <h3 class="text-sm font-semibold text-gray-500 uppercase tracking-wider mb-4">
                    <i class="fa-solid fa-chart-line text-[#3b4a67] mr-2"></i>
                    Tendencia de Producción — últimos 7 días
                </h3>
                <canvas id="chartProduccion" height="110"></canvas>
            </div>

            {{-- Dona: Proporción por tipo de huevo --}}
            <div class="bg-white rounded-xl shadow p-6">
                <h3 class="text-sm font-semibold text-gray-500 uppercase tracking-wider mb-4">
                    <i class="fa-solid fa-circle-half-stroke text-[#fbbf24] mr-2"></i>
                    Proporción por Tipo de Huevo (histórico)
                </h3>
                <div class="flex justify-center">
                    <canvas id="chartHuevo" height="200" style="max-width:260px"></canvas>
                </div>
            </div>

        </div>

    </div>

    {{-- Chart.js CDN --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        // ── Gráfico de línea ─────────────────────────────────────────────────
        new Chart(document.getElementById('chartProduccion'), {
            type: 'line',
            data: {
                labels: {!! $labelsProduccion !!},
                datasets: [{
                    label: 'Huevos producidos',
                    data: {!! $datosProduccion !!},
                    borderColor: '#3b4a67',
                    backgroundColor: 'rgba(59, 74, 103, 0.10)',
                    pointBackgroundColor: '#fbbf24',
                    pointBorderColor: '#3b4a67',
                    pointRadius: 5,
                    tension: 0.4,
                    fill: true,
                    borderWidth: 2,
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: { display: false },
                    tooltip: { mode: 'index' }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: { color: 'rgba(0,0,0,0.05)' },
                        ticks: { color: '#6b7280' }
                    },
                    x: {
                        grid: { display: false },
                        ticks: { color: '#6b7280' }
                    }
                }
            }
        });

        // ── Gráfico de dona ──────────────────────────────────────────────────
        new Chart(document.getElementById('chartHuevo'), {
            type: 'doughnut',
            data: {
                labels: ['Tipo A', 'Tipo AA', 'Tipo AAA'],
                datasets: [{
                    data: {!! $datosHuevo !!},
                    backgroundColor: ['#3b4a67', '#fbbf24', '#4d5e7e'],
                    borderColor: '#ffffff',
                    borderWidth: 3,
                    hoverOffset: 6,
                }]
            },
            options: {
                responsive: true,
                cutout: '62%',
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            color: '#374151',
                            padding: 16,
                            font: { size: 13 }
                        }
                    }
                }
            }
        });
    </script>

</x-app-layout>
