<?php

namespace App\Livewire\Admin\Portfolios;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use App\Models\Portfolio;

#[Layout('components.layouts.admin')]
#[Title('Portofolio - Admin OMH Vector')]
class Index extends Component
{
    use WithPagination;

    public $search = '';
    public $category_id = '';

    public function delete($id)
    {
        Portfolio::findOrFail($id)->delete();
        session()->flash('success', 'Portofolio berhasil dihapus.');
    }

    public function render()
    {
        return view('livewire.admin.portfolios.index', [
            'items' => Portfolio::with('category')
                ->when($this->search, fn($q) => $q->where('title', 'like', '%'.$this->search.'%'))
                ->when($this->category_id, fn($q) => $q->where('category_id', $this->category_id))
                ->orderBy('created_at', 'desc')->paginate(10),
            'categories' => \App\Models\PortfolioCategory::where('is_active', true)->orderBy('name')->get(),
        ]);
    }
}
