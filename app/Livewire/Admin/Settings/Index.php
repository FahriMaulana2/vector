<?php

namespace App\Livewire\Admin\Settings;

use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use App\Models\Setting;

#[Layout('components.layouts.admin')]
#[Title('Pengaturan Website - Admin OMH Vector')]
class Index extends Component
{
    use WithFileUploads;

    public $company_name = '';
    public $address = '';
    public $phone = '';
    public $whatsapp = '';
    public $email = '';
    public $facebook = '';
    public $instagram = '';
    public $twitter = '';
    public $meta_title = '';
    public $meta_description = '';
    public $logo;
    public $existing_logo = null;

    public function mount()
    {
        $settings = Setting::pluck('value', 'key')->toArray();
        $this->company_name = $settings['company_name'] ?? '';
        $this->address = $settings['address'] ?? '';
        $this->phone = $settings['phone'] ?? '';
        $this->whatsapp = $settings['whatsapp'] ?? '';
        $this->email = $settings['email'] ?? '';
        $this->facebook = $settings['facebook'] ?? '';
        $this->instagram = $settings['instagram'] ?? '';
        $this->twitter = $settings['twitter'] ?? '';
        $this->meta_title = $settings['meta_title'] ?? '';
        $this->meta_description = $settings['meta_description'] ?? '';
        $this->existing_logo = $settings['logo'] ?? null;
    }

    public function save()
    {
        $this->validate([
            'company_name' => 'required|string|max:255',
            'address' => 'nullable|string',
            'phone' => 'nullable|string|max:50',
            'whatsapp' => 'nullable|string|max:50',
            'email' => 'nullable|email|max:255',
            'facebook' => 'nullable|string|max:255',
            'instagram' => 'nullable|string|max:255',
            'twitter' => 'nullable|string|max:255',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
            'logo' => 'nullable|image|max:2048',
        ]);

        $data = [
            'company_name' => $this->company_name,
            'address' => $this->address,
            'phone' => $this->phone,
            'whatsapp' => $this->whatsapp,
            'email' => $this->email,
            'facebook' => $this->facebook,
            'instagram' => $this->instagram,
            'twitter' => $this->twitter,
            'meta_title' => $this->meta_title,
            'meta_description' => $this->meta_description,
        ];

        if ($this->logo) {
            $data['logo'] = $this->logo->store('settings', 'public');
        }

        foreach ($data as $key => $value) {
            Setting::updateOrCreate(['key' => $key], ['value' => $value]);
        }

        session()->flash('success', 'Pengaturan berhasil disimpan.');
        $this->redirect(route('admin.settings.index'), navigate: true);
    }

    public function render()
    {
        return view('livewire.admin.settings.index');
    }
}
