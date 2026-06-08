<?php

namespace App\Http\Controllers\AdminDashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class ProductController extends Controller
{
    public function index(Request $request): View
    {
        $query = Product::with(['category', 'creator', 'updater']);
        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }
        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }
        $sort = $request->get('sort', 'id');
        $direction = $request->get('direction', 'asc');
        $query->orderBy($sort, $direction);
        $products = $query->get();
        $productWithCategoryList = Product::with('category')->get();

        return view('admin.dashboard.products', ['products' => $products, 'sort' => $sort, 'direction' => $direction, 'productWithCategoryList' => $productWithCategoryList]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductRequest $request)
    {
        $validated = $request->validated();
        $validated['created_by'] = auth()->id();

        if ($request->hasFile('image_url')) {
            $image = $request->file('image_url');
            $imageName = uniqid() . '.' . $image->getClientOriginalExtension();
            $path = $image->storeAs('products', $imageName, 'public');
            $validated['image_url'] = $path;
        }
        if ($request->hasFile('meta_image')) {
            $metaImage = $request->file('meta_image');
            $metaImageName = uniqid() . '_meta.' . $metaImage->extension();
            $metaPath = $metaImage->storeAs('meta-images/products', $metaImageName, 'public');

            $validated['meta_image'] = $metaPath;
        } else {
            $validated['meta_image'] = $validated['image_url'] ?? null;
        }

        $product = Product::create($validated);
        return response()->json([
            'success' => true,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductRequest $request, string $id)
    {

        $product = Product::findOrFail($id);
        $validated = $request->validated();
        $validated['updated_by'] = auth()->id();
        if ($request->hasFile('image_url')) {
            if ($product->image_url) {
                Storage::disk('public')->delete($product->image_url);
            }
            $image = $request->file('image_url');
            $imageName = uniqid() . '.' . $image->getClientOriginalExtension();
            $path = $image->storeAs('products', $imageName, 'public');
            $validated['image_url'] = $path;
        }
        if ($request->hasFile('meta_image')) {
            if ($product->meta_image){
                Storage::disk('public')->delete($product->meta_image);
            }
            $metaImage = $request->file('meta_image');
            $metaImageName = uniqid() . '_meta.' . $metaImage->extension();
            $metaPath = $metaImage->storeAs('meta-images/products', $metaImageName, 'public');

            $validated['meta_image'] = $metaPath;
        } else {
            $validated['meta_image'] = $validated['image_url'] ?? null;
        }
        $product->update($validated);
        return response()->json([
            'success' => true,
        ]);
    }
    public function parentList()
    {
        $parentList = Category::doesntHave('children')->with('parent')->get()->map(function ($cat) {
            return [
                'id' => $cat->id,
                'name' => $cat->parent ? "{$cat->name} / {$cat->parent->name}" : $cat->name
            ];
        });
    return response()->json([
        'status' => 'success',
        'parentList' => $parentList
    ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        if (isset($product->image_url)) {
            Storage::disk('public')->delete($product->image_url);
        }
        if ($product->meta_image) {
            Storage::disk('public')->delete($product->meta_image);
        }
        $product->delete();
    }
}
