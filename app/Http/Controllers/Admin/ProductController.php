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
use Illuminate\Support\Facades\Storage;

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
            $images = is_array($images) ? $images : [$images];

            foreach ($images as $image) {
                $originalFilename = $image->getClientOriginalName();
                $filename = time() . '_' . Str::random(10) . '.' . $image->getClientOriginalExtension();
                $path = $image->storeAs('public/media', $filename);

                $url = Storage::url($path);

                $media = Media::create([
                    'filename' => $filename,
                    'original_filename' => $originalFilename,
                    'mime_type' => $image->getMimeType() || 'image/jpeg',
                    'path' => $path,
                    'url' => $url,
                    'size' => $image->getSize(),
                ]);

                $mediaIds[] = [
                    'id' => $media->id,
                    'url' => $url
                ];
            }
            return Session::flash('responseData', $mediaIds);
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
    public  function update(ProductStoreRequest $request, $product_slug)
    {
        $product = Product::where('slug', $product_slug)->firstOrFail();
        $product->update($request->all());
        return redirect()->back()->with('success', 'Product updated successfully');
    }


    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->back()->with('success', 'Product deleted successfully');
    }
}
