<?php

namespace App\Livewire\Admin\Faqs;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use App\Models\Faq;

#[Layout('components.layouts.admin')]
#[Title('FAQ - Admin OMH Vector')]
class Index extends Component
{
    use WithPagination;

    public $search = '';

    public function delete($id)
    {
        $item = Faq::findOrFail($id);
        $item->delete();
        session()->flash('success', 'FAQ berhasil dihapus.');
    }

    public function render()
    {
        return view('livewire.admin.faqs.index', [
            'items' => Faq::when($this->search, fn($q) => $q->where('question', 'like', '%'.$this->search.'%'))
                ->orderBy('order')->paginate(10),
        ]);
    }
}
