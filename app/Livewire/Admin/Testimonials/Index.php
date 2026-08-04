<?php

namespace App\Livewire\Admin\Testimonials;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use App\Models\Testimonial;

#[Layout('components.layouts.admin')]
#[Title('Testimoni - Admin OMH Vector')]
class Index extends Component
{
    use WithPagination;

    public $search = '';

    public function delete($id)
    {
        $item = Testimonial::findOrFail($id);
        $item->delete();
        session()->flash('success', 'Testimoni berhasil dihapus.');
    }

    public function render()
    {
        return view('livewire.admin.testimonials.index', [
            'items' => Testimonial::when($this->search, fn($q) => $q->where('name', 'like', '%'.$this->search.'%'))
                ->orderBy('created_at', 'desc')->paginate(10),
        ]);
    }
}
