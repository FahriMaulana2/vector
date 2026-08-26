<?php

namespace App\Livewire\Admin\WhyChooseUs;

use App\Models\WhyChooseUs;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithFileUploads;

#[Layout('components.layouts.admin')]
#[Title('Form Mengapa Memilih Kami - Admin OMH Vector')]
class Form extends Component
{
    use WithFileUploads;

    public $itemId = null;

    public $title = '';

    public $description = '';

    public $icon;

    public $existing_icon = null;

    public $order = 0;

    public $is_active = true;

    public $isEditing = false;

    public function mount($whyChooseUs = null)
    {
        if ($whyChooseUs) {
            $this->isEditing = true;
            $item = WhyChooseUs::findOrFail($whyChooseUs);
            $this->itemId = $item->id;
            $this->title = $item->title;
            $this->description = $item->description;
            $this->existing_icon = $item->icon;
            $this->order = $item->order;
            $this->is_active = $item->is_active;
        }
    }

    public function save()
    {
        $this->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'icon' => 'nullable|image|max:1024',
            'order' => 'integer|min:0',
            'is_active' => 'boolean',
        ]);

        $item = $this->isEditing ? WhyChooseUs::findOrFail($this->itemId) : new WhyChooseUs;
        $item->title = $this->title;
        $item->description = $this->description;
        $item->order = $this->order;
        $item->is_active = $this->is_active;

        if ($this->icon) {
            $item->icon = $this->icon->store('why-choose-us', 'public');
        }

        $item->save();

        session()->flash('success', $this->isEditing ? 'Data berhasil diperbarui.' : 'Data berhasil ditambahkan.');

        return $this->redirect(route('admin.why-choose-us.index'), navigate: true);
    }

    public function render()
    {
        return view('livewire.admin.why-choose-us.form');
    }
}
