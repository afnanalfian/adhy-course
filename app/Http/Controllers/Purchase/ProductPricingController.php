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
        $data = $request->validate([
            'product_type'   => 'required|in:meeting,tryout,course_package,addon',
            'min_qty'        => 'required|integer|min:1',
            'max_qty'        => 'nullable|integer|gte:min_qty',
            'price_per_unit' => 'nullable|numeric|min:0',
            'fixed_price'    => 'nullable|numeric|min:0',
            'is_active'      => 'boolean',
        ]);

        // validasi bisnis
        if (! $data['price_per_unit'] && ! $data['fixed_price']) {
            return back()
                ->withErrors('Harus mengisi price per unit atau fixed price')
                ->withInput();
        }

        PricingRule::create($data);

        return redirect()
            ->route('purchase.pricing.index')
            ->with('success', 'Pricing rule berhasil ditambahkan');
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
        $data = $request->validate([
            'min_qty'        => 'required|integer|min:1',
            'max_qty'        => 'nullable|integer|gte:min_qty',
            'price_per_unit' => 'nullable|numeric|min:0',
            'fixed_price'    => 'nullable|numeric|min:0',
            'is_active'      => 'boolean',
        ]);

        if (! $data['price_per_unit'] && ! $data['fixed_price']) {
            return back()
                ->withErrors('Harus mengisi price per unit atau fixed price')
                ->withInput();
        }

        $pricingRule->update($data);

        return redirect()
            ->route('purchase.pricing.index')
            ->with('success', 'Pricing rule berhasil diperbarui');
    }

    /**
     * Nonaktifkan pricing rule
     */
    public function destroy(PricingRule $pricingRule)
    {
        $pricingRule->update([
            'is_active' => false,
        ]);

        return redirect()
            ->route('purchase.pricing.index')
            ->with('success', 'Pricing rule dinonaktifkan');
    }

    /**
     * Toggle aktif / nonaktif
     */
    public function toggle(PricingRule $pricingRule)
    {
        $pricingRule->update([
            'is_active' => ! $pricingRule->is_active,
        ]);

        return redirect()
            ->route('pricing.index')
            ->with('success', 'Status pricing rule diperbarui');
    }
}
