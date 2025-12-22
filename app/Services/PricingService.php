<?php

namespace App\Services;

use App\Models\Cart;
use App\Models\PricingRule;
use Exception;

class PricingService
{
    /**
     * Hitung TOTAL CART DAN SETIAP ITEM.
     * cart_items.qty menentukan rule mana yang berlaku.
     */
    public function calculateCartTotal(Cart $cart): array
    {
        $items = [];
        $grandTotal = 0;

        foreach ($cart->items as $item) {

            $unit = $this->determineUnitPrice(
                $item->product->type,
                $item->qty
            );

            $lineTotal = $unit * $item->qty;

            $items[] = [
                'product_id' => $item->product_id,
                'qty'        => $item->qty,
                'unit_price' => $unit,
                'total'      => $lineTotal,
            ];

            $grandTotal += $lineTotal;
        }

        return [
            'items' => $items,
            'total' => $grandTotal,
        ];
    }


    /**
     * Tentukan harga per item
     * berdasarkan PRICING_RULES.
     */
    public function determineUnitPrice(string $productType, int $qty): float
    {
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
            throw new Exception("Pricing rule missing for product type {$productType}");
        }

        return $rule->fixed_price ?? $rule->price_per_unit;
    }


    /**
     * Harga full course berdasarkan jumlah meeting × rule kedalaman tertinggi
     */
    public function fullCoursePrice(int $meetingCount): float
    {
        $rule = PricingRule::where('product_type', 'course_package')
            ->where('is_active', true)
            ->orderBy('min_qty', 'asc')
            ->first();

        if (! $rule) {
            throw new Exception("Pricing rule missing for course_package");
        }

        return $rule->fixed_price
            ?? ($rule->price_per_unit * $meetingCount);
    }
}
