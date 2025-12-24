<?php

namespace App\Http\Controllers\Purchase;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
use App\Models\Meeting;
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
    protected function cartHasCourse($cart): bool
    {
        return $cart->items()
            ->whereHas('product', fn ($q) =>
                $q->where('type', 'course_package')
            )
            ->exists();
    }

    /**
     * Add product ke cart
     */
    public function add(
        Request $request,
        Product $product,
        PricingService $pricingService
    ) {
        $userId = $request->user()->id;
        $cart   = $this->getActiveCart($userId);

        /**
         * 0. SUDAH DIMILIKI
         */
        if ($this->alreadyOwned($userId, $product)) {
            return response()->json([
                'message' => 'Produk ini sudah kamu miliki'
            ], 422);
        }

        /**
         * 1. BLOK TRYOUT JIKA SUDAH ADA COURSE PACKAGE
         *    (karena tryout GLOBAL)
         */
        if (
            $product->type === 'tryout' &&
            $cart->items()
                ->whereHas('product', fn ($q) =>
                    $q->where('type', 'course_package')
                )
                ->exists()
        ) {
            return response()->json([
                'message' => 'Tryout sudah termasuk dalam Full Course'
            ], 422);
        }

        /**
         * 2. BLOK MEETING JIKA COURSE YANG SAMA SUDAH ADA
         */
        if ($product->type === 'meeting') {

            $meeting = $product->productable?->productable; // Meeting model
            $courseId = $meeting?->course_id;

            if ($courseId) {
                $hasSameCourse = $cart->items()
                    ->whereHas('product', function ($q) use ($courseId) {
                        $q->where('type', 'course_package')
                        ->whereHas('productable.productable', fn ($qq) =>
                            $qq->where('id', $courseId)
                        );
                    })
                    ->exists();

                if ($hasSameCourse) {
                    return response()->json([
                        'message' => 'Meeting sudah termasuk dalam Full Course'
                    ], 422);
                }
            }
        }

        DB::transaction(function () use ($request, $product, $cart, $pricingService) {

            /**
             * 3. JIKA TAMBAH COURSE PACKAGE
             */
            if ($product->type === 'course_package') {

                $course = $product->productable?->productable; // Course model

                /**
                 * A. HAPUS MEETING COURSE INI SAJA
                 */
                if ($course) {
                    $meetingProductIds = Meeting::where('course_id', $course->id)
                        ->whereHas('product')
                        ->get()
                        ->pluck('product.product.id')
                        ->filter()
                        ->toArray();

                    if (!empty($meetingProductIds)) {
                        $cart->items()
                            ->whereIn('product_id', $meetingProductIds)
                            ->delete();
                    }
                }

                /**
                 * B. HAPUS SEMUA TRYOUT (GLOBAL)
                 */
                $tryoutProductIds = Product::where('type', 'tryout')
                    ->pluck('id')
                    ->toArray();

                if (!empty($tryoutProductIds)) {
                    $cart->items()
                        ->whereIn('product_id', $tryoutProductIds)
                        ->delete();
                }
                /**
                 * C. HAPUS ADDON QUIZ (karena course sudah include quiz)
                 */
                $addonQuizIds = Product::where('type', 'addon')->pluck('id')->toArray();

                if (! empty($addonQuizIds)) {
                    $cart->items()
                        ->whereIn('product_id', $addonQuizIds)
                        ->delete();
                }
            }

            /**
             * 4. INSERT / UPDATE ITEM
             */
            $qty = (int) $request->input('qty', 1);

            CartItem::updateOrCreate(
                [
                    'cart_id'    => $cart->id,
                    'product_id' => $product->id,
                ],
                [
                    'qty'            => $qty,
                    'price_snapshot' => 0,
                ]
            );

            /**
             * 5. REPRICE
             */
            if ($product->type === 'meeting') {

                $unitPrice = $pricingService->meetingUnitPriceFromCart($cart);

                $cart->items()
                    ->whereHas('product', fn ($q) => $q->where('type', 'meeting'))
                    ->update([
                        'price_snapshot' => $unitPrice,
                    ]);

            } else {

                $unitPrice = $pricingService->determineUnitPrice(
                    $product->type,
                    $qty
                );

                $cart->items()
                    ->where('product_id', $product->id)
                    ->update([
                        'price_snapshot' => $unitPrice,
                    ]);
            }
        });

        return response()->json([
            'cart_count' => $cart->items()->sum('qty'),
        ]);
    }

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

            $cartItem->update([
                'qty' => $qty,
            ]);

            $cart = $cartItem->cart;

            // MEETING → collective pricing
            if ($cartItem->product->type === 'meeting') {

                $unitPrice = $pricingService->meetingUnitPriceFromCart($cart);

                $cart->items()
                    ->whereHas('product', fn ($q) => $q->where('type', 'meeting'))
                    ->update([
                        'price_snapshot' => $unitPrice,
                    ]);

            } else {

                $unitPrice = $pricingService->determineUnitPrice(
                    $cartItem->product->type,
                    $qty
                );

                $cartItem->update([
                    'price_snapshot' => $unitPrice,
                ]);
            }
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
        // 1. Jika user sudah punya FULL COURSE
        if (in_array($product->type, ['meeting', 'tryout'])) {
            $hasCourse = UserEntitlement::where('user_id', $userId)
                ->where('entitlement_type', 'course')
                ->exists();

            if ($hasCourse) {
                return true;
            }
        }

        // 2. Cek entitlement normal
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
    protected function userHasQuiz(int $userId): bool
    {
        return UserEntitlement::where('user_id', $userId)
            ->where('entitlement_type', 'quiz')
            ->exists();
    }
    protected function cartHasAddonQuiz(Cart $cart): bool
    {
        return $cart->items()
            ->whereHas('product', fn ($q) =>
                $q->where('type', 'addon')
            )
            ->exists();
    }
    public function addAddonQuiz(
        Request $request,
        PricingService $pricingService
    ) {
        $user = $request->user();

        // Ambil cart aktif
        $cart = $this->getActiveCart($user->id);
        $cart->load('items.product');

        /**
         * 1️⃣ User sudah punya akses quiz
         */
        if ($this->userHasQuiz($user->id)) {
            return back()->withErrors([
                'addon' => 'Kamu sudah memiliki akses Quiz.',
            ]);
        }

        /**
         * 2️⃣ Cart memiliki course package → addon tidak boleh
         */
        if ($cart->items->contains(
            fn ($item) => $item->product->type === 'course_package'
        )) {
            return back()->withErrors([
                'addon' => 'Quiz sudah termasuk dalam paket Course.',
            ]);
        }

        /**
         * 3️⃣ Addon quiz sudah ada di cart
         */
        if ($cart->items->contains(
            fn ($item) => $item->product->type === 'addon'
        )) {
            return back()->withErrors([
                'addon' => 'Addon Quiz sudah ada di keranjang.',
            ]);
        }

        /**
         * 4️⃣ Ambil product addon
         */
        $addonProduct = Product::where('type', 'addon')->first();

        if (! $addonProduct) {
            abort(500, 'Produk Addon Quiz belum tersedia.');
        }

        /**
         * 5️⃣ Ambil harga dari PricingService (SATU-SATUNYA sumber harga)
         */
        $price = $pricingService->addonPrice();

        /**
         * 6️⃣ Simpan ke cart (qty = 1, harga FIX)
         */
        DB::transaction(function () use ($cart, $addonProduct, $price) {

            $cart->items()->create([
                'product_id'     => $addonProduct->id,
                'qty'            => 1,
                'price_snapshot' => $price,
            ]);
        });

        return back()->with('success', 'Addon Quiz berhasil ditambahkan.');
    }


}
