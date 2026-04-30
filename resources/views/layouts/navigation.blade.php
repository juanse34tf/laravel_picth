<aside class="fixed top-0 left-0 h-full w-64 bg-[#1e293b] flex flex-col z-50 overflow-y-auto">

    {{-- Logo --}}
    <div class="px-6 py-6 border-b border-slate-700">
        <div class="flex items-center gap-3">
            <i class="fa-solid fa-egg text-yellow-400 text-3xl"></i>
            <span class="text-white text-2xl font-bold tracking-wide">Gallinas</span>
        </div>
    </div>

    {{-- Perfil --}}
    <div class="px-6 py-4 border-b border-slate-700">
        <div class="flex items-center gap-3">
            <div class="w-10 h-10 rounded-full bg-slate-500 flex items-center justify-center shrink-0">
                <i class="fa-solid fa-user text-white text-sm"></i>
            </div>
            <div>
                <p class="text-white text-sm font-semibold leading-tight">{{ Auth::user()->name }}</p>
                <span class="inline-block mt-1 text-xs text-blue-200 bg-blue-900 px-2 py-0.5 rounded-full">
                    Administrador
                </span>
            </div>
        </div>
    </div>

    {{-- Navegación --}}
    <nav class="flex-1 px-3 py-5 space-y-1">
        <a href="{{ route('dashboard') }}"
           class="flex items-center gap-3 px-4 py-2.5 rounded-lg text-sm font-medium transition-colors
                  {{ request()->routeIs('dashboard') ? 'bg-slate-700 text-white' : 'text-slate-300 hover:bg-slate-700 hover:text-white' }}">
            <i class="fa-solid fa-chart-line w-5 text-center"></i>
            Dashboard
        </a>
        <a href="{{ route('categorias.index') }}"
           class="flex items-center gap-3 px-4 py-2.5 rounded-lg text-sm font-medium transition-colors
                  {{ request()->routeIs('categorias.*') ? 'bg-slate-700 text-white' : 'text-slate-300 hover:bg-slate-700 hover:text-white' }}">
            <i class="fa-solid fa-tags w-5 text-center"></i>
            Categorías
        </a>
        <a href="{{ route('productos.index') }}"
           class="flex items-center gap-3 px-4 py-2.5 rounded-lg text-sm font-medium transition-colors
                  {{ request()->routeIs('productos.*') ? 'bg-slate-700 text-white' : 'text-slate-300 hover:bg-slate-700 hover:text-white' }}">
            <i class="fa-solid fa-box w-5 text-center"></i>
            Productos
        </a>
        <a href="{{ route('lotes.index') }}"
           class="flex items-center gap-3 px-4 py-2.5 rounded-lg text-sm font-medium transition-colors
                  {{ request()->routeIs('lotes.*') ? 'bg-slate-700 text-white' : 'text-slate-300 hover:bg-slate-700 hover:text-white' }}">
            <i class="fa-solid fa-boxes-stacked w-5 text-center"></i>
            Lotes
        </a>
        <a href="{{ route('produccion.index') }}"
           class="flex items-center gap-3 px-4 py-2.5 rounded-lg text-sm font-medium transition-colors
                  {{ request()->routeIs('produccion.*') ? 'bg-slate-700 text-white' : 'text-slate-300 hover:bg-slate-700 hover:text-white' }}">
            <i class="fa-solid fa-egg w-5 text-center"></i>
            Producción
        </a>
    </nav>

    {{-- Mi Perfil y Cerrar Sesión --}}
    <div class="px-3 py-4 border-t border-slate-700 space-y-1">
        <a href="{{ route('profile.edit') }}"
           class="flex items-center gap-3 px-4 py-2.5 rounded-lg text-sm font-medium text-slate-300 hover:bg-slate-700 hover:text-white transition-colors">
            <i class="fa-solid fa-user-gear w-5 text-center"></i>
            Mi Perfil
        </a>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit"
                class="w-full flex items-center gap-3 px-4 py-2.5 rounded-lg text-sm font-medium text-slate-300 hover:bg-red-700 hover:text-white transition-colors">
                <i class="fa-solid fa-right-from-bracket w-5 text-center"></i>
                Cerrar Sesión
            </button>
        </form>
    </div>

</aside>
