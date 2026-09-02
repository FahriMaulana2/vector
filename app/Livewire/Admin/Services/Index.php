<?php

namespace App\Livewire\Admin\Services;

use App\Models\Service;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('components.layouts.admin')]
#[Title('Layanan - Admin OMAH Vector')]
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
            'items' => Service::when($this->search, fn ($q) => $q->where('title', 'like', '%'.$this->search.'%'))
                ->orderBy('sort_order')
                ->orderBy('title')
                ->paginate(10),
        ]);
    }
}
