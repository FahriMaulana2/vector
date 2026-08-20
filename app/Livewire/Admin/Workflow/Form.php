<?php

namespace App\Livewire\Admin\Workflow;

use App\Models\WorkflowStep;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('components.layouts.admin')]
#[Title('Form Alur Kerja - Admin OMH Vector')]
class Form extends Component
{
    public $itemId = null;

    public $title = '';

    public $description = '';

    public $step_number = 1;

    public $sort_order = 0;

    public $is_active = true;

    public $icon = 'chat-bubble-left';

    /**
     * Semua icon yang tersedia.
     */
    public array $icons = [];

    /**
     * Status modal icon picker.
     */
    public bool $iconPickerOpen = false;

    /**
     * Mode form.
     */
    public bool $isEditing = false;

    /**
     * Ambil daftar icon dari config/heroicons.php
     */
    protected function resolveIcons(): array
    {
        $source = config('heroicons.icons', []);

        if (! is_array($source)) {
            return [];
        }

        $icons = [];

        foreach ($source as $key => $meta) {
            if (! is_string($key)) {
                continue;
            }

            /*
             * Format utama:
             *
             * 'pencil' => [
             *     'name' => 'Pencil',
             *     'svg' => '<path ... />',
             * ]
             */
            if (is_array($meta)) {
                $name = $meta['name'] ?? str($key)
                    ->replace(['-', '_'], ' ')
                    ->title()
                    ->toString();

                $svg = $meta['svg'] ?? '';

                if (trim($svg) === '') {
                    continue;
                }

                $icons[$key] = [
                    'name' => $name,
                    'svg' => $svg,
                ];

                continue;
            }

            /*
             * Fallback apabila value config hanya berupa SVG string.
             */
            if (is_string($meta) && trim($meta) !== '') {
                $icons[$key] = [
                    'name' => str($key)
                        ->replace(['-', '_'], ' ')
                        ->title()
                        ->toString(),
                    'svg' => $meta,
                ];
            }
        }

        return $icons;
    }

    /**
     * Inisialisasi form.
     */
    public function mount($workflow = null): void
    {
        // Selalu load semua icon ketika halaman dibuka.
        $this->icons = $this->resolveIcons();

        /*
         * Pastikan icon default tersedia.
         * Kalau tidak tersedia, gunakan icon pertama dari config.
         */
        if (! isset($this->icons[$this->icon])) {
            $this->icon = array_key_first($this->icons) ?? 'chat-bubble-left';
        }

        /*
         * Mode edit.
         */
        if ($workflow) {
            $this->isEditing = true;

            $item = WorkflowStep::findOrFail($workflow);

            $this->itemId = $item->id;
            $this->title = $item->title;
            $this->description = $item->description;
            $this->step_number = $item->step_number;
            $this->sort_order = $item->sort_order;
            $this->is_active = $item->is_active;

            if (
                $item->icon &&
                isset($this->icons[$item->icon])
            ) {
                $this->icon = $item->icon;
            }
        }
    }

    /**
     * Buka modal icon picker.
     */
    public function openIconPicker(): void
    {
        $this->iconPickerOpen = true;
    }

    /**
     * Tutup modal icon picker.
     */
    public function closeIconPicker(): void
    {
        $this->iconPickerOpen = false;
    }

    /**
     * Pilih icon.
     */
    public function selectIcon(string $key): void
    {
        /*
         * Pastikan key memang berasal dari daftar icon
         * yang tersedia.
         */
        if (isset($this->icons[$key])) {
            $this->icon = $key;
        }

        $this->iconPickerOpen = false;
    }

    /**
     * Simpan data workflow.
     */
    public function save()
    {
        $this->validate([
            'title' => 'required|string|max:255',

            'description' => 'nullable|string',

            'step_number' => 'required|integer|min:1',

            'sort_order' => 'required|integer|min:0',

            'is_active' => 'boolean',

            'icon' => [
                'required',
                'string',
                Rule::in(array_keys($this->icons)),
            ],
        ]);

        if ($this->isEditing) {
            $item = WorkflowStep::findOrFail($this->itemId);
        } else {
            $item = new WorkflowStep;
        }

        $item->title = $this->title;
        $item->description = $this->description;
        $item->step_number = $this->step_number;
        $item->sort_order = $this->sort_order;
        $item->is_active = $this->is_active;
        $item->icon = $this->icon;

        $item->save();

        session()->flash(
            'success',
            $this->isEditing
                ? 'Langkah alur kerja berhasil diperbarui.'
                : 'Langkah alur kerja berhasil ditambahkan.'
        );

        return $this->redirect(
            route('admin.workflow.index'),
            navigate: true
        );
    }

    /**
     * Render halaman.
     */
    public function render()
    {
        return view('livewire.admin.workflow.form');
    }
}
