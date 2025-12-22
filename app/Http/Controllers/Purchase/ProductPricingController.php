<?php

namespace App\Http\Controllers\Purchase;

use App\Http\Controllers\Controller;
use App\Models\PricingRule;
use Illuminate\Http\Request;

class ProductPricingController extends Controller
{
    /**
     * List semua pricing rules
     */
    public function index()
    {
        $rules = PricingRule::orderBy('product_type')
            ->orderBy('min_qty')
            ->get();

        return view('purchase.pricing.index', compact('rules'));
    }

    /**
     * Form tambah pricing rule
     */
    public function create()
    {
        $productTypes = [
            'meeting'        => 'Meeting',
            'tryout'         => 'Tryout',
            'course_package' => 'Course Package',
            'addon'          => 'Addon',
        ];

        return view('purchase.pricing.create', compact('productTypes'));
    }

    /**
     * Simpan pricing rule baru
     */
    public function store(Request $request)
    {
        /**
         * =========================
         * 1. VALIDASI REQUEST
         * =========================
         */
        $data = $request->validate([
            'product_type' => 'required|in:meeting,tryout,course_package,addon',
            'pricing_type' => 'required|in:per_unit,fixed',
            'min_qty'      => 'required|integer|min:1',
            'max_qty'      => 'nullable|integer|gte:min_qty',
            'price'        => 'required|numeric|min:0',
            'is_active'    => 'sometimes|boolean',
        ]);

        /**
         * =========================
         * 2. VALIDASI OVERLAP QTY
         * =========================
         */
        $min = $data['min_qty'];
        $max = $data['max_qty'] ?? PHP_INT_MAX;

        $overlap = PricingRule::where('product_type', $data['product_type'])
            ->where('is_active', true)
            ->where(function ($q) use ($min, $max) {
                $q->where('min_qty', '<=', $max)
                ->where(function ($q) use ($min) {
                    $q->whereNull('max_qty')
                        ->orWhere('max_qty', '>=', $min);
                });
            })
            ->exists();

        if ($overlap) {
            toast('error','Range qty bertabrakan dengan pricing rule lain');
            return back()->withInput();
        }

        /**
         * =========================
         * 3. NORMALISASI DATA HARGA
         * =========================
         */
        $data['price_per_unit'] = null;
        $data['fixed_price']   = null;

        if ($data['pricing_type'] === 'per_unit') {
            $data['price_per_unit'] = $data['price'];
        }

        if ($data['pricing_type'] === 'fixed') {
            $data['fixed_price'] = $data['price'];
        }

        unset($data['pricing_type'], $data['price']);

        /**
         * =========================
         * 4. DEFAULT STATE
         * =========================
         */
        $data['is_active'] = $data['is_active'] ?? true;

        /**
         * =========================
         * 5. SIMPAN DATA
         * =========================
         */
        PricingRule::create($data);

        toast('success', 'Pricing rule berhasil ditambahkan');

        return redirect()
            ->route('pricing.index');
    }

    /**
     * Form edit pricing rule
     */
    public function edit(PricingRule $pricingRule)
    {
        $productTypes = [
            'meeting'        => 'Meeting',
            'tryout'         => 'Tryout',
            'course_package' => 'Course Package',
            'addon'          => 'Addon',
        ];

        return view(
            'purchase.pricing.edit',
            compact('pricingRule', 'productTypes')
        );
    }

    /**
     * Update pricing rule
     */
    public function update(Request $request, PricingRule $pricingRule)
    {
        /**
         * =========================
         * 1. VALIDASI REQUEST
         * =========================
         */
        $data = $request->validate([
            'pricing_type' => 'required|in:per_unit,fixed',
            'min_qty'      => 'required|integer|min:1',
            'max_qty'      => 'nullable|integer|gte:min_qty',
            'price'        => 'required|numeric|min:0',
            'is_active'    => 'sometimes|boolean',
        ]);

        /**
         * =========================
         * 2. VALIDASI OVERLAP QTY
         *    (exclude current rule)
         * =========================
         */
        $min = $data['min_qty'];
        $max = $data['max_qty'] ?? PHP_INT_MAX;

        $overlap = PricingRule::where('product_type', $pricingRule->product_type)
            ->where('id', '!=', $pricingRule->id)
            ->where('is_active', true)
            ->where(function ($q) use ($min, $max) {
                $q->where('min_qty', '<=', $max)
                ->where(function ($q) use ($min) {
                    $q->whereNull('max_qty')
                        ->orWhere('max_qty', '>=', $min);
                });
            })
            ->exists();

        if ($overlap) {
            return back()
                ->withErrors([
                    'min_qty' => 'Range qty bertabrakan dengan pricing rule lain',
                ])
                ->withInput();
        }

        /**
         * =========================
         * 3. NORMALISASI DATA HARGA
         * =========================
         */
        $data['price_per_unit'] = null;
        $data['fixed_price']   = null;

        if ($data['pricing_type'] === 'per_unit') {
            $data['price_per_unit'] = $data['price'];
        }

        if ($data['pricing_type'] === 'fixed') {
            $data['fixed_price'] = $data['price'];
        }

        unset($data['pricing_type'], $data['price']);

        /**
         * =========================
         * 4. DEFAULT STATE
         * =========================
         */
        $data['is_active'] = $data['is_active'] ?? false;

        /**
         * =========================
         * 5. UPDATE
         * =========================
         */
        $pricingRule->update($data);

        toast('success', 'Pricing rule berhasil diperbarui');
        return redirect()
            ->route('pricing.index');
    }

    /**
     * Hapus pricing rule
     */
    public function destroy(PricingRule $pricingRule)
    {
        $pricingRule->delete();

        toast('success', 'Pricing rule berhasil dihapus');
        return redirect()
            ->route('pricing.index');
    }

    /**
     * Toggle aktif / nonaktif
     */
    public function toggle(PricingRule $pricingRule)
    {
        $pricingRule->update([
            'is_active' => ! $pricingRule->is_active,
        ]);

        toast('success', 'Status pricing rule diperbarui');

        return redirect()
            ->route('pricing.index');
    }
}
