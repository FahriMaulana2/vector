<?php

declare(strict_types=1);

namespace App\Livewire\Admin\About;

use App\Models\AboutMilestone;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('components.layouts.admin')]
#[Title('Form Milestone - Admin OMAH Vector')]
class MilestoneForm extends Component
{
    public ?int $itemId = null;

    public int $year;

    public string $title = '';

    public string $description = '';

    public int $sort_order = 0;

    public bool $is_active = true;

    public bool $isEditing = false;

    public function mount(?int $milestone = null): void
    {
        $this->year = (int) now()->year;

        if ($milestone) {
            $this->isEditing = true;
            $item = AboutMilestone::findOrFail($milestone);
            $this->itemId = $item->id;
            $this->year = $item->year;
            $this->title = $item->title;
            $this->description = $item->description ?? '';
            $this->sort_order = $item->sort_order;
            $this->is_active = $item->is_active;
        }
    }

    public function save(): mixed
    {
        $this->validate([
            'year' => 'required|integer|min:1990|max:2100',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'sort_order' => 'integer|min:0',
            'is_active' => 'boolean',
        ]);

        $item = $this->isEditing ? AboutMilestone::findOrFail($this->itemId) : new AboutMilestone;

        $item->year = $this->year;
        $item->title = $this->title;
        $item->description = $this->description ?: null;
        $item->sort_order = $this->sort_order;
        $item->is_active = $this->is_active;
        $item->save();

        session()->flash('success', $this->isEditing ? 'Milestone berhasil diperbarui.' : 'Milestone berhasil ditambahkan.');

        return $this->redirect(route('admin.about.milestones.index'), navigate: true);
    }

    public function render(): View
    {
        return view('livewire.admin.about.milestone-form');
    }
}
