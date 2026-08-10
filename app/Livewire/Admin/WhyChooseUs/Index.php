<?php

namespace App\Livewire\Admin\WhyChooseUs;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use App\Models\WhyChooseUs;

#[Layout('components.layouts.admin')]
#[Title('Mengapa Memilih Kami - Admin OMH Vector')]
class Index extends Component
{
    use WithPagination;

    public $search = '';

    public function delete($id)
    {
        $item = WhyChooseUs::findOrFail($id);
        $item->delete();
        session()->flash('success', 'Data berhasil dihapus.');
    }

    public function render()
    {
        return view('livewire.admin.why-choose-us.index', [
            'items' => WhyChooseUs::when($this->search, fn($q) => $q->where('title', 'like', '%'.$this->search.'%'))
                ->orderBy('sort_order') // ✅ PERBAIKAN: 'order' diganti menjadi 'sort_order'
                ->orderBy('title')
                ->paginate(10),
        ]);
    }
}