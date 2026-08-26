<?php

namespace App\Livewire\Admin\Faqs;

use App\Models\Faq;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('components.layouts.admin')]
#[Title('FAQ - Admin OMH Vector')]
class Index extends Component
{
    use WithPagination;

    public $search = '';

    public function toggleActive($id)
    {
        $item = Faq::findOrFail($id);
        $item->is_active = ! $item->is_active;
        $item->save();

        session()->flash('success', 'Status FAQ berhasil diperbarui.');
    }

    public function delete($id)
    {
        $item = Faq::findOrFail($id);
        $item->delete();
        session()->flash('success', 'FAQ berhasil dihapus.');
    }

    public function render()
    {
        return view('livewire.admin.faqs.index', [
            'items' => Faq::when($this->search, fn ($q) => $q->where('question', 'like', '%'.$this->search.'%')
                ->orWhere('answer', 'like', '%'.$this->search.'%'))
                ->orderBy('sort_order')
                ->orderBy('created_at', 'desc')
                ->paginate(10),
        ]);
    }
}
