<?php

namespace App\Livewire\Admin\Services;

use App\Models\Service;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithFileUploads;

#[Layout('components.layouts.admin')]
#[Title('Form Layanan - Admin OMH Vector')]
class Form extends Component
{
    use WithFileUploads;

    public $itemId = null;

    public $name = '';

    public $description = '';

    public $icon;

    public $existing_icon = null;

    public $is_active = true;

    public $isEditing = false;

    public function mount($service = null)
    {
        if ($service) {
            $this->isEditing = true;
            $item = Service::findOrFail($service);
            $this->itemId = $item->id;
            $this->name = $item->name;
            $this->description = $item->description;
            $this->existing_icon = $item->icon;
            $this->is_active = $item->is_active;
        }
    }

    public function save()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'icon' => 'nullable|image|max:1024',
            'is_active' => 'boolean',
        ]);

        $item = $this->isEditing ? Service::findOrFail($this->itemId) : new Service;
        $item->name = $this->name;
        $item->description = $this->description;
        $item->is_active = $this->is_active;

        if ($this->icon) {
            $item->icon = $this->icon->store('services', 'public');
        }

        $item->save();

        session()->flash('success', $this->isEditing ? 'Layanan berhasil diperbarui.' : 'Layanan berhasil ditambahkan.');

        return $this->redirect(route('admin.services.index'), navigate: true);
    }

    public function render()
    {
        return view('livewire.admin.services.form');
    }
}
