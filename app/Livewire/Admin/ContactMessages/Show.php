<?php

namespace App\Livewire\Admin\ContactMessages;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use App\Models\ContactMessage;

#[Layout('components.layouts.admin')]
#[Title('Detail Pesan - Admin OMH Vector')]
class Show extends Component
{
    public ContactMessage $message;

    public function mount($contactMessage)
    {
        $this->message = ContactMessage::findOrFail($contactMessage);
        if ($this->message->isUnread()) {
            $this->message->markAsRead();
        }
    }

    public function render()
    {
        return view('livewire.admin.contact-messages.show');
    }
}
