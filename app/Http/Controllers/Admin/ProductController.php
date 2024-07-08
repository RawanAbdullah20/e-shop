<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Inertia\Inertia;
use illuminate\Support\Str;
use App\Http\Requests\ProductStoreRequest;
use App\Models\Media;
use Illuminate\Support\Facades\Session;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('brand', 'category', 'media')->paginate(10);
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
    public function storeImage(Request $request)
    {
        $mediaIds = [];
        if ($request->hasFile('media')) {
            $images = $request->file('media');
            foreach ($images as $image) {
                $imageName = time() . '_' . Str::random(10) . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('media'), $imageName);
                $media = Media::create([
                    'media' => 'media/' . $imageName,
                ]);
                $mediaIds[] = $media->id;
            }
            return   Session::flash('responseData', $mediaIds);
        } else {
            return response()->json(['error' => 'No files uploaded'], 400);
        }
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
