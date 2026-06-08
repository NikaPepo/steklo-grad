<?php

namespace App\Http\Controllers\AdminDashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\ReviewRequest;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class ReviewController extends Controller
{
    public function index(Request $request): View
    {
        $query = Review::with(['creator', 'updater']);
        $sort = $request->get('sort', 'id');
        $direction = $request->get('direction', 'asc');
        $query->orderBy($sort, $direction);
        $reviews = $query->get();
        return view('admin.dashboard.reviews', ['reviews' => $reviews, 'sort' => $sort, 'direction' => $direction ]);
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
    public function store(ReviewRequest $request)
    {
        $validated = $request->validated();
        $validated['created_by'] = auth()->id();
        if ($request->hasFile('author_image_url')) {
            $image = $request->file('author_image_url');
            $imageName = uniqid() . '.' . $image->getClientOriginalExtension();
            $path = $image->storeAs('reviews/author-images', $imageName, 'public');
            $validated['author_image_url'] = $path;
        }
        if ($request->hasFile('attachment_url')) {
            $image = $request->file('attachment_url');
            $imageName = uniqid() . '.' . $image->getClientOriginalExtension();
            $path = $image->storeAs('reviews/attachment-images', $imageName, 'public');
            $validated['attachment_url'] = $path;
        }
        $validated['date'] = date('Y-m-d');
        $review = Review::create($validated);
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
    public function update(ReviewRequest $request, string $id)
    {
        $review = Review::findOrFail($id);
        $validated = $request->validated();
        if ($request->hasFile('author_image_url')) {
            if ($review->author_image_url) {
                Storage::disk('public')->delete($review->author_image_url);
            }
            $image = $request->file('author_image_url');
            $imageName = uniqid() . '.' . $image->getClientOriginalExtension();
            $path = $image->storeAs('reviews/author-images', $imageName, 'public');
            $validated['author_image_url'] = $path;
        }
        if ($request->hasFile('attachment_url')) {
            if ($review->attachment_url) {
                Storage::disk('public')->delete($review->attachment_url);
            }
            $image = $request->file('attachment_url');
            $imageName = uniqid() . '.' . $image->getClientOriginalExtension();
            $path = $image->storeAs('reviews/attachment-images', $imageName, 'public');
            $validated['attachment_url'] = $path;
        }

        $validated['updated_by'] = auth()->id();
        $validated['published'] = $request->has('published');
        $review->update($validated);
        return response()->json([
            'success' => true,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Review $review)
    {
        if ($review->author_image_url) {
            Storage::disk('public')->delete($review->author_image_url);
        }
        if ($review->attachment_url) {
            Storage::disk('public')->delete($review->attachment_url);
        }
        $review->delete();
        return response()->json([
            'status' => 'success',
        ]);
    }
}
