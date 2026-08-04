<?php

namespace App\Livewire\Admin\ContactMessages;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use App\Models\ContactMessage;

#[Layout('components.layouts.admin')]
#[Title('Pesan Masuk - Admin OMH Vector')]
class Index extends Component
{
    use WithPagination;

    public $search = '';
    public $status = '';

    public function render()
    {
        return view('livewire.admin.contact-messages.index', [
            'items' => ContactMessage::when($this->search, fn($q) => $q->where(function($q) {
                    $q->where('name', 'like', '%'.$this->search.'%')
                      ->orWhere('email', 'like', '%'.$this->search.'%');
                }))
                ->when($this->status, fn($q) => $q->where('status', $this->status))
                ->latest()
                ->paginate(10),
        ]);
    }
}
