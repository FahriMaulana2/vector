<?php

declare(strict_types=1);

namespace App\Livewire\Admin\Marketplaces;

use App\Models\Marketplace;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;

class Index extends Component
{
    public $showDeleteModal = false;

    public $marketplaceId;

    // Delete Properties
    public $deletingStoreName = '';

    public $deletingCampaignCount = 0;

    // Filter & Search
    public $search = '';

    public $statusFilter = '';

    public $availablePlatforms = [];

    // Form fields
    public $platform = '';

    public $store_name = '';

    public $store_url = '';

    public $display_order = 0;

    public $is_active = true;

    public $maintenance_message = '';

    public $logo = null;

    public function mount()
    {
        $this->availablePlatforms = Marketplace::getAvailablePlatforms();
    }

    public function render()
    {
        $query = Marketplace::query();

        if ($this->search) {
            $query->where(function ($q) {
                $q->where('store_name', 'like', '%'.$this->search.'%')
                    ->orWhere('platform', 'like', '%'.$this->search.'%');
            });
        }

        if ($this->statusFilter === 'active') {
            $query->where('is_active', true);
        } elseif ($this->statusFilter === 'maintenance') {
            $query->where('is_active', false);
        }

        $marketplaces = $query->orderBy('display_order')->orderBy('id', 'desc')->get();

        return view('livewire.admin.marketplaces.index', [
            'marketplaces' => $marketplaces,
        ])->layout('components.layouts.admin');
    }

    public function toggleStatus($id)
    {
        $marketplace = Marketplace::findOrFail($id);
        $marketplace->update(['is_active' => ! $marketplace->is_active]);

        session()->flash('success', 'Status marketplace berhasil diubah.');
    }

    public function confirmDelete($id)
    {
        $marketplace = Marketplace::findOrFail($id);
        $this->marketplaceId = $id;
        $this->deletingStoreName = $marketplace->store_name;
        $this->deletingCampaignCount = $marketplace->popupCampaigns()->count();
        $this->showDeleteModal = true;
    }

    public function closeDeleteModal()
    {
        $this->showDeleteModal = false;
        $this->resetDeleteProperties();
    }

    public function delete()
    {
        $marketplace = Marketplace::findOrFail($this->marketplaceId);

        if ($marketplace->logo_url) {
            Storage::disk('public')->delete($marketplace->logo_url);
        }

        $marketplace->delete();

        $this->closeDeleteModal();
        session()->flash('success', 'Marketplace berhasil dihapus.');
    }

    private function resetDeleteProperties()
    {
        $this->reset(['marketplaceId', 'deletingStoreName', 'deletingCampaignCount']);
    }

    protected function rules()
    {
        $unique = 'unique:marketplaces,platform';
        if ($this->marketplaceId) {
            $unique .= ','.$this->marketplaceId;
        }

        return [
            'platform' => 'required|string|'.$unique,
            'store_name' => 'required|string',
            'store_url' => 'nullable|url',
            'display_order' => 'nullable|integer',
            'is_active' => 'boolean',
            'maintenance_message' => 'nullable|string',
        ];
    }

    public function save()
    {
        $this->validate();

        if ($this->marketplaceId) {
            $marketplace = Marketplace::findOrFail($this->marketplaceId);
            $marketplace->update([
                'platform' => $this->platform,
                'store_name' => $this->store_name,
                'store_url' => $this->store_url,
                'display_order' => $this->display_order,
                'is_active' => $this->is_active,
                'maintenance_message' => $this->maintenance_message,
            ]);
            session()->flash('success', 'Marketplace berhasil diperbarui.');
        } else {
            Marketplace::create([
                'platform' => $this->platform,
                'store_name' => $this->store_name,
                'store_url' => $this->store_url,
                'display_order' => $this->display_order,
                'is_active' => $this->is_active,
                'maintenance_message' => $this->maintenance_message,
            ]);
            session()->flash('success', 'Marketplace berhasil dibuat.');
        }

        $this->reset(['platform', 'store_name', 'store_url', 'display_order', 'is_active', 'maintenance_message', 'marketplaceId']);
    }

    public function edit($id)
    {
        $marketplace = Marketplace::findOrFail($id);
        $this->marketplaceId = $id;
        $this->platform = $marketplace->platform;
        $this->store_name = $marketplace->store_name;
        $this->store_url = $marketplace->store_url;
        $this->display_order = $marketplace->display_order;
        $this->is_active = $marketplace->is_active;
        $this->maintenance_message = $marketplace->maintenance_message;
    }
}
