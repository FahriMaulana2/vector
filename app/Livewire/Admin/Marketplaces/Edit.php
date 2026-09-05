<?php

declare(strict_types=1);

namespace App\Livewire\Admin\Marketplaces;

use App\Models\Marketplace;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithFileUploads;

#[Layout('components.layouts.admin')]
#[Title('Edit Marketplace')]
class Edit extends Component
{
    use WithFileUploads;

    public Marketplace $marketplace;

    public $platform = '';

    public $store_name = '';

    public $store_url = '';

    public $logo;

    public $existing_logo_url = '';

    public $is_active = true;

    public $maintenance_message = '';

    public $display_order = 0;

    public $availablePlatforms = [];

    public function mount(Marketplace $marketplace): void
    {
        $this->marketplace = $marketplace;
        $this->availablePlatforms = Marketplace::getAvailablePlatforms();

        $this->platform = $marketplace->platform;
        $this->store_name = $marketplace->store_name;
        $this->store_url = $marketplace->store_url ?? '';
        $this->existing_logo_url = $marketplace->logo_url ?? '';
        $this->is_active = (bool) $marketplace->is_active;
        $this->maintenance_message = $marketplace->maintenance_message ?? '';
        $this->display_order = $marketplace->display_order ?? 0;
    }

    public function save()
    {
        $this->validate([
            'platform' => 'required|string|unique:marketplaces,platform,'.$this->marketplace->id,
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
            // Upload logo baru terlebih dahulu
            $newLogoPath = $this->logo->store('marketplaces', 'public');

            // Setelah upload berhasil, hapus logo lama
            if ($this->existing_logo_url && Storage::disk('public')->exists($this->existing_logo_url)) {
                Storage::disk('public')->delete($this->existing_logo_url);
            }

            $data['logo_url'] = $newLogoPath;
        }

        $this->marketplace->update($data);

        session()->flash('success', 'Marketplace berhasil diperbarui.');

        return $this->redirect(route('admin.marketplaces.index'), navigate: true);
    }

    public function render()
    {
        return view('livewire.admin.marketplaces.edit');
    }
}
