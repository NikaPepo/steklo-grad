<?php

namespace App\Http\Controllers\AdminDashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\ServiceRequest;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class ServiceController extends Controller
{
    public function index(Request $request): View
    {
        $query = Service::with(['updater', 'creator']);
        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }
        $sort = $request->get('sort', 'id');
        $direction = $request->get('direction', 'asc');
        $query->orderBy($sort, $direction);
        $services = $query->get();
        return view('admin.dashboard.services', ['services' => $services, 'sort' => $sort, 'direction' => $direction]);
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
    public function store(ServiceRequest $request)
    {
        $validated = $request->validated();
        $validated['created_by'] = auth()->id();
        if ($request->hasFile('thumbnail_url')) {
            $file = $request->file('thumbnail_url');
            $filename = uniqid() . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('services/thumbnails', $filename, 'public');
            $validated['thumbnail_url'] = $path;
        }
        if ($request->hasFile('image_url')) {
            $file = $request->file('image_url');
            $filename = uniqid() . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('services/images', $filename, 'public');
            $validated['image_url'] = $path;
        }
        if ($request->hasFile('meta_image')) {
            $metaImage = $request->file('meta_image');
            $metaImageName = uniqid() . '_meta.' . $metaImage->extension();
            $metaPath = $metaImage->storeAs('meta-images/services', $metaImageName, 'public');
            $validated['meta_image'] = $metaPath;
        } else {
            $validated['meta_image'] = $validated['image_url'] ?? null;
        }
        $service = Service::create($validated);
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
    public function update(ServiceRequest $request, string $id)
    {
        $service = Service::findOrFail($id);
        $validated = $request->validated();
        $validated['updated_by'] = auth()->id();
        if ($request->hasFile('thumbnail_url')) {
            if ($service->thumbnail_url) {
                Storage::disk('public')->delete($service->thumbnail_url);
            }
            $file = $request->file('thumbnail_url');
            $filename = uniqid() . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('services/thumbnails', $filename, 'public');
            $validated['thumbnail_url'] = $path;
        }
        if ($request->hasFile('image_url')) {
            if ($service->image_url) {
                Storage::disk('public')->delete($service->image_url);
            }
            $file = $request->file('image_url');
            $filename = uniqid() . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('services/images', $filename, 'public');
            $validated['image_url'] = $path;
        }
        if ($request->hasFile('meta_image')) {
            if ($service->meta_image){
                Storage::disk('public')->delete($service->meta_image);
            }
            $metaImage = $request->file('meta_image');
            $metaImageName = uniqid() . '_meta.' . $metaImage->extension();
            $metaPath = $metaImage->storeAs('meta-images/services', $metaImageName, 'public');
            $validated['meta_image'] = $metaPath;
        } else {
            $validated['meta_image'] = $validated['image_url'] ?? null;
        }
        $service->update($validated);
        return response()->json([
            'success' => true,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Service $service)
    {
        if ($service->thumbnail_url) {
            Storage::disk('public')->delete($service->thumbnail_url);
        }
        if ($service->image_url) {
            Storage::disk('public')->delete($service->image_url);
        }
        if ($service->meta_image) {
            Storage::disk('public')->delete($service->meta_image);
        }
        $service->delete();
        return response()->json([
            'status' => 'success',
        ]);
    }
}
