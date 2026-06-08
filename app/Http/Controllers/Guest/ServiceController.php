<?php

namespace App\Http\Controllers\Guest;

use App\Enums\AlbumEnum;
use App\Http\Controllers\Controller;
use App\Models\Album;
use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $services = Service::all();
        return view('guest.serviceList', ['services' => $services]);
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
    public function store(Service $service)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Service $service)
    {
        $service->get();
        $serviceBg = Album::where('slug', AlbumEnum::ServiceAlbum->value)->first();
        return view('guest.service', ['service' => $service, 'serviceBg' => $serviceBg]);
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
