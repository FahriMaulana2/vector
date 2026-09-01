<?php

namespace App\Livewire\Admin\Faqs;

use App\Models\Faq;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('components.layouts.admin')]
#[Title('Form FAQ - Admin OMAH Vector')]
class Form extends Component
{
    public $itemId = null;

    public $question = '';

    public $answer = '';

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
            $this->is_active = $item->is_active;
        }
    }

    public function save()
    {
        $this->validate([
            'question' => 'required|string|max:255',
            'answer' => 'required|string',
            'is_active' => 'boolean',
        ]);

        $item = $this->isEditing ? Faq::findOrFail($this->itemId) : new Faq;
        $item->question = $this->question;
        $item->answer = $this->answer;
        $item->is_active = $this->is_active;

        if (! $this->isEditing) {
            $item->sort_order = (Faq::max('sort_order') ?? 0) + 1;
        }

        $item->save();

        session()->flash('success', $this->isEditing ? 'FAQ berhasil diperbarui.' : 'FAQ berhasil ditambahkan.');

        return $this->redirect(route('admin.faqs.index'), navigate: true);
    }

    public function render()
    {
        return view('livewire.admin.faqs.form');
    }
}
