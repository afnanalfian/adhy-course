<?php
namespace App\Observers;

use App\Models\Order;
use App\Models\UserEntitlement;

class OrderObserver
{
    public function updated(Order $order)
    {
        if (! $this->isJustVerified($order)) {
            return;
        }

        $this->grantEntitlements($order);
    }

    protected function isJustVerified(Order $order): bool
    {
        return $order->isDirty('status')
            && $order->status === 'verified';
    }

    protected function grantEntitlements(Order $order): void
    {
        foreach ($order->items as $item) {
            $product = $item->product;

            /** Grant produk utama */
            $this->grantMainEntitlement(
                $order->user_id,
                $product
            );

            /** Grant bonus (jika ada) */
            foreach ($product->bonuses as $bonus) {
                $this->grantBonusEntitlement(
                    $order->user_id,
                    $bonus
                );
            }
        }
    }
    protected function grantMainEntitlement(int $userId, $product): void
    {
        match ($product->type) {
            'meeting' => UserEntitlement::firstOrCreate([
                'user_id' => $userId,
                'entitlement_type' => 'meeting',
                'entitlement_id' => $product->productable_id,
            ], [
                'source' => 'purchase',
            ]),

            'course_package' => UserEntitlement::firstOrCreate([
                'user_id' => $userId,
                'entitlement_type' => 'course',
                'entitlement_id' => $product->productable_id,
            ], [
                'source' => 'purchase',
            ]),

            'tryout' => UserEntitlement::firstOrCreate([
                'user_id' => $userId,
                'entitlement_type' => 'tryout',
                'entitlement_id' => $product->productable_id,
            ], [
                'source' => 'purchase',
            ]),

            'addon' => UserEntitlement::firstOrCreate([
                'user_id' => $userId,
                'entitlement_type' => 'quiz',
                'entitlement_id' => null,
            ], [
                'source' => 'purchase',
            ]),
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
