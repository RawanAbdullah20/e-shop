<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Http\Request;
use Inertia\Inertia;

class BrandController extends Controller
{
    public function index()
    {
        $brands = Brand::paginate(10);
        return Inertia::render(
            'Admin/Brand/Index',
            [
                'brands' => $brands,
                'title' => 'Brands Page'
            ]
        );
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);
        Brand::create($request->all());
        return redirect()->back()->with('success', 'Brand Created successfully');
    }

    public function update(Request $request, Brand $brand)
    {
        $brand->update($request->all());
        return redirect()->back()->with('success', 'Brand updated successfully');
    }
    public function destroy(Brand $brand)
    {
        $brand->delete();
        return redirect()->back()->with('success', 'Brand deleted successfully');
    }
}
