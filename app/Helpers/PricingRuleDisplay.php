<?php

use App\Models\PricingRule;

/**
 * Harga fixed tryout
 */
function price_for_tryout(): float
{
    return PricingRule::where('product_type', 'tryout')
        ->where('is_active', true)
        ->value('fixed_price') ?? 0;
}

/**
 * Range harga meeting (untuk browse)
 * contoh: 10.000 – 20.000
 */
function price_range_meeting(): array
{
    return [
        'min' => PricingRule::where('product_type', 'meeting')
            ->where('is_active', true)
            ->min('price_per_unit') ?? 0,

        'max' => PricingRule::where('product_type', 'meeting')
            ->where('is_active', true)
            ->max('price_per_unit') ?? 0,
    ];
}

/**
 * Harga meeting berdasarkan qty (dipakai di cart / checkout)
 */
function meeting_price_by_qty(int $qty): float
{
    $rule = PricingRule::where('product_type', 'meeting')
        ->where('is_active', true)
        ->where('min_qty', '<=', $qty)
        ->where(fn ($q) =>
            $q->whereNull('max_qty')
              ->orWhere('max_qty', '>=', $qty)
        )
        ->orderByDesc('min_qty')
        ->first();

    return $rule?->price_per_unit ?? 0;
}

/**
 * Harga full course
 */
function price_for_course_package(): float
{
    return PricingRule::where('product_type', 'course_package')
        ->where('is_active', true)
        ->value('fixed_price') ?? 0;
}

/**
 * Harga addon quiz
 */
function price_for_addon(): float
{
    return PricingRule::where('product_type', 'addon')
        ->where('is_active', true)
        ->value('fixed_price') ?? 0;
}
