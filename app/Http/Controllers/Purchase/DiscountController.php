<?php

namespace App\Http\Controllers\Purchase;

use App\Http\Controllers\Controller;
use App\Models\Discount;
use App\Models\Product;
use Illuminate\Http\Request;

class DiscountController extends Controller
{
    /**
     * List semua discount
     */
    public function index()
    {
        $discounts = Discount::orderByDesc('created_at')->get();

        return view('purchase.discounts.index', compact('discounts'));
    }

    /**
     * Form tambah discount
     */
    public function create()
    {
        $products = Product::where('is_active', true)->get();

        return view('purchase.discounts.create', compact('products'));
    }

    /**
     * Simpan discount baru
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name'              => 'required|string|max:255',
            'code'              => 'nullable|string|max:50|unique:discounts,code',
            'type'              => 'required|in:percentage,fixed',
            'value'             => 'required|numeric|min:0',
            'max_discount'      => 'nullable|numeric|min:0',
            'min_order_amount'  => 'nullable|numeric|min:0',
            'quota'             => 'nullable|integer|min:1',
            'starts_at'         => 'nullable|date',
            'ends_at'           => 'nullable|date|after:starts_at',
            'is_active'         => 'boolean',
            'product_ids'       => 'array',
            'product_ids.*'     => 'exists:products,id',
        ]);

        $discount = Discount::create($data);

        // attach ke product (jika ada)
        foreach ($data['product_ids'] ?? [] as $productId) {
            $discount->discountables()->create([
                'discountable_type' => Product::class,
                'discountable_id'   => $productId,
            ]);
        }

        return redirect()
            ->route('discounts.index')
            ->with('success', 'Discount berhasil dibuat');
    }

    /**
     * Form edit discount
     */
    public function edit(Discount $discount)
    {
        $products = Product::where('is_active', true)->get();
        $discount->load('discountables');

        return view(
            'purchase.discounts.edit',
            compact('discount', 'products')
        );
    }

    /**
     * Update discount
     */
    public function update(Request $request, Discount $discount)
    {
        $data = $request->validate([
            'name'              => 'required|string|max:255',
            'code'              => 'nullable|string|max:50|unique:discounts,code,' . $discount->id,
            'type'              => 'required|in:percentage,fixed',
            'value'             => 'required|numeric|min:0',
            'max_discount'      => 'nullable|numeric|min:0',
            'min_order_amount'  => 'nullable|numeric|min:0',
            'quota'             => 'nullable|integer|min:1',
            'starts_at'         => 'nullable|date',
            'ends_at'           => 'nullable|date|after:starts_at',
            'is_active'         => 'boolean',
            'product_ids'       => 'array',
            'product_ids.*'     => 'exists:products,id',
        ]);

        $discount->update($data);

        // sync discountables
        $discount->discountables()->delete();

        foreach ($data['product_ids'] ?? [] as $productId) {
            $discount->discountables()->create([
                'discountable_type' => Product::class,
                'discountable_id'   => $productId,
            ]);
        }

        return redirect()
            ->route('discounts.index')
            ->with('success', 'Discount berhasil diperbarui');
    }

    /**
     * Nonaktifkan discount
     */
    public function destroy(Discount $discount)
    {
        $discount->update([
            'is_active' => false,
        ]);

        return back()->with('success', 'Discount dinonaktifkan');
    }

    /**
     * Toggle aktif / nonaktif
     */
    public function toggle(Discount $discount)
    {
        $discount->update([
            'is_active' => ! $discount->is_active,
        ]);

        return back()->with('success', 'Status discount diperbarui');
    }
}

