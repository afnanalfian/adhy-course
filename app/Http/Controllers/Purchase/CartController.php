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

        $subtotal = $cart->items->sum(function ($item) {
            return $item->price_snapshot * $item->qty;
        });

        return view('purchase.cart.show', compact('cart', 'subtotal'));
    }

    /**
     * Add product ke cart
     */
    public function add(Request $request, Product $product, PricingService $pricingService)
    {
        $userId = $request->user()->id;

        // tidak boleh beli ulang
        if ($this->alreadyOwned($userId, $product)) {
            return back()->withErrors('Produk sudah kamu miliki.');
        }

        $cart = $this->getActiveCart($userId);

        DB::beginTransaction();

        try {
            $qty = (int) $request->input('qty', 1);

            $price = $pricingService->calculate(
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
                    'price_snapshot' => $price,
                ]
            );

            DB::commit();

            return redirect()
                ->route('cart.show')
                ->with('success', 'Produk berhasil ditambahkan ke cart');

        } catch (\Throwable $e) {
            DB::rollBack();
            throw $e;
        }
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

        $price = $pricingService->calculate(
        $cartItem->product->type,
        $qty
        );

        $cartItem->update([
            'qty'            => $qty,
            'price_snapshot' => $price,
        ]);

        return back()->with('success', 'Jumlah item diperbarui');
    }

    /**
     * Remove item dari cart
     */
    public function remove(Request $request, CartItem $cartItem)
    {
        $this->authorizeCartItem($request->user()->id, $cartItem);

        $cartItem->delete();

        return back()->with('success', 'Item dihapus dari cart');
    }

    /* =======================================================
       ================ INTERNAL HELPERS =====================
       ======================================================= */

    protected function getActiveCart(int $userId): Cart
    {
        return Cart::firstOrCreate(
            [
                'user_id' => $userId,
                'status'  => 'active',
            ]
        );
    }

    protected function alreadyOwned(int $userId, Product $product): bool
    {
        foreach ($product->productables as $productable) {
            if (UserEntitlement::where('user_id', $userId)
                ->where('entitlement_type', $this->mapType($product->type))
                ->where('entitlement_id', $productable->productable_id)
                ->exists()) {
                return true;
            }
        }
        return false;
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
