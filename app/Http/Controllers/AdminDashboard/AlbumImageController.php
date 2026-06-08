<?php

namespace App\Http\Controllers\AdminDashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\AlbumImageRequest;
use App\Models\Album;
use App\Models\AlbumImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class AlbumImageController extends Controller
{
    public function index(Request $request): View
    {
        $query = AlbumImage::with(['album', 'creator', 'updater']);
        if ($request->filled('album_id')) {
            $query->where('album_id', $request->album_id);
        }
        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }
        $sort = $request->get('sort', 'id');
        $direction = $request->get('direction', 'asc');
        $query->orderBy($sort, $direction);
        $albumImages = $query->get();
        $albumImagesList = AlbumImage::all();
        return view('admin.dashboard.album-images', ['albumImages' => $albumImages, 'sort' => $sort, 'direction' => $direction, 'albumImagesList' => $albumImagesList]);
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
    public function store(AlbumImageRequest $request)
    {
        $validated = $request->validated();
        $validated['created_by'] = auth()->id();
        if ($request->hasFile('url')) {
            $image = $request->file('url');
            $imageName = uniqid() . '.' . $image->extension();
            $path = $image->storeAs('album-images', $imageName, 'public');
            $validated['url'] = $path;
            $validated['meta_url'] = $path;
        }
        $albumImage = AlbumImage::create($validated);
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
    public function update(AlbumImageRequest $request, string $id)
    {
        $albumImage = AlbumImage::findOrFail($id);
        $validated = $request->validated();
        $validated['updated_by'] = auth()->id();
        if ($request->hasFile('url')) {
            if ($albumImage->url) {
                Storage::disk('public')->delete($albumImage->url);
            }
            $image = $request->file('url');
            $imageName = uniqid() . '.' . $image->extension();
            $path = $image->storeAs('album-images', $imageName, 'public');
            $validated['url'] = $path;
            $validated['meta_url'] = $path;
        }
        $albumImage->update($validated);
        return response()->json([
            'success' => true,
        ]);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AlbumImage $albumImage)
    {
        if ($albumImage->url) {
            Storage::disk('public')->delete($albumImage->url);
        }
        $albumImage->delete();

    }
}
