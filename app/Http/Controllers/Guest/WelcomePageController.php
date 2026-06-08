<?php

namespace App\Http\Controllers\Guest;

use App\Enums\DefaultAboutEnum;
use App\Enums\AlbumEnum;
use App\Http\Controllers\Controller;
use App\Models\Album;
use Illuminate\Http\Request;

class WelcomePageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $welcomeAlbum = Album::where('slug', AlbumEnum::WelcomeAlbum->value)
            ->with('images')
            ->first();
        $aboutAlbum = Album::where('slug', DefaultAboutEnum::About->value)
            ->with('images')
            ->first();
        $bannerAlbum = Album::where('slug', AlbumEnum::BannerAlbum->value)
            ->with('images')
            ->first();
        $galleryPreviewAlbum = Album::where('slug', AlbumEnum::GalleryPreviewAlbum->value)
            ->with('images')
            ->first();
        return view('guest.steklo-grad', ['aboutAlbum' => $aboutAlbum, 'welcomeAlbum' => $welcomeAlbum, 'bannerAlbum' => $bannerAlbum, 'galleryPreviewAlbum' => $galleryPreviewAlbum]);
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
    public function store(Request $request)
    {
        //
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
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
