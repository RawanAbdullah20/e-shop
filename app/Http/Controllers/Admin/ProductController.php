<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use Inertia\Inertia;
use illuminate\Support\Str;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::paginate(10)->withQueryString();
        return Inertia::render(
            'Admin/Product/Index',
            [
                'products' => $products,

            ]
        );
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required',
            'quantity' => 'required',
            'description' => 'required',
            'price' => 'required',
            'brand_id' => 'required',
            'category_id' => 'required',
        ]);
        $product = Product::create($validated);

        if ($request->hasFile('product_images')) {
            $images = $request->file('product_images');
            foreach ($images as $image) {
                $imageName = time() . '_' . Str::random(10) . '.' . $image->getClientOriginalExtension();

                $image->move(public_path('product_images'), $imageName);

                ProductImage::create([
                    'image' => 'product_images/' . $imageName,
                    'product_id' => $product->id,
                ]);
            }
        }

        return redirect()->route('admin.products.index')->with('success', 'Product created successfully');
    }
}