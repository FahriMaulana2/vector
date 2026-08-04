<?php

namespace App\Livewire\Admin\About;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use App\Models\AboutSection;

#[Layout('components.layouts.admin')]
#[Title('Tentang Kami - Admin OMH Vector')]
class Index extends Component
{
    use WithPagination;

    public function delete($id)
    {
        $item = AboutSection::findOrFail($id);
        $item->delete();
        session()->flash('success', 'Tentang kami berhasil dihapus.');
    }

    public function render()
    {
        return view('livewire.admin.about.index', [
            'items' => AboutSection::orderBy('created_at', 'desc')->paginate(10),
        ]);
    }
}
