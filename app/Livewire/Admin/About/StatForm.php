<?php

declare(strict_types=1);

namespace App\Livewire\Admin\About;

use App\Models\AboutStat;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('components.layouts.admin')]
#[Title('Form Statistik - Admin OMAH Vector')]
class StatForm extends Component
{
    public ?int $itemId = null;

    public string $label = '';

    public string $value = '';

    public int $sort_order = 0;

    public bool $is_active = true;

    public bool $isEditing = false;

    public function mount(?int $stat = null): void
    {
        if ($stat) {
            $this->isEditing = true;
            $item = AboutStat::findOrFail($stat);
            $this->itemId = $item->id;
            $this->label = $item->label;
            $this->value = $item->value;
            $this->sort_order = $item->sort_order;
            $this->is_active = $item->is_active;
        }
    }

    public function save(): mixed
    {
        $this->validate([
            'label' => 'required|string|max:100',
            'value' => 'required|string|max:50',
            'sort_order' => 'integer|min:0',
            'is_active' => 'boolean',
        ]);

        $item = $this->isEditing ? AboutStat::findOrFail($this->itemId) : new AboutStat;

        $item->label = $this->label;
        $item->value = $this->value;
        $item->sort_order = $this->sort_order;
        $item->is_active = $this->is_active;
        $item->save();

        session()->flash('success', $this->isEditing ? 'Statistik berhasil diperbarui.' : 'Statistik berhasil ditambahkan.');

        return $this->redirect(route('admin.about.stats.index'), navigate: true);
    }

    public function render(): View
    {
        return view('livewire.admin.about.stat-form');
    }
}
