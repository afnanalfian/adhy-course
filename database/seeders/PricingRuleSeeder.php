<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PricingRule;

class PricingRuleSeeder extends Seeder
{
    public function run(): void
    {
        /*
         |--------------------------------------------------------------------------
         | COURSE PACKAGE (FIXED)
         |--------------------------------------------------------------------------
         | 350.000 per course
         */
        PricingRule::create([
            'product_type'   => 'course_package',
            'min_qty'        => 1,
            'max_qty'        => null,
            'fixed_price'    => 350000,
            'price_per_unit' => null,
            'is_active'      => true,
        ]);

        /*
         |--------------------------------------------------------------------------
         | MEETING (TIERED)
         |--------------------------------------------------------------------------
         */
        // 1–5 : 20.000 / meeting
        PricingRule::create([
            'product_type'   => 'meeting',
            'min_qty'        => 1,
            'max_qty'        => 5,
            'price_per_unit' => 20000,
            'fixed_price'    => null,
            'is_active'      => true,
        ]);

        // 6–15 : 15.000 / meeting
        PricingRule::create([
            'product_type'   => 'meeting',
            'min_qty'        => 6,
            'max_qty'        => 15,
            'price_per_unit' => 15000,
            'fixed_price'    => null,
            'is_active'      => true,
        ]);

        // >15 : 10.000 / meeting
        PricingRule::create([
            'product_type'   => 'meeting',
            'min_qty'        => 16,
            'max_qty'        => null,
            'price_per_unit' => 10000,
            'fixed_price'    => null,
            'is_active'      => true,
        ]);

        /*
         |--------------------------------------------------------------------------
         | TRYOUT (FIXED)
         |--------------------------------------------------------------------------
         | 30.000 per tryout
         */
        PricingRule::create([
            'product_type'   => 'tryout',
            'min_qty'        => 1,
            'max_qty'        => null,
            'fixed_price'    => 30000,
            'price_per_unit' => null,
            'is_active'      => true,
        ]);

        /*
         |--------------------------------------------------------------------------
         | ADDON QUIZ (FIXED)
         |--------------------------------------------------------------------------
         | 19.000
         */
        PricingRule::create([
            'product_type'   => 'addon',
            'min_qty'        => 1,
            'max_qty'        => null,
            'fixed_price'    => 19000,
            'price_per_unit' => null,
            'is_active'      => true,
        ]);
    }
}
