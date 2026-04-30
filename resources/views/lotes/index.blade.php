<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <div class="flex items-center gap-3">
                <i class="fa-solid fa-boxes-stacked text-[#fbbf24]"></i>
                <h2 class="font-semibold text-xl text-white leading-tight">Lotes</h2>
            </div>
            <a href="{{ route('lotes.create') }}"
               class="bg-blue-500 hover:bg-blue-400 text-white px-4 py-2 rounded-md text-sm font-semibold transition">
                <i class="fa-solid fa-plus mr-1"></i> Nuevo Lote
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

            <livewire:buscador-lotes />

        </div>
    </div>
</x-app-layout>
