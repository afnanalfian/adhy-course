<?php

namespace App\Services;

use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Payment;
use Illuminate\Support\Facades\DB;
use Exception;

class CheckoutService
{
    public function checkout(Cart $cart): Order
    {
        if ($cart->status !== 'active') {
            throw new Exception('Cart bukan active');
        }

        if ($cart->items->isEmpty()) {
            throw new Exception('Cart kosong');
        }

        return DB::transaction(function () use ($cart) {

            /**
             * RELOAD CART ITEMS
             * Pastikan snapshot sudah ada
             */
            $cart->load('items.product');

            $total = 0;

            foreach ($cart->items as $item) {
                $total += ($item->price_snapshot * $item->qty);
            }

            /**
             * CREATE ORDER
             */
            $order = Order::create([
                'user_id'      => $cart->user_id,
                'total_amount' => $total,
                'status'       => 'pending',
                'expires_at'   => now()->addHours(2),
            ]);

            /**
             * SNAPSHOT CART ITEMS → ORDER ITEMS
             */
            foreach ($cart->items as $item) {
                OrderItem::create([
                    'order_id'   => $order->id,
                    'product_id' => $item->product_id,
                    'qty'        => $item->qty,
                    'price'      => $item->price_snapshot,
                ]);
            }

            /**
             * PAYMENT RECORD
             */
            Payment::create([
                'order_id' => $order->id,
                'method'   => 'manual_qris',
                'status'   => 'waiting',
            ]);

            /**
             * CLOSE CART
             */
            $cart->update([
                'status' => 'checked_out',
            ]);

            return $order;
        });
    }
}
