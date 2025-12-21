<?php

namespace App\Http\Controllers\Purchase;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    /**
     * List order masuk (admin)
     */
    public function index()
    {
        $orders = Order::with(['user', 'payment'])
            ->whereIn('status', ['pending', 'paid'])
            ->orderBy('created_at', 'asc')
            ->get();

        return view('purchase.orders.index', compact('orders'));
    }

    /**
     * Detail order + bukti bayar
     */
    public function show(Order $order)
    {
        $order->load([
            'user',
            'items.product',
            'payment.verifier'
        ]);

        return view('purchase.orders.show', compact('order'));
    }

    /**
     * ACC pembayaran
     * ➜ trigger OrderObserver
     */
    public function approve(Request $request, Order $order)
    {
        if ($order->status !== 'pending') {
            return back()->withErrors('Order tidak bisa diverifikasi');
        }

        DB::transaction(function () use ($order, $request) {

            /** Update payment */
            $order->payment->update([
                'status'       => 'verified',
                'verified_at'  => now(),
                'verified_by'  => $request->user()->id,
            ]);

            /** Update order */
            $order->update([
                'status' => 'verified',
            ]);
        });

        return redirect()
            ->route('orders.index')
            ->with('success', 'Pembayaran berhasil diverifikasi');
    }

    /**
     * Tolak pembayaran
     */
    public function reject(Request $request, Order $order)
    {
        if (! in_array($order->status, ['pending', 'paid'])) {
            return back()->withErrors('Order tidak bisa ditolak');
        }

        DB::transaction(function () use ($order) {

            $order->payment->update([
                'status' => 'rejected',
            ]);

            $order->update([
                'status' => 'rejected',
            ]);
        });

        return redirect()
            ->route('orders.index')
            ->with('success', 'Pembayaran ditolak');
    }
}
