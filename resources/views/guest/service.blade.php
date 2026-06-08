@extends('layouts.mainLayout')
@section('title', $service->meta_title ?? $service->name)
@section('meta_description',
    $service->meta_description
    ?? $service->name . ' — услуги компании «Стекло-Град» по изготовлению и обработке стеклянных изделий любой сложности.'
)
@section('og_image',    ($service->meta_image ?? $service->thumbnail_url)
        ? Storage::disk('public')->url($service->meta_image ?? $service->thumbnail_url)
        : asset('assets/img/og-default.png'))
@section('content')
    <div class="mx-auto max-w-6xl mb-25 px-2.5">
        <nav class="container mx-auto my-6 text-md text-gray-600">
            <a href="/" class="hover:text-brand-primary
          transition-colors duration-600 ease-in-out">Главная</a> /
            <a href="{{ route('services.index') }}"
               class="hover:text-brand-primary
                       transition-colors duration-600 ease-in-out ">Услуги /
            </a>
            <span class="text-brand-primary">{{ $service->name }}</span>
        </nav>

        <div class="container mx-auto py-10">
            <div class="flex flex-col md:flex-row justify-between gap-3 md:gap-0  mb-8">
                <h1 class="text-4xl md:text-5xl font-bold">{{ $service->name }}</h1>

                <button
                   class="openContactModal cursor-pointer bg-brand-primary hover:bg-[#9BA8B8]
                       shadow-md hover:shadow-lg
                       transition-colors duration-600 ease-in-out text-white px-8 py-4 rounded-md text-sm font-medium">
                    Оставить заявку
                </button>
            </div>
            <div class="grid md:[grid-template-columns:45%_55%]  gap-5 items-start">
                <div class="flex justify-center md:justify-start">
                    @if($service->image_url)
                        <a href="{{ Storage::url($service->image_url) }}" data-fancybox="service">
                            <img
                                    src="{{ Storage::url($service->image_url) }}"
                                    alt="{{ $service->name }}"
                                    class="w-full max-w-[470px] aspect-square object-cover rounded-lg shadow"
                            />
                        </a>
                    @else
                        <div class="w-full max-w-[470px] aspect-square object-cover rounded-lg shadow"></div>
                    @endif
                </div>

                <div class="flex flex-col justify-between">
                    <div class="text-gray-800 leading-relaxed text-base">
                        <p>{!! nl2br(e($service->description)) !!}</p>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="py-12" style="background-image: url('{{ Storage::url($serviceBg->images->first()->url)}} ') ">
        <div class="flex md:flex-row flex-col gap-2.5 md:gap-5 bg-white py-13 px-16 max-w-4xl  mx-auto">
            <div class="text-center md:text-start">
                <h4 class="text-2xl font-bold mb-4">Заявка на замер</h4>
                <p class="text-gray-700 mb-4 md:mb-8 max-w-md font-normal">
                    Оставьте номер телефона и мы перезвоним в течение рабочего дня
                </p>
            </div>
            <div>
                <form class="contact-form flex flex-col   md:items-end gap-5" method="post"
                      enctype="multipart/form-data">
                    <div class="flex md:flex-row flex-col gap-2.5 md:gap-5">
                        <input
                                name="name" id="name"
                                type="text"
                                placeholder="Ваше имя *"
                                class="border border-gray-400 px-3 py-2 rounded-sm
                                                                    focus:ring-2 focus:ring-brand-primary outline-none w-full md:w-52"
                        >
                        <input
                                name="phone_number" id="phone_number"
                                type="text"
                                placeholder="Номер телефона *"
                                class="border border-gray-400 px-3 py-2 rounded-sm
                                                                    focus:ring-2 focus:ring-brand-primary outline-none w-full md:w-52"
                        >
                    </div>
                    <div class="flex flex-col md:flex-row gap-5 md:gap-10 text-center md:text-start">
                        <p class="text-sm text-gray-600 mt-4 max-w-sm">
                            *Нажимая на кнопку, Вы соглашаетесь
                            <a href="{{route('privacy.index')}}"
                               class="underline hover:text-brand-primary duration-600 ease-in-out transition-colors">
                                на обработку персональных данных
                            </a>
                        </p>
                        <button
                                type="submit"
                                class="cursor-pointer bg-brand-primary hover:bg-[#9BA8B8] shadow-md hover:shadow-lg
                                                        transition-colors duration-600 ease-in-out  px-8 py-3.5 rounded-md
                                                        text-sm font-medium text-white"
                        >
                            Отправить
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
@endsection