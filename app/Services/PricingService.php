<?php

namespace App\Services;

use App\Models\Cart;
use App\Models\PricingRule;
use Exception;

class PricingService
{
    /**
     * Hitung ulang cart (dipakai saat update qty & checkout)
     */
    public function calculateCartTotal(Cart $cart): array
    {
        $cart->load('items.product');

        $items = [];
        $grandTotal = 0;

        foreach ($cart->items as $item) {
            $unitPrice = $this->determineUnitPrice(
                $item->product->type,
                $item->qty
            );

            $lineTotal = $unitPrice * $item->qty;

            $items[] = [
                'cart_item_id' => $item->id,
                'product_id'   => $item->product_id,
                'qty'          => $item->qty,
                'unit_price'   => $unitPrice,
                'subtotal'     => $lineTotal,
            ];

            $grandTotal += $lineTotal;
        }

        return [
            'items' => $items,
            'total' => $grandTotal,
        ];
    }

    /**
     * Harga satuan berdasarkan pricing rules
     */
    public function determineUnitPrice(
        string $productType,
        int $qty,
        ?Cart $cart = null
    ): float {

        if ($productType === 'meeting') {
            throw new \LogicException(
                'Gunakan meetingUnitPriceFromCart() untuk product meeting'
            );
        }

        $rule = PricingRule::where('product_type', $productType)
            ->where('is_active', true)
            ->where('min_qty', '<=', $qty)
            ->where(function ($q) use ($qty) {
                $q->whereNull('max_qty')
                ->orWhere('max_qty', '>=', $qty);
            })
            ->orderBy('min_qty', 'desc')
            ->first();

        if (! $rule) {
            throw new \Exception("Pricing rule missing for {$productType} (qty={$qty})");
        }

        return $rule->fixed_price ?? $rule->price_per_unit;
    }


    /**
     * Harga addon (flat, qty selalu 1)
     */
    public function addonPrice(): float
    {
        $rule = PricingRule::where('product_type', 'addon')
            ->where('is_active', true)
            ->first();

        if (! $rule || ! $rule->fixed_price) {
            throw new Exception('Addon pricing rule missing');
        }

        return $rule->fixed_price;
    }

    /**
     * Harga course package (flat)
     */
    public function coursePackagePrice(): float
    {
        $rule = PricingRule::where('product_type', 'course_package')
            ->where('is_active', true)
            ->first();

        if (! $rule) {
            throw new Exception('Course package pricing rule missing');
        }

        return $rule->fixed_price ?? 0;
    }
    public function meetingUnitPriceFromCart(Cart $cart): float
    {
        $totalQty = $cart->items()
            ->whereHas('product', fn ($q) => $q->where('type', 'meeting'))
            ->sum('qty'); // ✅ BUKAN count()

        if ($totalQty < 1) {
            throw new Exception('Meeting qty invalid');
        }

        $rule = PricingRule::where('product_type', 'meeting')
            ->where('is_active', true)
            ->where('min_qty', '<=', $totalQty)
            ->where(function ($q) use ($totalQty) {
                $q->whereNull('max_qty')
                ->orWhere('max_qty', '>=', $totalQty);
            })
            ->orderBy('min_qty', 'desc')
            ->first();

        if (! $rule) {
            throw new Exception("Pricing rule missing for meeting (qty={$totalQty})");
        }

        return $rule->price_per_unit;
    }

}
