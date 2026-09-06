<?php

namespace App\Livewire\Admin\Products;

use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ProductOptionGroup;
use App\Models\ProductQtyPriceTier;
use Illuminate\Support\Str;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithFileUploads;

#[Layout('components.layouts.admin')]
#[Title('Form Produk - Admin OMAH Vector')]
class Form extends Component
{
    use WithFileUploads;

    public $itemId = null;

    public string $name = '';

    public string $description = '';

    public $image;

    public $existing_image = null;

    public string $badge = '';

    public bool $is_active = true;

    public $gallery = [];

    public $existing_gallery = [];

    public bool $isEditing = false;

    public $product_category_id = null;

    // ── Pricing fields ────────────────────────────────────────────
    public string $pricing_mode = 'standard';

    /** @var numeric-string|null */
    public $price = null;

    public string $base_price_unit = 'pcs';

    public bool $requires_area_calculation = false;

    public bool $supports_2_sisi = false;

    public string $available_widths_note = '';

    public int $min_qty = 1;

    public $qty_increment = null;

    // ── Option groups repeater ────────────────────────────────────
    /**
     * @var array<int, array{
     *   id: int|null,
     *   name: string,
     *   type: string,
     *   is_required: bool,
     *   sort_order: int,
     *   options: array<int, array{
     *     id: int|null,
     *     name: string,
     *     price_mode: string,
     *     price_unit: string,
     *     price_delta: numeric-string,
     *     requires_manual_quote: bool,
     *     is_default: bool,
     *     sort_order: int
     *   }>
     * }>
     */
    public array $optionGroups = [];

    // ── Qty price tiers repeater ──────────────────────────────────
    /**
     * @var array<int, array{
     *   id: int|null,
     *   side_mode: string,
     *   min_qty: int,
     *   price_per_unit: numeric-string,
     *   is_active: bool
     * }>
     */
    public array $tiers = [];

    /**
     * Load product ketika mode edit.
     */
    public function mount($product = null): void
    {
        if (! $product) {
            $this->optionGroups = [];
            $this->tiers = [];

            return;
        }

        $this->isEditing = true;

        $item = Product::with(['images', 'optionGroups.options', 'qtyPriceTiers'])
            ->findOrFail($product);

        $this->itemId = $item->id;
        $this->name = $item->name;
        $this->description = $item->description ?? '';
        $this->existing_image = $item->image;
        $this->badge = $item->badge ?? '';
        $this->is_active = (bool) $item->is_active;
        $this->product_category_id = $item->product_category_id;

        // Pricing
        $this->pricing_mode = $item->pricing_mode ?? 'standard';
        $this->price = $item->price;
        $this->base_price_unit = $item->base_price_unit ?? 'pcs';
        $this->requires_area_calculation = (bool) ($item->requires_area_calculation ?? false);
        $this->supports_2_sisi = (bool) ($item->supports_2_sisi ?? false);
        $this->available_widths_note = $item->available_widths_note ?? '';
        $this->min_qty = (int) ($item->min_qty ?? 1);
        $this->qty_increment = $item->qty_increment;

        // Gallery
        $this->existing_gallery = $item->images->pluck('image')->toArray();

        // Option groups
        $this->optionGroups = $item->optionGroups->map(function ($group) {
            return [
                'id' => $group->id,
                'name' => $group->name,
                'type' => $group->type,
                'is_required' => (bool) $group->is_required,
                'sort_order' => (int) $group->sort_order,
                'options' => $group->options->map(function ($opt) {
                    return [
                        'id' => $opt->id,
                        'name' => $opt->name,
                        'price_mode' => $opt->price_mode,
                        'price_unit' => $opt->price_unit,
                        'price_delta' => $opt->price_delta,
                        'requires_manual_quote' => (bool) $opt->requires_manual_quote,
                        'is_default' => (bool) $opt->is_default,
                        'sort_order' => (int) $opt->sort_order,
                    ];
                })->values()->toArray(),
            ];
        })->values()->toArray();

        // Qty price tiers
        $this->tiers = $item->qtyPriceTiers->map(function ($tier) {
            return [
                'id' => $tier->id,
                'side_mode' => $tier->side_mode,
                'min_qty' => (int) $tier->min_qty,
                'price_per_unit' => $tier->price_per_unit,
                'is_active' => (bool) $tier->is_active,
            ];
        })->values()->toArray();
    }

    // ── Option group actions ──────────────────────────────────────

    public function addGroup(): void
    {
        $this->optionGroups[] = [
            'id' => null,
            'name' => '',
            'type' => 'radio',
            'is_required' => true,
            'sort_order' => count($this->optionGroups),
            'options' => [],
        ];
    }

    public function removeGroup(int $groupIndex): void
    {
        array_splice($this->optionGroups, $groupIndex, 1);
        $this->optionGroups = array_values($this->optionGroups);
    }

    public function addOption(int $groupIndex): void
    {
        $sortOrder = count($this->optionGroups[$groupIndex]['options']);
        $this->optionGroups[$groupIndex]['options'][] = [
            'id' => null,
            'name' => '',
            'price_mode' => 'delta',
            'price_unit' => 'flat',
            'price_delta' => '0',
            'requires_manual_quote' => false,
            'is_default' => false,
            'sort_order' => $sortOrder,
        ];
    }

    public function removeOption(int $groupIndex, int $optionIndex): void
    {
        array_splice($this->optionGroups[$groupIndex]['options'], $optionIndex, 1);
        $this->optionGroups[$groupIndex]['options'] = array_values($this->optionGroups[$groupIndex]['options']);
    }

    // ── Tier actions ──────────────────────────────────────────────

    public function addTier(): void
    {
        $this->tiers[] = [
            'id' => null,
            'side_mode' => '1_muka',
            'min_qty' => 1,
            'price_per_unit' => '0',
            'is_active' => true,
        ];
    }

    public function removeTier(int $tierIndex): void
    {
        array_splice($this->tiers, $tierIndex, 1);
        $this->tiers = array_values($this->tiers);
    }

    /**
     * Simpan produk beserta semua relasinya.
     */
    public function save()
    {
        $rules = [
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|max:2048',
            'badge' => 'nullable|string|max:100',
            'is_active' => 'boolean',
            'gallery.*' => 'nullable|image|max:2048',
            'product_category_id' => 'required|exists:product_categories,id',
            'pricing_mode' => 'required|in:standard,qty_tiered',
            'base_price_unit' => 'required|in:pcs,lembar,m2',
            'requires_area_calculation' => 'boolean',
            'supports_2_sisi' => 'boolean',
            'available_widths_note' => 'nullable|string|max:255',
            'min_qty' => 'required|integer|min:1',
            'qty_increment' => 'nullable|integer|min:1',

            // Standard mode price
            'price' => $this->pricing_mode === 'standard'
                ? 'required|numeric|min:0'
                : 'nullable|numeric|min:0',

            // Tiers
            'tiers' => $this->pricing_mode === 'qty_tiered' ? 'required|array|min:1' : 'nullable|array',
            'tiers.*.side_mode' => 'required_with:tiers|in:1_muka,2_muka',
            'tiers.*.min_qty' => 'required_with:tiers|integer|min:1',
            'tiers.*.price_per_unit' => 'required_with:tiers|numeric|min:0',
            'tiers.*.is_active' => 'boolean',

            // Option groups
            'optionGroups' => 'nullable|array',
            'optionGroups.*.name' => 'required_with:optionGroups|string|max:255',
            'optionGroups.*.type' => 'required_with:optionGroups|in:radio,select,checkbox',
            'optionGroups.*.is_required' => 'boolean',
            'optionGroups.*.options' => 'nullable|array',
            'optionGroups.*.options.*.name' => 'required_with:optionGroups.*.options|string|max:255',
            'optionGroups.*.options.*.price_mode' => 'required_with:optionGroups.*.options|in:delta,absolute',
            'optionGroups.*.options.*.price_unit' => 'required_with:optionGroups.*.options|in:flat,per_length_m',
            'optionGroups.*.options.*.price_delta' => 'required_with:optionGroups.*.options|numeric',
            'optionGroups.*.options.*.requires_manual_quote' => 'boolean',
            'optionGroups.*.options.*.is_default' => 'boolean',
        ];

        $this->validate($rules);

        // Custom: radio/select groups must have at most 1 default option
        foreach ($this->optionGroups as $gIdx => $groupData) {
            if (in_array($groupData['type'], ['radio', 'select'], true)) {
                $defaultCount = count(array_filter(
                    $groupData['options'] ?? [],
                    fn ($opt) => ! empty($opt['is_default'])
                ));

                if ($defaultCount > 1) {
                    $this->addError(
                        "optionGroups.{$gIdx}.options",
                        "Grup '{$groupData['name']}' (radio/select) hanya boleh memiliki satu opsi default."
                    );
                }
            }
        }

        if ($this->getErrorBag()->isNotEmpty()) {
            return;
        }


        /*
        |--------------------------------------------------------------------------
        | Create / Update Product
        |--------------------------------------------------------------------------
        */

        $item = $this->isEditing
            ? Product::findOrFail($this->itemId)
            : new Product;

        $item->name = $this->name;
        $item->slug = Str::slug($this->name);
        $item->description = $this->description;
        $item->badge = $this->badge ?: null;
        $item->is_active = $this->is_active;
        $item->product_category_id = $this->product_category_id;

        // Pricing
        $item->pricing_mode = $this->pricing_mode;
        $item->base_price_unit = $this->base_price_unit;
        $item->requires_area_calculation = $this->requires_area_calculation;
        $item->supports_2_sisi = $this->supports_2_sisi;
        $item->available_widths_note = $this->available_widths_note ?: null;
        $item->min_qty = $this->min_qty;
        $item->qty_increment = $this->qty_increment ?: null;
        $item->price = $this->pricing_mode === 'standard'
            ? ($this->price !== '' && $this->price !== null ? (float) $this->price : null)
            : null;

        /*
        |--------------------------------------------------------------------------
        | Main Image
        |--------------------------------------------------------------------------
        */

        if ($this->image) {
            $item->image = $this->image->store('products', 'public');
        }

        /*
        |--------------------------------------------------------------------------
        | Save Product
        |--------------------------------------------------------------------------
        */

        $item->save();

        /*
        |--------------------------------------------------------------------------
        | Gallery Images
        |--------------------------------------------------------------------------
        */

        if (! empty($this->gallery)) {
            foreach ($this->gallery as $img) {
                $item->images()->create([
                    'image' => $img->store('products/gallery', 'public'),
                ]);
            }
        }

        /*
        |--------------------------------------------------------------------------
        | Option Groups & Options (full sync)
        |--------------------------------------------------------------------------
        */

        $incomingGroupIds = [];
        foreach ($this->optionGroups as $groupIdx => $groupData) {
            if (! empty($groupData['id'])) {
                $group = ProductOptionGroup::findOrFail($groupData['id']);
            } else {
                $group = new ProductOptionGroup(['product_id' => $item->id]);
            }

            $group->product_id = $item->id;
            $group->name = $groupData['name'];
            $group->type = $groupData['type'];
            $group->is_required = (bool) $groupData['is_required'];
            $group->sort_order = $groupIdx;
            $group->save();

            $incomingGroupIds[] = $group->id;

            // Sync options
            $incomingOptionIds = [];
            foreach ($groupData['options'] ?? [] as $optIdx => $optData) {
                if (! empty($optData['id'])) {
                    $opt = $group->options()->findOrFail($optData['id']);
                } else {
                    $opt = $group->options()->newModelInstance(['product_option_group_id' => $group->id]);
                }

                $opt->product_option_group_id = $group->id;
                $opt->name = $optData['name'];
                $opt->price_mode = $optData['price_mode'];
                $opt->price_unit = $optData['price_unit'];
                $opt->price_delta = (float) $optData['price_delta'];
                $opt->requires_manual_quote = (bool) $optData['requires_manual_quote'];
                $opt->is_default = (bool) $optData['is_default'];
                $opt->sort_order = $optIdx;
                $opt->save();

                $incomingOptionIds[] = $opt->id;
            }

            // Remove deleted options
            $group->options()->whereNotIn('id', $incomingOptionIds)->delete();
        }

        // Remove deleted groups (cascade deletes options)
        $item->optionGroups()->whereNotIn('id', $incomingGroupIds)->delete();

        /*
        |--------------------------------------------------------------------------
        | Qty Price Tiers (full sync)
        |--------------------------------------------------------------------------
        */

        $incomingTierIds = [];
        foreach ($this->tiers as $tierData) {
            if (! empty($tierData['id'])) {
                $tier = ProductQtyPriceTier::findOrFail($tierData['id']);
            } else {
                $tier = new ProductQtyPriceTier(['product_id' => $item->id]);
            }

            $tier->product_id = $item->id;
            $tier->side_mode = $tierData['side_mode'];
            $tier->min_qty = (int) $tierData['min_qty'];
            $tier->price_per_unit = (float) $tierData['price_per_unit'];
            $tier->is_active = (bool) $tierData['is_active'];
            $tier->save();

            $incomingTierIds[] = $tier->id;
        }

        // Remove deleted tiers
        $item->qtyPriceTiers()->whereNotIn('id', $incomingTierIds)->delete();

        /*
        |--------------------------------------------------------------------------
        | Success Message
        |--------------------------------------------------------------------------
        */

        session()->flash(
            'success',
            $this->isEditing
                ? 'Produk berhasil diperbarui.'
                : 'Produk berhasil ditambahkan.'
        );

        return $this->redirect(
            route('admin.products.index'),
            navigate: true
        );
    }

    /**
     * Render form.
     */
    public function render()
    {
        return view('livewire.admin.products.form', [
            'categories' => ProductCategory::orderBy('sort_order')
                ->orderBy('name')
                ->get(),
        ]);
    }
}
