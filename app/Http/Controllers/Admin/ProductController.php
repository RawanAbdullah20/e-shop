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
use App\Http\Requests\ProductStoreRequest;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('brand', 'category', 'product_images')->paginate(10);
        return Inertia::render(
            'Admin/Product/Index',
            [
                'products' => $products,

            ]
        );
    }

    public function create()
    {
        return Inertia::render('Admin/Product/CreateProduct', [
            'brands' => Brand::all(),
            'categories' => Category::all(),
        ]);
    }
    public function store(ProductStoreRequest $request)
    {
        $request->merge(['slug' => Str::slug($request->title)]);
        $product = Product::create($request->all());
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
    public function edit($product_slug)
    {
        $product = Product::where('slug', $product_slug)->with('product_images')->first();
        return Inertia::render('Admin/Product/EditProduct', [
            'product' => $product,
            'brands' => Brand::all(),
            'categories' => Category::all(),
        ]);
    }
    public  function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'title' => 'required',
            'quantity' => 'required|numeric|min:1',
            'description' => 'required',
            'price' => 'required|numeric|min:0',
            'brand_id' => 'required|exists:brands,id',
            'category_id' => 'required|exists:categories,id',
        ]);
        $product->update($validated);

        return redirect()->back()->with('success', 'Product updated successfully');
    }


    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->back()->with('success', 'Product deleted successfully');
    }
}
