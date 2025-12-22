<?php

namespace App\Http\Controllers\Purchase;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
use App\Models\UserEntitlement;
use App\Services\PricingService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    /**
     * Tampilkan cart aktif user
     */
    public function show(Request $request)
    {
        $cart = $this->getActiveCart($request->user()->id);
        $cart->load('items.product');

        $subtotal = 0;

        foreach ($cart->items as $item) {
            $subtotal += ($item->price_snapshot * $item->qty);
        }

        return view('purchase.cart.show', compact(
            'cart',
            'subtotal'
        ));
    }


    /**
     * Add product ke cart
     */
    public function add(Request $request, Product $product, PricingService $pricingService)
    {
        $userId = $request->user()->id;

        if ($this->alreadyOwned($userId, $product)) {
            return back()->withErrors('Produk sudah kamu miliki.');
        }

        $cart = $this->getActiveCart($userId);

        DB::transaction(function () use ($request, $product, $cart, $pricingService) {

            $qty = (int) $request->input('qty', 1);

            // hitung harga satuan dulu
            $unitPrice = $pricingService->determineUnitPrice(
                $product->type,
                $qty
            );

            CartItem::updateOrCreate(
                [
                    'cart_id'    => $cart->id,
                    'product_id' => $product->id,
                ],
                [
                    'qty'            => $qty,
                    'price_snapshot' => $unitPrice,
                ]
            );
        });

        return redirect()
            ->route('cart.show')
            ->with('success', 'Produk berhasil ditambahkan ke cart');
    }


    /**
     * Update qty item di cart
     */
    public function updateQty(
        Request $request,
        CartItem $cartItem,
        PricingService $pricingService
    ) {
        $this->authorizeCartItem($request->user()->id, $cartItem);

        $qty = (int) $request->validate([
            'qty' => 'required|integer|min:1'
        ])['qty'];

        DB::transaction(function () use ($cartItem, $qty, $pricingService) {

            $product = $cartItem->product;

            // hitung harga baru
            $unitPrice = $pricingService->determineUnitPrice(
                $product->type,
                $qty
            );

            // update qty + snapshot
            $cartItem->update([
                'qty'            => $qty,
                'price_snapshot' => $unitPrice,
            ]);
        });

        return back()->with('success', 'Jumlah item diperbarui');
    }


    /**
     * Remove item dari cart
     */
    public function remove(Request $request, CartItem $cartItem)
    {
        $this->authorizeCartItem($request->user()->id, $cartItem);

        DB::transaction(function () use ($cartItem) {
            $cartItem->delete();
        });

        return back()->with('success', 'Item dihapus dari cart');
    }



    /* =======================================================
       INTERNAL HELPERS
       ======================================================= */

    protected function getActiveCart(int $userId): Cart
    {
        return Cart::firstOrCreate([
            'user_id' => $userId,
            'status'  => 'active',
        ]);
    }


    protected function alreadyOwned(int $userId, Product $product): bool
    {
        $ids = $product->productables()->pluck('productable_id');

        if ($ids->isEmpty()) {
            return false;
        }

        return UserEntitlement::where('user_id', $userId)
            ->where('entitlement_type', $this->mapType($product->type))
            ->whereIn('entitlement_id', $ids)
            ->exists();
    }


    protected function mapType(string $type): string
    {
        return match ($type) {
            'meeting'        => 'meeting',
            'course_package' => 'course',
            'tryout'         => 'tryout',
            'addon'          => 'quiz',
        };
    }


    protected function authorizeCartItem(int $userId, CartItem $cartItem): void
    {
        abort_if(
            $cartItem->cart->user_id !== $userId,
            403
        );
    }
}
