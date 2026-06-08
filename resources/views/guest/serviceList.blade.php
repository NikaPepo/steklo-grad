@extends('layouts.mainLayout')
@section('title', 'Услуги')
@section('meta_description', 'Услуги по изготовлению стеклянных конструкций в Москве и области: душевые кабины, перегородки, двери и зеркала. Выезд замерщика, доставка и профессиональный монтаж.')
@section('content')

    <div class="mx-auto max-w-6xl mb-25 px-2.5">

        <nav class="text-md text-gray-600 my-6">
            <a href="/" class="hover:text-brand-primary 
                       transition-colors duration-600 ease-in-out">Главная</a>
            / <a href="{{ route('services.index') }}"
                 class="@if (request()->is('services')) text-brand-primary @endif hover:text-brand-primary 
                       transition-colors duration-600 ease-in-out"
            >
                Услуги
            </a>
        </nav>
        <h1 class="text-4xl md:text-5xl font-bold mb-6">Услуги</h1>

        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-10">
            @foreach($services as $service)
                <div>
                    <div class="flex">
                        <a href="{{ route('service.show', $service->slug) }}" class="group ">
                            <div class="group-hover:bg-brand-primary ">
                                <div class=" inset-0 flex justify-center pt-10 pointer-events-none ">
                                    <span class=" px-5 h-20 text-black group-hover:text-white  font-bold text-xl flex gap-2">
                                        {{ $service->name }}
                                    </span>

                                </div>
                                <div
                                        class="relative overflow-hidden rounded-lg shadow-md block">
                                    <img src="{{ Storage::url($service->thumbnail_url) }}"
                                         alt="{{ $service->name }}"
                                         class="w-full h-60 object-cover relative transition-transform duration-300 group-hover:scale-110">
                                </div>
                            </div>
                        </a>
                    </div>

                </div>
            @endforeach
        </div>
    </div>
@endsection
