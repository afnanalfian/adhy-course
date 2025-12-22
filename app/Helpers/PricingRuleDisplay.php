<?php

use App\Models\PricingRule;

/**
 * harga untuk tryout
 */
function price_for_tryout(): float
{
    $rule = PricingRule::where('product_type', 'tryout')
        ->where('is_active', true)
        ->orderBy('min_qty')
        ->first();

    return $rule?->fixed_price ?? 0;
}

/**
 * range harga untuk meeting
 */
function price_range_meeting(): array
{
    $min = PricingRule::where('product_type', 'meeting')->min('price_per_unit');
    $max = PricingRule::where('product_type', 'meeting')->max('price_per_unit');

    return [
        'min' => $min ?? 0,
        'max' => $max ?? 0,
    ];
}

/**
 * harga meeting tertentu berdasarkan rule
 */
function meeting_price(int $meetingId): float
{
    $rule = PricingRule::where('product_type', 'meeting')
        ->where('is_active', true)
        ->orderBy('min_qty')
        ->first();

    return $rule?->price_per_unit ?? 0;
}

/**
 * harga paket full course
 */
function price_for_course_package(): float
{
    $rule = PricingRule::where('product_type', 'course_package')
        ->where('is_active', true)
        ->orderBy('min_qty')
        ->first();

    return $rule?->fixed_price ?? 0;
}
