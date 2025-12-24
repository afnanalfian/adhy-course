<?php

namespace App\Http\Controllers\Purchase;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductBonus;
use App\Models\Exam;
use Illuminate\Http\Request;

class ProductBonusController extends Controller
{
    /**
     * List bonus per product
     */
    public function index()
    {
        $products = Product::with('bonuses')
            ->orderBy('name')
            ->paginate(10);

        return view('purchase.bonuses.index', compact('products'));
    }

    /**
     * Form edit bonus untuk product
     */
    public function edit(Product $product)
    {
        $product->load('bonuses');

        $availableTryouts = Exam::where('type', 'tryout')->get();

        $bonusTypes = [
            'tryout' => 'Tryout',
            'quiz'   => 'Quiz',
            'course' => 'Course',
        ];

        return view('purchase.bonuses.edit', compact(
            'product',
            'availableTryouts',
            'bonusTypes'
        ));
    }

    /**
     * Simpan / update bonus product
     */
    public function update(Request $request, Product $product)
    {
        $data = $request->validate([
            'bonuses' => 'array',
            'bonuses.*.bonus_type' => 'required|string',
            'bonuses.*.bonus_id' => 'nullable',
        ]);

        // Hapus bonus lama
        $product->bonuses()->delete();

        foreach ($data['bonuses'] ?? [] as $bonus) {
            ProductBonus::create([
                'product_id' => $product->id,
                'bonus_type' => $bonus['bonus_type'],
                'bonus_id'   => $bonus['bonus_id'] ?? null,
            ]);
        }

        toast('success', 'Bonus product berhasil diperbarui');
        return redirect()
            ->route('bonuses.index');
    }

    /**
     * Hapus satu bonus
     */
    public function destroy(ProductBonus $productBonus)
    {
        $productBonus->delete();
        toast('info', 'Bonus berhasil dihapus');
        return back();
    }
}
