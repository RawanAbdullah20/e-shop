<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Inertia\Inertia;
use App\Http\Requests\ProductStoreRequest;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('brand', 'category', 'media')->paginate(10);
        return Inertia::render(
            'Admin/Product/Index',
            [
                'products' => $products,
                'title' => 'Products Page'


            ]
        );
    }
    public function create()
    {
        return Inertia::render('Admin/Product/CreateProduct', [
            'brands' => Brand::all(),
            'categories' => Category::all(),
            'title' => 'Create Product'

        ]);
    }


    public function store(ProductStoreRequest $request)
    {
        Product::create($request->all());
        return redirect()->route('admin.products.index')->with('success', 'Product created successfully');
    }

    public function edit($product_slug)
    {
        $product = Product::where('slug', $product_slug)->with('media')->first();
        return Inertia::render('Admin/Product/EditProduct', [
            'product' => $product,
            'brands' => Brand::all(),
            'categories' => Category::all(),

        ]);
    }

    public function update(ProductStoreRequest $request, Product $product)
    {
        $product->update($request->validated());
        return redirect()->back()->with('success', 'Product updated successfully');
    }


    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->back()->with('success', 'Product deleted successfully');
    }
}
