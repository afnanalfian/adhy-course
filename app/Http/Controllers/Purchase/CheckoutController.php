<?php

namespace App\Http\Controllers\Purchase;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Order;
use App\Models\Payment;
use App\Models\PaymentSetting;
use App\Services\CheckoutService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CheckoutController extends Controller
{
    /**
     * Proses checkout (cart → order)
     */
    public function checkout(
        Request $request,
        CheckoutService $checkoutService
    ) {
        $cart = Cart::where('user_id', $request->user()->id)
            ->where('status', 'active')
            ->with('items')
            ->firstOrFail();

        $order = $checkoutService->checkout($cart);

        return redirect()->route('checkout.show', $order);
    }

    /**
     * Halaman pembayaran (QRIS)
     */
    public function show(Order $order, Request $request)
    {
        abort_if($order->user_id !== $request->user()->id, 403);
        abort_if($order->status !== 'pending', 403);

        $order->load('items.product');

        $qrisImage = PaymentSetting::where('key', 'qris_image')->value('value');
        $instruction = PaymentSetting::where('key', 'payment_instruction')->value('value');

        return view('purchase.checkout.show', compact(
            'order',
            'qrisImage',
            'instruction'
        ));
    }

    /**
     * Upload bukti pembayaran
     */
    public function uploadProof(
        Order $order,
        Request $request
    ) {
        abort_if($order->user_id !== $request->user()->id, 403);
        abort_if($order->status !== 'pending', 403);

        $data = $request->validate([
            'proof_image' => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $path = $data['proof_image']->store(
            'payments/proofs',
            'public'
        );

        $payment = Payment::where('order_id', $order->id)->firstOrFail();

        $payment->update([
            'proof_image' => $path,
            'paid_at'     => now(),
            'status'      => 'paid',
        ]);

        return redirect()
            ->route('checkout.waiting', $order)
            ->with('success', 'Bukti pembayaran berhasil diupload');
    }

    /**
     * Halaman menunggu verifikasi
     */
    public function waiting(Order $order, Request $request)
    {
        abort_if($order->user_id !== $request->user()->id, 403);

        return view('purchase.checkout.waiting', compact('order'));
    }
}
