<?php

namespace App\Observers;

use App\Models\Order;
use App\Models\UserEntitlement;

class OrderObserver
{
    public function updated(Order $order): void
    {
        if (! $this->shouldGrant($order)) {
            return;
        }

        $order->loadMissing([
            'items.product.productable',
            'items.product.bonuses',
        ]);

        foreach ($order->items as $item) {
            $product = $item->product;

            /** Entitlement utama */
            $this->grantMainEntitlement(
                $order->user_id,
                $product
            );

            /** Bonus entitlement */
            foreach ($product->bonuses as $bonus) {
                $this->grantBonusEntitlement(
                    $order->user_id,
                    $bonus
                );
            }
        }
    }

    protected function shouldGrant(Order $order): bool
    {
        return $order->wasChanged('status')
            && $order->status === 'verified';
    }

    protected function grantMainEntitlement(int $userId, $product): void
    {
        match ($product->type) {

            'meeting' => $this->grant(
                $userId,
                'meeting',
                $product->productable?->id
            ),

            'course_package' => $this->grant(
                $userId,
                'course',
                $product->productable?->id
            ),

            'tryout' => $this->grant(
                $userId,
                'tryout',
                $product->productable?->id
            ),

            'addon' => $this->grant(
                $userId,
                'quiz',
                0
            ),
        };
    }

    protected function grant(int $userId, string $type, int $id): void
    {
        UserEntitlement::firstOrCreate(
            [
                'user_id'          => $userId,
                'entitlement_type' => $type,
                'entitlement_id'   => $id,
            ],
            [
                'source' => 'purchase',
            ]
        );
    }

    protected function grantBonusEntitlement(int $userId, $bonus): void
    {
        if (! in_array($bonus->bonus_type, ['meeting','course','tryout','quiz'])) {
            return;
        }

        UserEntitlement::firstOrCreate(
            [
                'user_id'          => $userId,
                'entitlement_type' => $bonus->bonus_type,
                'entitlement_id'   => $bonus->bonus_id ?? 0,
            ],
            [
                'source' => 'bonus',
            ]
        );
    }

    protected function grantQuizIfNotExists(int $userId): void
    {
        UserEntitlement::firstOrCreate(
            [
                'user_id'          => $userId,
                'entitlement_type' => 'quiz',
                'entitlement_id'   => 0,
            ],
            [
                'source' => 'purchase',
            ]
        );
    }
}
