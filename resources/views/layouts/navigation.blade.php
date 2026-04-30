<aside class="fixed top-0 left-0 h-full w-64 bg-[#3b4a67] flex flex-col z-50 overflow-y-auto">

    {{-- Brand / Logo --}}
    <div class="px-6 py-6 border-b border-[#2f3c55]">
        <div class="flex items-center gap-3">
            <i class="fa-solid fa-egg text-[#fbbf24] text-3xl"></i>
            <span class="font-poppins font-bold text-white text-2xl tracking-wide">Gallinas</span>
        </div>
    </div>

    {{-- Perfil de usuario --}}
    <div class="px-5 py-4 border-b border-[#2f3c55]">
        <div class="flex items-center gap-3">
            <div class="w-10 h-10 rounded-full bg-[#4d5e7e] flex items-center justify-center shrink-0">
                <i class="fa-solid fa-user text-gray-200 text-sm"></i>
            </div>
            <div>
                <p class="text-white text-sm font-semibold leading-tight truncate max-w-[120px]">
                    {{ Auth::user()->name }}
                </p>
                <span class="inline-block mt-1 text-xs font-medium text-blue-200 bg-[#2f3c55] px-2 py-0.5 rounded-full">
                    Administrador
                </span>
            </div>
        </div>
    </div>

    {{-- Menú de navegación --}}
    <nav class="flex-1 px-3 py-4 space-y-0.5 overflow-y-auto">

        <a href="{{ route('dashboard') }}"
           class="flex items-center gap-3 px-4 py-2.5 rounded-lg text-sm font-medium transition-colors
                  {{ request()->routeIs('dashboard') ? 'bg-[#2f3c55] text-white' : 'text-gray-300 hover:bg-[#2f3c55] hover:text-white' }}">
            <i class="fa-solid fa-chart-line w-5 text-center text-[#fbbf24]"></i>
            Dashboard
        </a>

        {{-- Separador --}}
        <p class="px-4 pt-3 pb-1 text-xs font-semibold text-gray-400 uppercase tracking-wider">Inventario</p>

        <a href="{{ route('categorias.index') }}"
           class="flex items-center gap-3 px-4 py-2.5 rounded-lg text-sm font-medium transition-colors
                  {{ request()->routeIs('categorias.*') ? 'bg-[#2f3c55] text-white' : 'text-gray-300 hover:bg-[#2f3c55] hover:text-white' }}">
            <i class="fa-solid fa-tags w-5 text-center text-[#fbbf24]"></i>
            Categorías
        </a>
        <a href="{{ route('productos.index') }}"
           class="flex items-center gap-3 px-4 py-2.5 rounded-lg text-sm font-medium transition-colors
                  {{ request()->routeIs('productos.*') ? 'bg-[#2f3c55] text-white' : 'text-gray-300 hover:bg-[#2f3c55] hover:text-white' }}">
            <i class="fa-solid fa-box w-5 text-center text-[#fbbf24]"></i>
            Productos
        </a>

        {{-- Separador --}}
        <p class="px-4 pt-3 pb-1 text-xs font-semibold text-gray-400 uppercase tracking-wider">Producción</p>

        <a href="{{ route('lotes.index') }}"
           class="flex items-center gap-3 px-4 py-2.5 rounded-lg text-sm font-medium transition-colors
                  {{ request()->routeIs('lotes.*') ? 'bg-[#2f3c55] text-white' : 'text-gray-300 hover:bg-[#2f3c55] hover:text-white' }}">
            <i class="fa-solid fa-boxes-stacked w-5 text-center text-[#fbbf24]"></i>
            Lotes
        </a>
        <a href="{{ route('produccion.index') }}"
           class="flex items-center gap-3 px-4 py-2.5 rounded-lg text-sm font-medium transition-colors
                  {{ request()->routeIs('produccion.*') ? 'bg-[#2f3c55] text-white' : 'text-gray-300 hover:bg-[#2f3c55] hover:text-white' }}">
            <i class="fa-solid fa-egg w-5 text-center text-[#fbbf24]"></i>
            Producción
        </a>
        <a href="{{ route('alimentacion.index') }}"
           class="flex items-center gap-3 px-4 py-2.5 rounded-lg text-sm font-medium transition-colors
                  {{ request()->routeIs('alimentacion.*') ? 'bg-[#2f3c55] text-white' : 'text-gray-300 hover:bg-[#2f3c55] hover:text-white' }}">
            <i class="fa-solid fa-wheat-awn w-5 text-center text-[#fbbf24]"></i>
            Alimentación
        </a>

        {{-- Separador --}}
        <p class="px-4 pt-3 pb-1 text-xs font-semibold text-gray-400 uppercase tracking-wider">Finanzas</p>

        <a href="{{ route('ventas.index') }}"
           class="flex items-center gap-3 px-4 py-2.5 rounded-lg text-sm font-medium transition-colors
                  {{ request()->routeIs('ventas.*') ? 'bg-[#2f3c55] text-white' : 'text-gray-300 hover:bg-[#2f3c55] hover:text-white' }}">
            <i class="fa-solid fa-cart-shopping w-5 text-center text-[#fbbf24]"></i>
            Ventas
        </a>
        <a href="{{ route('gastos.index') }}"
           class="flex items-center gap-3 px-4 py-2.5 rounded-lg text-sm font-medium transition-colors
                  {{ request()->routeIs('gastos.*') ? 'bg-[#2f3c55] text-white' : 'text-gray-300 hover:bg-[#2f3c55] hover:text-white' }}">
            <i class="fa-solid fa-receipt w-5 text-center text-[#fbbf24]"></i>
            Gastos
        </a>
        <a href="{{ route('reportes.index') }}"
           class="flex items-center gap-3 px-4 py-2.5 rounded-lg text-sm font-medium transition-colors
                  {{ request()->routeIs('reportes.*') ? 'bg-[#2f3c55] text-white' : 'text-gray-300 hover:bg-[#2f3c55] hover:text-white' }}">
            <i class="fa-solid fa-chart-bar w-5 text-center text-[#fbbf24]"></i>
            Reportes
        </a>

    </nav>

    {{-- Acciones de cuenta --}}
    <div class="px-3 py-4 border-t border-[#2f3c55] space-y-0.5">
        <a href="{{ route('profile.edit') }}"
           class="flex items-center gap-3 px-4 py-2.5 rounded-lg text-sm font-medium text-gray-300 hover:bg-[#2f3c55] hover:text-white transition-colors">
            <i class="fa-solid fa-user-gear w-5 text-center text-[#fbbf24]"></i>
            Mi Perfil
        </a>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit"
                class="w-full flex items-center gap-3 px-4 py-2.5 rounded-lg text-sm font-medium text-gray-300 hover:bg-red-700 hover:text-white transition-colors">
                <i class="fa-solid fa-right-from-bracket w-5 text-center"></i>
                Cerrar Sesión
            </button>
        </form>
    </div>

</aside>
