<?php

namespace App\Livewire\Admin\Services;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use App\Models\Service;

#[Layout('components.layouts.admin')]
#[Title('Layanan - Admin OMH Vector')]
class Index extends Component
{
    use WithPagination;

    public $search = '';

    public function delete($id)
    {
        $item = Service::findOrFail($id);
        $item->delete();
        session()->flash('success', 'Layanan berhasil dihapus.');
    }

    public function render()
    {
        return view('livewire.admin.services.index', [
            'items' => Service::when($this->search, fn($q) => $q->where('name', 'like', '%'.$this->search.'%'))
                ->orderBy('name')->paginate(10),
        ]);
    }
}
