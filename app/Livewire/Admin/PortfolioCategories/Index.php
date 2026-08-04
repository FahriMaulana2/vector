<?php

namespace App\Livewire\Admin\PortfolioCategories;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use App\Models\PortfolioCategory;

#[Layout('components.layouts.admin')]
#[Title('Kategori Portofolio - Admin OMH Vector')]
class Index extends Component
{
    use WithPagination;

    public $search = '';

    public function delete($id)
    {
        PortfolioCategory::findOrFail($id)->delete();
        session()->flash('success', 'Kategori portofolio berhasil dihapus.');
    }

    public function render()
    {
        return view('livewire.admin.portfolio-categories.index', [
            'items' => PortfolioCategory::when($this->search, fn($q) => $q->where('name', 'like', '%'.$this->search.'%'))
                ->orderBy('name')->paginate(10),
        ]);
    }
}
