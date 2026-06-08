<?php

namespace App\Http\Controllers\AdminDashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $query = Category::with(['parent', 'creator', 'updater']);
        if ($request->filled('parent_id')) {
            $query->where('parent_id', $request->parent_id);
        }
        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }
        $sort = $request->get('sort', 'id');
        $direction = $request->get('direction', 'asc');
        $query->orderBy($sort, $direction);
        $categories = $query->get();
        $categoryList = Category::all();
        return view('admin.dashboard.categories', ['categories' => $categories, 'sort' => $sort, 'direction' => $direction, 'categoryList' => $categoryList]);
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
     * @throws \Throwable
     */
    public function store(CategoryRequest $request)
    {
        $validated = $request->validated();
        $validated['created_by'] = auth()->id();
        if ($request->hasFile('thumbnail_url')) {
            $image = $request->file('thumbnail_url');
            $imageName = uniqid() . '.' . $image->getClientOriginalExtension();
            $path = $image->storeAs('categories', $imageName, 'public');
            $validated['thumbnail_url'] = $path;
        }
        if ($request->hasFile('meta_image')) {
            $metaImage = $request->file('meta_image');
            $metaImageName = uniqid() . '_meta.' . $metaImage->extension();
            $metaPath = $metaImage->storeAs('meta-images/categories', $metaImageName, 'public');

            $validated['meta_image'] = $metaPath;
        } else {
            $validated['meta_image'] = $validated['thumbnail_url'] ?? null;
        }
        Category::create($validated);
        return response()->json([
            'success' => true,
        ]);
    }

    public function list()
    {
        $categoryList = Category::with('parent')->get();
        return response()->json([
            'status' => 'success',
            'categoryList' => $categoryList
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
    public function update(CategoryRequest $request, string $id)
    {
        $category = Category::findOrFail($id);
        $validated = $request->validated();
        $validated['updated_by'] = auth()->id();
        if ($request->hasFile('thumbnail_url')) {
            if ($category->thumbnail_url) {
                Storage::disk('public')->delete($category->thumbnail_url);
            }
            $image = $request->file('thumbnail_url');
            $imageName = uniqid() . '.' . $image->getClientOriginalExtension();
            $path = $image->storeAs('categories', $imageName, 'public');
            $validated['thumbnail_url'] = $path;
        }
        if ($request->hasFile('meta_image')) {
            if ($category->meta_image){
                Storage::disk('public')->delete($category->meta_image);
            }
            $metaImage = $request->file('meta_image');
            $metaImageName = uniqid() . '_meta.' . $metaImage->extension();
            $metaPath = $metaImage->storeAs('meta-images/categories', $metaImageName, 'public');

            $validated['meta_image'] = $metaPath;
        } else {
            $validated['meta_image'] = $validated['thumbnail_url'] ?? null;
        }
        $category->update($validated);
        return response()->json([
            'success' => true,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        if ($category->thumbnail_url) {
            Storage::disk('public')->delete($category->thumbnail_url);
        }
        if ($category->meta_image) {
            Storage::disk('public')->delete($category->meta_image);
        }
        $category->delete();
        return response()->json([
            'success' => true,
        ]);
    }
}
