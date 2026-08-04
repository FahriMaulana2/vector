<?php

namespace App\Livewire\Admin\PortfolioCategories;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use App\Models\PortfolioCategory;

#[Layout('components.layouts.admin')]
#[Title('Form Kategori Portofolio - Admin OMH Vector')]
class Form extends Component
{
    public $itemId = null;
    public $name = '';
    public $slug = '';
    public $description = '';
    public $is_active = true;
    public $isEditing = false;

    public function mount($portfolioCategory = null)
    {
        if ($portfolioCategory) {
            $this->isEditing = true;
            $item = PortfolioCategory::findOrFail($portfolioCategory);
            $this->itemId = $item->id;
            $this->name = $item->name;
            $this->slug = $item->slug;
            $this->description = $item->description;
            $this->is_active = $item->is_active;
        }
    }

    public function save()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:portfolio_categories,slug,' . $this->itemId,
            'description' => 'nullable|string',
            'is_active' => 'boolean',
        ]);

        $item = $this->isEditing ? PortfolioCategory::findOrFail($this->itemId) : new PortfolioCategory();
        $item->name = $this->name;
        $item->slug = $this->slug ?: \Illuminate\Support\Str::slug($this->name);
        $item->description = $this->description;
        $item->is_active = $this->is_active;
        $item->save();

        session()->flash('success', $this->isEditing ? 'Kategori berhasil diperbarui.' : 'Kategori berhasil ditambahkan.');
        return $this->redirect(route('admin.portfolio-categories.index'), navigate: true);
    }

    public function render()
    {
        return view('livewire.admin.portfolio-categories.form');
    }
}
