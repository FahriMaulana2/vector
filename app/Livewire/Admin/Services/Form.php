<?php

declare(strict_types=1);

namespace App\Livewire\Admin\Services;

use App\Models\Service;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithFileUploads;

#[Layout('components.layouts.admin')]
#[Title('Form Layanan - Admin OMAH Vector')]
class Form extends Component
{
    use WithFileUploads;

    public $itemId = null;

    public $title = ''; // ✅ UBAH dari $name

    public $description = '';

    public $icon;

    public $existing_icon = null;

    public $is_active = true;

    public $sort_order = 0; // ✅ TAMBAH

    public $isEditing = false;

    public function mount($service = null)
    {
        if ($service) {
            $this->isEditing = true;
            $item = Service::findOrFail($service);
            $this->itemId = $item->id;
            $this->title = $item->title; // ✅ UBAH dari $item->name
            $this->description = $item->description;
            $this->existing_icon = $item->icon;
            $this->is_active = $item->is_active;
            $this->sort_order = $item->sort_order ?? 0; // ✅ TAMBAH
        }
    }

    public function save()
    {
        $this->validate([
            'title' => 'required|string|max:255', // ✅ UBAH dari 'name'
            'description' => 'nullable|string',
            'icon' => 'nullable|image|max:1024',
            'is_active' => 'boolean',
            'sort_order' => 'nullable|integer|min:0', // ✅ TAMBAH
        ]);

        $item = $this->isEditing ? Service::findOrFail($this->itemId) : new Service;
        
        $item->title = $this->title; // ✅ UBAH dari $item->name
        $item->description = $this->description;
        $item->is_active = $this->is_active;
        $item->sort_order = $this->sort_order; // ✅ TAMBAH

        if ($this->icon) {
            // Hapus icon lama jika ada
            if ($this->isEditing && $this->existing_icon) {
                $oldPath = storage_path('app/public/' . $this->existing_icon);
                if (file_exists($oldPath)) {
                    unlink($oldPath);
                }
            }
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