@extends('layouts.mainLayout')
@section('title', $category->meta_title ?? $category->name)
@section('meta_description', $category->meta_description ?? 'Изделия из стекла')
@section('og_image',    ($category->meta_image ?? $category->thumbnail_url)
        ? Storage::disk('public')->url($category->meta_image ?? $category->thumbnail_url)
        : asset('assets/img/og-default.png'))
@section('content')
    <div class="mx-auto max-w-6xl mb-25 px-2.5">

        <nav class="text-md my-6 text-gray-600 ">
            <a href="/" class="hover:text-brand-primary" >Главная</a>
            @foreach($category->breadcrumb as $crumb)
                / <a href="{{ route('category.show', $crumb->full_path) }}"
                     class="@if($crumb->id === $category->id) text-brand-primary @endif hover:text-brand-primary">
                    {{ $crumb->name }}
                </a>
            @endforeach
        </nav>
        <h1 class="text-4xl md:text-5xl font-bold mb-6">{{ $category->name }}</h1>
        @if($category->children->count())
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-10">
                @foreach($category->children as $child)
                    <div>
                        <div>
                            <a href="{{ route('category.show', $child->full_path) }}" class="group">
                                <div
                                        class="relative overflow-hidden rounded-lg shadow-md block">
                                    <img src="{{ Storage::url($child->thumbnail_url) }}"
                                         alt="{{ $child->name }}"
                                         class="w-full h-64 object-cover transition-transform duration-300 group-hover:scale-110">
                                    <div class="absolute inset-0 bg-brand-primary/80 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center">
                            <span class="text-white font-semibold text-lg flex items-center gap-2">
                                Смотреть подробнее →
                            </span>
                                    </div>
                                </div>
                                <div class="text-center text-xl font-bold mt-3 flex">
                                   <h3> {{ $child->name }}</h3>
                                </div>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
        @if($category->products->count())
            <div class="grid grid-cols-2 md:grid-cols-4 gap-8 mb-10">
                @foreach($category->products as $product)
                    <div>
                        <div>
                            <a  href="{{ route('product.show',$product->slug)}}" class="group">
                                <div
                                     class="relative overflow-hidden rounded-lg shadow-md block">
                                    <img src="{{ Storage::url($product->image_url) }}"
                                         alt="{{ $product->name }}"
                                         class="w-full h-64 object-cover transition-transform duration-300 group-hover:scale-110">
                                    <div class="absolute inset-0 bg-brand-primary/80 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center">
                            <span class="text-white font-semibold text-lg flex items-center gap-2">
                                Смотреть подробнее →
                            </span>
                                    </div>
                                </div>
                                <div class="text-start text-xl font-bold mt-3 flex ">
                                   <h3> {{ $product->name }}</h3>
                                </div>
                            </a>
                        </div>

                    </div>
                @endforeach
            </div>

        @endif
    </div>
@endsection
