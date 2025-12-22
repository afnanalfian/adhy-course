<?php

namespace App\Http\Controllers\Purchase;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with(['user', 'payment'])
            ->whereIn('status', ['pending', 'paid'])
            ->orderBy('created_at', 'asc')
            ->get();

        return view('purchase.orders.index', compact('orders'));
    }

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
     * ACC pembayaran (AMAN dari double verify)
     */
    public function approve(Request $request, Order $order)
    {
        DB::transaction(function () use ($order, $request) {

            $order = Order::where('id', $order->id)
                ->lockForUpdate()
                ->first();

            if ($order->status !== 'pending') {
                abort(409, 'Order sudah diproses');
            }

            $order->payment()->update([
                'status'       => 'verified',
                'verified_at'  => now(),
                'verified_by'  => $request->user()->id,
            ]);

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
        DB::transaction(function () use ($order) {

            $order = Order::where('id', $order->id)
                ->lockForUpdate()
                ->first();

            if (! in_array($order->status, ['pending', 'paid'])) {
                abort(409, 'Order tidak bisa ditolak');
            }

            $order->payment()->update([
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
