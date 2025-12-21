<?php
namespace App\Services;

use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Payment;
use App\Services\PricingService;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class CheckoutService
{
    public function checkout(Cart $cart): Order
    {
        if ($cart->status !== 'active') {
            throw new \Exception('Cart is not active');
        }

        if ($cart->items->isEmpty()) {
            throw new \Exception('Cart is empty');
        }

        return DB::transaction(function () use ($cart) {

            /** Hitung ulang total (aman) */
            $pricingService = app(PricingService::class);
            $pricingResult  = $pricingService->calculateCartTotal($cart);

            /** Buat order */
            $order = Order::create([
                'user_id'      => $cart->user_id,
                'total_amount'=> $pricingResult['total'],
                'status'       => 'pending',
                'expires_at'   => Carbon::now()->addHours(2),
            ]);

            /** Copy cart_items → order_items */
            foreach ($cart->items as $item) {
                OrderItem::create([
                    'order_id'  => $order->id,
                    'product_id'=> $item->product_id,
                    'qty'       => $item->qty,
                    'price'     => $item->price_snapshot,
                ]);
            }

            /** Buat payment (manual QRIS) */
            Payment::create([
                'order_id' => $order->id,
                'method'   => 'manual_qris',
                'status'   => 'waiting',
            ]);

            /** Tutup cart */
            $cart->update([
                'status' => 'checked_out',
            ]);

            return $order;
        });
    }
}
