<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\StreamedResponse;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::latest()->paginate(10);
        return view('products.index', compact('products'));
    }

    public function create()
    {
        return view('products.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'thumbnail'    => 'nullable|image|max:2048',
            'category'     => 'required|string|max:255',
            'product' => 'required|string|max:255',
            'harga'   => 'required|integer|min:0',
        ]);

        if ($request->hasFile('thumbnail')) {
            $data['thumbnail'] = $request->file('thumbnail')->store('products', 'public');
        }

        Product::create($data);
        return redirect()->route('products.index')->with('ok','Produk berhasil ditambahkan.');
    }

    public function edit(Product $product)
    {
        return view('products.edit', compact('product'));
    }

    public function update(Request $request, Product $product)
    {
        $data = $request->validate([
            'thumbnail'    => 'nullable|image|max:2048',
            'category'     => 'required|string|max:255',
            'product' => 'required|string|max:255',
            'harga'   => 'required|integer|min:0',
        ]);

        if ($request->hasFile('thumbnail')) {
            $data['thumbnail'] = $request->file('thumbnail')->store('products', 'public');
        }

        $product->update($data);
        return redirect()->route('products.index')->with('ok','Produk diperbarui.');
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return back()->with('ok','Produk dihapus.');
    }

    // Export CSV (tanpa sku)
    public function exportCsv(): StreamedResponse
    {
        $fileName = 'products_' . now()->format('Ymd_His') . '.csv';
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename=\"$fileName\"",
        ];

        $callback = function () {
            $out = fopen('php://output', 'w');
            fputcsv($out, ['ID','Kategori','Produk','Harga','Thumbnail']);
            Product::orderBy('id')->chunk(200, function ($rows) use ($out) {
                foreach ($rows as $p) {
                    fputcsv($out, [$p->id,$p->category,$p->product_name,$p->price,$p->thumbnail]);
                }
            });
            fclose($out);
        };

        return response()->stream($callback, 200, $headers);
    }
}
