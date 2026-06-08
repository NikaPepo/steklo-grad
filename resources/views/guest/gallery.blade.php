@extends('layouts.mainLayout')
@section('title', 'Галерея')
@section('meta_description', 'Галерея работ Стекло-Град: выполненные проекты в Москве и Московской области — душевые кабины, перегородки, двери и стеклянные конструкции.')
@section('content')
    <div class="mx-auto max-w-6xl mb-25 px-2.5">

        <nav class="text-md my-6 text-gray-600 ">
            <a href="/">Главная</a> / <a href="{{ route('gallery.index') }}"
               class="@if(request()->is('gallery')) text-brand-primary @endif">
                Галерея
            </a>

        </nav>

        <h1 class="text-4xl md:text-5xl font-bold mb-6">Галерея</h1>


        @if($albums)
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-10">
                @foreach($albums as $album)
                    @if($album->images->isNotEmpty() && $album->is_visible)
                        <div>
                            <div>
                                <a href="{{Storage::url($album->images->first()->url) }}" class="group" data-fancybox="album-{{ $album->id }}">
                                    <div
                                         class="relative overflow-hidden rounded-lg shadow-md block">
                                        <img src="{{ Storage::url($album->thumbnail_url) }}"
                                             alt="{{ $album->name }}"
                                             class="w-full h-64 object-cover transition-transform duration-300 group-hover:scale-110">
                                        <div class="absolute inset-0 bg-brand-primary/80 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center">
                                            <span class="text-white font-semibold text-lg flex items-center gap-2">
                                                    Смотреть подробнее →
                                            </span>
                                        </div>
                                    </div>
                                    <div class="text-start text-xl font-bold mt-3 flex">
                                        <h3>{{ $album->name }}</h3>
                                    </div>
                                </a>
                            </div>
                            @foreach($album->images->skip(1) as $image)
                                <a href="{{ Storage::url($image->url) }}"
                                   data-fancybox="album-{{ $album->id }}"
                                   class="pointer-events-none opacity-0 absolute -z-10 w-0 h-0">
                                    <img alt="" src="{{ Storage::url($image->url) }}">
                                </a>
                            @endforeach


                        </div>
                    @endif
                @endforeach
            </div>

    @endif
        <h2 class="text-5xl font-bold mb-6">Коллекция видео</h2>


        @if($albums)
            <div class="grid grid-cols-2 md:grid-cols-4 gap-8 mb-10">
                @foreach($albums as $album)
                    @if($album->is_video)
                        <div>
                            <div>
                                <a href="{{$album->video_url }}" type="video/mp4" class="group" data-fancybox="album-{{ $album->id }}">
                                    <div
                                            class="relative overflow-hidden rounded-lg shadow-md block">
                                        <img src="{{$album->thumbnail_url}}"
                                             alt="{{ $album->name }}"
                                             class="w-full h-64 object-cover transition-transform duration-300 group-hover:scale-110">
                                        <div class="absolute inset-0 bg-brand-primary/80 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center">
                                            <span class="text-white font-semibold text-lg flex items-center gap-2">
                                                    Смотреть подробнее →
                                            </span>
                                        </div>
                                    </div>
                                    <div class="text-start text-xl font-bold mt-3 flex">
                                        <h3>{{ $album->name }}</h3>
                                    </div>
                                </a>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>

    @endif
@endsection