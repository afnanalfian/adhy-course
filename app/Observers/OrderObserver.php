<?php

namespace App\Observers;

use App\Models\Order;
use App\Models\UserEntitlement;
use Illuminate\Support\Facades\DB;

class OrderObserver
{
    public function updated(Order $order)
    {
        // ✅ hanya sekali: pending → verified
        if (! $this->shouldGrant($order)) {
            return;
        }

        DB::transaction(function () use ($order) {
            $order->loadMissing(['items.product.bonuses']);

            foreach ($order->items as $item) {
                $this->grantMainEntitlement(
                    $order->user_id,
                    $item->product
                );

                foreach ($item->product->bonuses as $bonus) {
                    $this->grantBonusEntitlement(
                        $order->user_id,
                        $bonus
                    );
                }
            }
        });
    }

    protected function shouldGrant(Order $order): bool
    {
        return $order->wasChanged('status')
            && $order->getOriginal('status') === 'pending'
            && $order->status === 'verified';
    }

    protected function grantMainEntitlement(int $userId, $product): void
    {
        match ($product->type) {
            'meeting' => UserEntitlement::firstOrCreate([
                'user_id' => $userId,
                'entitlement_type' => 'meeting',
                'entitlement_id' => $product->productable_id,
            ], ['source' => 'purchase']),

            'course_package' => UserEntitlement::firstOrCreate([
                'user_id' => $userId,
                'entitlement_type' => 'course',
                'entitlement_id' => $product->productable_id,
            ], ['source' => 'purchase']),

            'tryout' => UserEntitlement::firstOrCreate([
                'user_id' => $userId,
                'entitlement_type' => 'tryout',
                'entitlement_id' => $product->productable_id,
            ], ['source' => 'purchase']),

            'addon' => UserEntitlement::firstOrCreate([
                'user_id' => $userId,
                'entitlement_type' => 'quiz',
                'entitlement_id' => null,
            ], ['source' => 'purchase']),
        };
    }

    protected function grantBonusEntitlement(int $userId, $bonus): void
    {
        UserEntitlement::firstOrCreate([
            'user_id' => $userId,
            'entitlement_type' => $bonus->bonus_type,
            'entitlement_id' => $bonus->bonus_id,
        ], [
            'source' => 'bonus',
        ]);
    }
}
