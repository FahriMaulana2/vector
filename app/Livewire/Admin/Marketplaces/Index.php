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

        // Cache akan otomatis ter-clear berkat method booted() di Model Marketplace
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
}
