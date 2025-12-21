<?php
namespace App\Services;

use App\Models\Cart;
use App\Models\PricingRule;
use Illuminate\Support\Collection;

class PricingService
{
    /**
     * Hitung total harga cart
     */
    public function calculateCartTotal(Cart $cart): array
    {
        $items = [];
        $grandTotal = 0;

        foreach ($cart->items as $item) {
            $result = $this->calculateItem(
                $item->product->type,
                $item->qty
            );

            $itemTotal = $result['is_fixed']
                ? $result['unit_price']
                : $result['unit_price'] * $item->qty;

            $items[] = [
                'product_id' => $item->product_id,
                'qty'        => $item->qty,
                'unit_price' => $result['unit_price'],
                'total'      => $itemTotal,
            ];

            $grandTotal += $itemTotal;
        }

        return [
            'items' => $items,
            'total' => $grandTotal,
        ];
    }

    /**
     * Hitung harga per unit berdasarkan tipe & qty
     */
    public function calculateItem(string $productType, int $qty): array
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
            throw new \Exception("Pricing rule not found for {$productType}");
        }

        // Fixed price (course)
        if ($rule->fixed_price !== null) {
            return [
                'unit_price' => $rule->fixed_price,
                'is_fixed'   => true,
                'rule_id'    => $rule->id,
            ];
        }

        return [
            'unit_price' => $rule->price_per_unit,
            'rule_id'    => $rule->id,
        ];
    }
    public function calculate(string $productType, int $qty): float
    {
        return $this->calculateItem($productType, $qty)['unit_price'];
    }

}
