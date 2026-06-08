@extends('layouts.mainLayout')
@section('title', $product->meta_title ?? $product->name)
@section('meta_description',
    $product->meta_description
    ?? $product->name . ' — качественный товар с индивидуальными характеристиками и возможностью заказа.'
)
@section('og_image',    ($product->meta_image ?? $product->image_url)
        ? Storage::disk('public')->url($product->meta_image ?? $product->image_url)
        : asset('assets/img/og-default.png'))
@section('content')
    <div class="mx-auto max-w-6xl mb-25 px-2.5">
        <nav class="container mx-auto my-6 text-md text-gray-600">
            <a href="/" class="hover:text-brand-primary">Главная</a> /
            @foreach($product->category->ancestors as $ancestor)
                <a href="{{ route('category.show', $ancestor->full_path) }}"
                   class="hover:text-brand-primary transition-colors duration-600 ease-in-out">
                    {{ $ancestor->name }}
                </a> /
            @endforeach
            <a href="{{ route('category.show', $product->category->full_path) }}"
               class="hover:text-brand-primary transition-colors duration-600 ease-in-out">
                {{ $product->category->name }}
            </a> /
            <span class="text-brand-primary">{{ $product->name }}</span>
        </nav>


        <div class="container mx-auto py-10">
            <div class="flex flex-col md:flex-row justify-between gap-3 md:gap-0  mb-8">
                <h1 class="text-4xl md:text-5xl font-bold">{{ $product->name }}</h1>

                <button
                        class="openContactModal cursor-pointer bg-brand-primary hover:bg-[#9BA8B8]
                       shadow-md hover:shadow-lg
                       transition-colors duration-600 ease-in-out text-white px-8 py-4 rounded-md text-sm font-medium">
                    Оставить заявку
                </button>
            </div>
            <div class="grid md:[grid-template-columns:45%_55%]  gap-5 items-start">
                <div class="">
                    @if($product->image_url)
                        <a href="{{ Storage::url($product->image_url) }}" data-fancybox="product">
                            <img
                                    src="{{ Storage::url($product->image_url) }}"
                                    alt="{{ $product->name }}"
                                    class="w-full max-w-[470px] mx-auto  aspect-square object-cover rounded-lg shadow"
                            />
                        </a>
                    @else
                        <div class="w-full max-w-[470px] aspect-square object-cover rounded-lg shadow"></div>
                    @endif
                </div>

                <div class="flex flex-col justify-between">
                    <div class="text-gray-800 leading-relaxed text-base">
                        <p>{!! nl2br(e($product->description)) !!}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection