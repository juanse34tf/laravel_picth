<?php

namespace App\Livewire;

use App\Models\Lote;
use Livewire\Component;
use Livewire\WithPagination;

class BuscadorLotes extends Component
{
    use WithPagination;

    public string $search = '';

    public function updatingSearch(): void
    {
        $this->resetPage();
    }

    public function render()
    {
        $lotes = Lote::where('estado', 'like', '%' . $this->search . '%')
            ->orWhere('fecha_inicio', 'like', '%' . $this->search . '%')
            ->orderBy('id', 'desc')
            ->paginate(10);

        return view('livewire.buscador-lotes', compact('lotes'));
    }
}
