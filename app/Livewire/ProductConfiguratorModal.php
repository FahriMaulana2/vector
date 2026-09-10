<?php

declare(strict_types=1);

namespace App\Livewire;

use App\Models\Product;
use App\Services\CartService;
use App\Services\PricingEngine;
use InvalidArgumentException;
use Livewire\Attributes\On;
use Livewire\Component;

class ProductConfiguratorModal extends Component
{
    public bool $isOpen = false;

    public ?int $productId = null;

    public ?string $editingCartItemUuid = null;

    public ?Product $product = null;

    public int $qty = 1;

    public string $sideMode = '1_muka';

    public ?float $lengthM = null;

    public ?float $widthM = null;

    /**
     * @var array<int, int|string>
     */
    public array $selectedOptions = [];

    /**
     * Cache state per product ID during session.
     *
     * @var array<int, array<string, mixed>>
     */
    public array $cachedProductStates = [];

    public ?string $errorMessage = null;

    /**
     * @var array<string, mixed>|null
     */
    public ?array $calculationPreview = null;

    #[On('open-configurator')]
    public function openConfigurator(int $productId, ?string $cartItemUuid = null, ?CartService $cartService = null, ?PricingEngine $pricingEngine = null): void
    {
        $this->productId = $productId;
        $this->editingCartItemUuid = $cartItemUuid;

        $this->product = Product::with(['category', 'optionGroups.options', 'qtyPriceTiers'])
            ->findOrFail($productId);

        if ($cartItemUuid && $cartService) {
            $existingItem = $cartService->getItem($cartItemUuid);
            if ($existingItem) {
                $this->qty = (int) ($existingItem['qty'] ?? $this->product->min_qty ?? 1);
                $this->sideMode = (string) ($existingItem['side_mode'] ?? '1_muka');
                $this->lengthM = isset($existingItem['length_m']) ? (float) $existingItem['length_m'] : null;
                $this->widthM = isset($existingItem['width_m']) ? (float) $existingItem['width_m'] : null;

                $this->selectedOptions = [];
                if (! empty($existingItem['selected_options']) && is_array($existingItem['selected_options'])) {
                    foreach ($existingItem['selected_options'] as $opt) {
                        if (isset($opt['group_id'], $opt['option_id'])) {
                            $this->selectedOptions[(int) $opt['group_id']] = (int) $opt['option_id'];
                        }
                    }
                }
            }
        } elseif (isset($this->cachedProductStates[$productId])) {
            $cached = $this->cachedProductStates[$productId];
            $this->qty = (int) ($cached['qty'] ?? $this->product->min_qty ?? 1);
            $this->sideMode = (string) ($cached['sideMode'] ?? '1_muka');
            $this->lengthM = isset($cached['lengthM']) ? (float) $cached['lengthM'] : null;
            $this->widthM = isset($cached['widthM']) ? (float) $cached['widthM'] : null;
            $this->selectedOptions = (array) ($cached['selectedOptions'] ?? []);
        } else {
            $this->qty = (int) ($this->product->min_qty ?? 1);
            $this->sideMode = '1_muka';
            $this->lengthM = $this->product->requires_area_calculation ? 1.0 : null;
            $this->widthM = $this->product->requires_area_calculation ? 1.0 : null;
            $this->selectedOptions = [];

            // Pre-select default options if configured
            foreach ($this->product->optionGroups as $group) {
                $defaultOption = $group->options->firstWhere('is_default', true) ?? $group->options->first();
                if ($defaultOption) {
                    $this->selectedOptions[$group->id] = $defaultOption->id;
                }
            }
        }

        $this->isOpen = true;
        $this->refreshCalculation($pricingEngine ?? app(PricingEngine::class));
    }

    public function updated($property): void
    {
        $this->refreshCalculation(app(PricingEngine::class));
    }

    public function incrementQty(): void
    {
        $step = max(1, (int) ($this->product?->qty_increment ?? 1));
        $this->qty += $step;
        $this->refreshCalculation(app(PricingEngine::class));
    }

    public function decrementQty(): void
    {
        $step = max(1, (int) ($this->product?->qty_increment ?? 1));
        $min = max(1, (int) ($this->product?->min_qty ?? 1));
        if ($this->qty - $step >= $min) {
            $this->qty -= $step;
        } else {
            $this->qty = $min;
        }
        $this->refreshCalculation(app(PricingEngine::class));
    }

    public function closeModal(): void
    {
        if ($this->productId && $this->product) {
            $this->cachedProductStates[$this->productId] = [
                'qty' => $this->qty,
                'sideMode' => $this->sideMode,
                'lengthM' => $this->lengthM,
                'widthM' => $this->widthM,
                'selectedOptions' => $this->selectedOptions,
            ];
        }

        $this->isOpen = false;
        $this->editingCartItemUuid = null;
        $this->errorMessage = null;
    }

    public function refreshCalculation(PricingEngine $pricingEngine): void
    {
        if (! $this->product) {
            return;
        }

        try {
            $this->errorMessage = null;
            $this->calculationPreview = $pricingEngine->calculate(
                $this->product,
                $this->qty,
                $this->selectedOptions,
                $this->sideMode,
                $this->lengthM,
                $this->widthM
            );
        } catch (InvalidArgumentException $e) {
            $this->errorMessage = $e->getMessage();
            $this->calculationPreview = null;
        }
    }

    public function addToCart(bool $proceedToForm, CartService $cartService, PricingEngine $pricingEngine): void
    {
        if (! $this->product) {
            return;
        }

        try {
            $itemData = $pricingEngine->calculate(
                $this->product,
                $this->qty,
                $this->selectedOptions,
                $this->sideMode,
                $this->lengthM,
                $this->widthM
            );
        } catch (InvalidArgumentException $e) {
            $this->errorMessage = $e->getMessage();

            return;
        }

        if ($this->editingCartItemUuid) {
            $cartService->updateItem($this->editingCartItemUuid, $itemData);
        } else {
            $cartService->addItem($itemData);
        }

        // Cache state for current product
        $this->cachedProductStates[$this->productId] = [
            'qty' => $this->qty,
            'sideMode' => $this->sideMode,
            'lengthM' => $this->lengthM,
            'widthM' => $this->widthM,
            'selectedOptions' => $this->selectedOptions,
        ];

        $productName = $this->product->name;
        $this->closeModal();
        $this->dispatch('cart-updated');

        if ($proceedToForm) {
            $this->redirect(route('pemesanan'), navigate: true);
        } else {
            $this->dispatch('show-toast', message: "{$productName} berhasil ditambahkan ke keranjang!");
        }
    }

    public function render()
    {
        return view('livewire.product-configurator-modal');
    }
}
