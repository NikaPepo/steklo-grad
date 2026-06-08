<?php

namespace App\Http\Controllers\AdminDashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\AlbumRequest;
use App\Models\Album;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;

class AlbumController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Album::with(['creator', 'updater']);
        if ($request->search) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }
        $sort = $request->get('sort', 'id');
        $direction = $request->get('direction', 'asc');
        $query->orderBy($sort, $direction);
        $albums = $query->get();
        return view('admin.dashboard.albums', ['albums' => $albums, 'sort' => $sort, 'direction' => $direction]);
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
    public function store(AlbumRequest $request)
    {
        $validated = $request->validated();
        $validated['created_by'] = auth()->id();
        $validated['is_visible'] = $request->has('is_visible');
        $validated['is_video'] = $request->has('is_video');
        if ($request->hasFile('video_url')) {
            $video = $request->file('video_url');
            $uploaded = Cloudinary::uploadApi()->upload(
                $video->getRealPath(),
                [
                    'resource_type' => 'video',
                    'folder' => 'albums/videos',
                ]
            );

            $publicId = $uploaded['public_id'];
            $validated['video_url'] = $uploaded['secure_url'];

            $cloudName = config('services.cloudinary.cloud_name')
                ?? parse_url(env('CLOUDINARY_URL'), PHP_URL_HOST);

            $validated['thumbnail_url'] =
                "https://res.cloudinary.com/{$cloudName}/video/upload/" .
                "so_1,c_fit,w_1280,h_720,f_jpg,q_90/" .
                $publicId . ".jpg";
        }
        if ($request->hasFile('thumbnail_url') && !$request->has('video_url')) {
            $thumbnail = $request->file('thumbnail_url');
            $imageName = uniqid() . '.' . $thumbnail->getClientOriginalExtension();
            $path = $thumbnail->storeAs('albums', $imageName, 'public');
            $validated['thumbnail_url'] = $path;
        }
        $album = Album::create($validated);
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

    public function list()
    {
        $albums = Album::all();
        return response()->json([
            'status' => 'success',
            'albums' => $albums
        ]);
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
    public function update(AlbumRequest $request, string $id)
    {
        $album = Album::findOrFail($id);
        $validated = $request->validated();
        $validated['is_visible'] = $request->has('is_visible');
        $validated['is_video'] = $request->has('is_video');
        $validated['updated_by'] = auth()->id();
        if ($request->hasFile('thumbnail_url')) {
            if ($album->thumbnail_url) {
                Storage::disk('public')->delete($album->thumbnail_url);
            }
            $thumbnail = $request->file('thumbnail_url');
            $imageName = uniqid() . '.' . $thumbnail->getClientOriginalExtension();
            $path = $thumbnail->storeAs('albums', $imageName, 'public');
            $validated['thumbnail_url'] = $path;
        }
        if ($request->hasFile('video_url')) {

            $video = $request->file('video_url');

            if (!empty($album->video_url)) {

                preg_match('/\/upload\/(?:v\d+\/)?(.+)\.\w+$/', $album->video_url, $matches);

                if (!empty($matches[1])) {
                    Cloudinary::uploadApi()->destroy($matches[1], [
                        'resource_type' => 'video',
                    ]);
                }
            }

            $uploaded = Cloudinary::uploadApi()->upload(
                $video->getRealPath(),
                [
                    'resource_type' => 'video',
                    'folder' => 'albums/videos',
                ]
            );

            $publicId = $uploaded['public_id'];
            $validated['video_url'] = $uploaded['secure_url'];
            $cloudName = config('services.cloudinary.cloud_name')
                ?? parse_url(env('CLOUDINARY_URL'), PHP_URL_HOST);

            $validated['thumbnail_url'] =
                "https://res.cloudinary.com/{$cloudName}/video/upload/" .
                "so_1,c_fit,w_1280,h_720,f_jpg,q_90/" .
                $publicId . ".jpg";
        }
        $album->update($validated);
        return response()->json([
            'success' => true,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Album $album)
    {
        if ($album->thumbnail_url && !str_contains($album->thumbnail_url, 'res.cloudinary.com')) {
            Storage::disk('public')->delete($album->thumbnail_url);
        }
        if ($album->video_url) {

            preg_match('/\/upload\/(?:v\d+\/)?(.+)\.\w+$/', $album->video_url, $matches);

            if (!empty($matches[1])) {
                Cloudinary::uploadApi()->destroy($matches[1], [
                    'resource_type' => 'video',
                ]);
            }
        }
        $album->delete();
    }
}
