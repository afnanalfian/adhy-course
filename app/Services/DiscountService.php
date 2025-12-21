<?php
namespace App\Services;

use App\Models\Discount;
use App\Models\Order;
use App\Models\OrderDiscount;
use App\Models\UserDiscount;
use Carbon\Carbon;

class DiscountService
{
    public function applyVoucher(
        Order $order,
        string $code,
        int $userId
    ): float
    {
        $discount = Discount::where('code', $code)
            ->where('is_active', true)
            ->firstOrFail();

        $this->validateDiscount($discount, $order, $userId);

        $amount = $this->calculateDiscountAmount($discount, $order->total_amount);

        // simpan ke order_discounts
        OrderDiscount::create([
            'order_id'    => $order->id,
            'discount_id' => $discount->id,
            'amount'      => $amount,
        ]);

        // update total order
        $order->update([
            'total_amount' => max(0, $order->total_amount - $amount),
        ]);

        // tandai voucher dipakai user
        UserDiscount::updateOrCreate(
            [
                'user_id'     => $userId,
                'discount_id' => $discount->id,
            ],
            [
                'used_at' => Carbon::now(),
            ]
        );

        // update quota
        if ($discount->quota !== null) {
            $discount->increment('used');
        }

        return $amount;
    }

    protected function validateDiscount(
        Discount $discount,
        Order $order,
        int $userId
    ): void
    {
        $now = Carbon::now();

        if ($discount->starts_at && $now->lt($discount->starts_at)) {
            throw new \Exception('Voucher belum berlaku');
        }

        if ($discount->ends_at && $now->gt($discount->ends_at)) {
            throw new \Exception('Voucher sudah kadaluarsa');
        }

        if ($discount->quota !== null && $discount->used >= $discount->quota) {
            throw new \Exception('Voucher sudah habis');
        }

        if ($discount->min_order_amount &&
            $order->total_amount < $discount->min_order_amount) {
            throw new \Exception('Minimal pembelian tidak terpenuhi');
        }

        if (UserDiscount::where('user_id', $userId)
            ->where('discount_id', $discount->id)
            ->whereNotNull('used_at')
            ->exists()) {
            throw new \Exception('Voucher sudah pernah digunakan');
        }
    }

    protected function calculateDiscountAmount(
        Discount $discount,
        float $orderTotal
    ): float
    {
        if ($discount->type === 'percentage') {
            $amount = $orderTotal * ($discount->value / 100);
        } else {
            $amount = $discount->value;
        }

        if ($discount->max_discount) {
            $amount = min($amount, $discount->max_discount);
        }

        return round($amount, 2);
    }
}
