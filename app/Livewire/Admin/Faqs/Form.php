<?php

namespace App\Livewire\Admin\Faqs;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use App\Models\Faq;

#[Layout('components.layouts.admin')]
#[Title('Form FAQ - Admin OMH Vector')]
class Form extends Component
{
    public $itemId = null;
    public $question = '';
    public $answer = '';
    public $order = 0;
    public $is_active = true;
    public $isEditing = false;

    public function mount($faq = null)
    {
        if ($faq) {
            $this->isEditing = true;
            $item = Faq::findOrFail($faq);
            $this->itemId = $item->id;
            $this->question = $item->question;
            $this->answer = $item->answer;
            $this->order = $item->order;
            $this->is_active = $item->is_active;
        }
    }

    public function save()
    {
        $this->validate([
            'question' => 'required|string|max:255',
            'answer' => 'required|string',
            'order' => 'integer|min:0',
            'is_active' => 'boolean',
        ]);

        $item = $this->isEditing ? Faq::findOrFail($this->itemId) : new Faq();
        $item->question = $this->question;
        $item->answer = $this->answer;
        $item->order = $this->order;
        $item->is_active = $this->is_active;
        $item->save();

        session()->flash('success', $this->isEditing ? 'FAQ berhasil diperbarui.' : 'FAQ berhasil ditambahkan.');
        return $this->redirect(route('admin.faqs.index'), navigate: true);
    }

    public function render()
    {
        return view('livewire.admin.faqs.form');
    }
}
