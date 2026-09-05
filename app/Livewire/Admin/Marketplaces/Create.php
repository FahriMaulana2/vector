<?php

declare(strict_types=1);

namespace App\Livewire\Admin\Marketplaces;

use App\Models\Marketplace;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithFileUploads;

#[Layout('components.layouts.admin')]
#[Title('Tambah Marketplace')]
class Create extends Component
{
    use WithFileUploads;

    public $platform = '';

    public $store_name = '';

    public $store_url = '';

    public $logo;

    public $is_active = true;

    public $maintenance_message = '';

    public $display_order = 0;

    public $availablePlatforms = [];

    public function mount(): void
    {
        $this->availablePlatforms = Marketplace::getAvailablePlatforms();
    }

    public function save()
    {
        $this->validate([
            'platform' => 'required|string|unique:marketplaces,platform',
            'store_name' => 'required|string|max:255',
            'store_url' => 'nullable|url|max:255',
            'logo' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'is_active' => 'boolean',
            'maintenance_message' => 'nullable|string|max:500',
            'display_order' => 'nullable|integer|min:0',
        ]);

        $data = [
            'platform' => $this->platform,
            'store_name' => $this->store_name,
            'store_url' => $this->store_url,
            'is_active' => $this->is_active,
            'maintenance_message' => $this->maintenance_message,
            'display_order' => $this->display_order ?? 0,
        ];

        if ($this->logo) {
            $data['logo_url'] = $this->logo->store('marketplaces', 'public');
        }

        Marketplace::create($data);

        session()->flash('success', 'Marketplace berhasil ditambahkan.');

        return $this->redirect(route('admin.marketplaces.index'), navigate: true);
    }

    public function render()
    {
        return view('livewire.admin.marketplaces.create');
    }
}
