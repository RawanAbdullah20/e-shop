<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
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
                'brands' => Brand::all(),
                'categories' => Category::all(),

            ]
        );
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required',
            'quantity' => 'required|numeric|min:1',
            'description' => 'required',
            'price' => 'required|numeric|min:0',
            'brand_id' => 'required|exists:brands,id',
            'category_id' => 'required|exists:categories,id',
        ]);
        $product = new Product();
        $product->title = $validated['title'];
        $product->quantity = $validated['quantity'];
        $product->description = $validated['description'];
        $product->price = $validated['price'];
        $product->brand_id = $validated['brand_id'];
        $product->category_id = $validated['category_id'];
        $product->slug = Str::slug($validated['title']);
        $product->save();

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
