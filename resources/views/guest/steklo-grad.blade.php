@extends('layouts.mainLayout')
@section('title', 'Главная')
@section('meta_description', 'Компания Стекло-Град — изготовление стеклянных конструкций на заказ в Москве и Московской области: душевые кабины, перегородки, двери и зеркала. Замер, доставка и монтаж под ключ.')
@php
    $firstBannerImage = $bannerAlbum?->images->first();
@endphp

@section('content')
    <section class="mb-8">
        <div class="relative w-full h-[420px] sm:h-[500px] md:h-[600px]">
            <div class="swiper welcome-swiper relative h-full">
                <div class="swiper-wrapper">
                    @if(isset($welcomeAlbum->images))
                        @foreach($welcomeAlbum->images as $image)
                            <div class="swiper-slide relative">

                                <div class="w-full h-full  bg-cover bg-center relative"
                                     style="background-image: url('{{ Storage::url($image->url) }}')">
                                    <div class=" w-6xl z-20 mx-auto">
                                        <div class="py-10 md:py-25 md:px-20 w-80 md:w-3/5 px-4 sm:px-10  text-white">
                                            <div class="mb-10">
                                                <h1 class="text-2xl md:text-5xl font-extrabold mb-4 [text-shadow:0_2px_10px_rgba(0,0,0,0.45)]">
                                                    {{ $image->title }}
                                                </h1>

                                                @if($image->subtitle)
                                                    <p class="text-base md:text-lg [text-shadow:0_2px_10px_rgba(0,0,0,0.45)]">{{ $image->subtitle }}</p>
                                                @endif
                                            </div>
                                            <button
                                                    class="cursor-pointer bg-brand-primary hover:bg-[#9BA8B8] shadow-md hover:shadow-lg
                                                        transition-colors duration-600 ease-in-out  px-8 py-3.5 rounded-md
                                                        text-sm font-medium galleryPreviewButton">
                                                Смотреть работы
                                            </button>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
                <button class="welcome-prev swiper-button-prev btn-swiper btn-left">
                    <i class="bx bx-left-arrow"></i>
                </button>
                <button class="welcome-next swiper-button-next btn-swiper btn-right">
                    <i class="bx bx-right-arrow"></i>
                </button>
            </div>

        </div>


        <div class="flex md:flex-row flex-col gap-2.5 md:gap-5 bg-white py-7 md:py-13 px-16 max-w-4xl -mt-30 !z-40 !relative mx-auto">
            <div class="text-center md:text-start">
                <h4 class="text-2xl font-bold mb-4  md:text-start ">Заявка на замер</h4>
                <p class="text-gray-700 mb-4 md:mb-8 max-w-md font-normal">
                    Оставьте номер телефона и мы перезвоним в течение рабочего дня
                </p>
            </div>
            <div>
                <form class="contact-form flex flex-col justify-center  md:items-end gap-5" method="post"
                      enctype="multipart/form-data">
                    <div class="flex md:flex-row flex-col gap-2.5 md:gap-5 ">
                        <input
                                name="name" id="name" autocomplete="name"
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
                                class=" cursor-pointer bg-brand-primary hover:bg-[#9BA8B8] shadow-md hover:shadow-lg
                                                        transition-colors duration-600 ease-in-out  px-8 py-3.5 rounded-md
                                                        text-sm font-medium text-white"
                        >
                            Отправить
                        </button>
                    </div>
                </form>

            </div>
        </div>

    </section>
    <section class="px-2.5">
        <div class="mx-auto max-w-6xl ">
            @if($menuParents)
                @foreach($menuParents as $parent)
                    <div class="container mb-20 mx-auto">
                        <div class="flex justify-between mb-10 mt-8">
                            <h2 class="text-4xl font-bold">{{$parent->name}}</h2>
                            <a href="{{route('category.show', $parent->slug)}}"
                               class="flex font-bold items-center hover:text-brand-primary transition-colors duration-600 ease-in-out">Смотреть
                                всё
                                <i class="bx bxs-chevrons-right"></i>
                            </a>
                        </div>
                        <div class="grid grid-cols-2 lg:grid-cols-4 gap-5 md:gap-4 mb-10">
                            @if($parent->children)
                                @foreach($parent->children->take(4) as $child)
                                    <div>
                                        <div>
                                            <a href="{{ route('category.show', $parent->slug . '/' . $child->slug) }}"
                                               class="group">
                                                <div
                                                        class=" relative overflow-hidden rounded-lg shadow-md block">
                                                    <img src="{{ Storage::url($child->thumbnail_url) }}"
                                                         alt="{{ $child->name }}"
                                                         class="w-full h-64 object-cover transition-transform duration-300 group-hover:scale-110">
                                                    <div class="absolute inset-0 bg-brand-primary/80 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center">
                                                <span class="text-white font-semibold text-lg flex items-center gap-2">
                                                    Смотреть подробнее →
                                                </span>
                                                    </div>
                                                </div>
                                                <div class="text-start text-xl font-bold mt-3 flex">
                                                    {{ $child->name }}
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </section>
    {{--        Сюда обложку--}}
    <section class="mb-20 hidden md:block">
        <div class="relative w-full h-[350px]"
             @if($firstBannerImage)
                 style="background-image: url('{{ Storage::url($firstBannerImage->url) }}'); background-size: cover; background-position: center;"
                @endif>
            <div class="swiper banner-swiper h-full">
                <div class="swiper-wrapper">
                    @if(isset($bannerAlbum->images))
                        @foreach($bannerAlbum->images as $image)
                            <div class="swiper-slide relative">
                                <div class="absolute inset-0 bg-cover bg-center"
                                     style="background-image: url('{{ Storage::url($image->url) }}')"></div>
                                <div class="relative w-6xl z-20 mx-auto flex h-full items-center">
                                    <div class=" max-w-xl bg-white p-10 ">
                                        <h2 class="text-3xl md:text-4xl font-extrabold m-4">
                                            {{ $image->title }}
                                        </h2>
                                        @if($image->subtitle)
                                            <p class="text-lg mb-6">{{ $image->subtitle }}</p>
                                        @endif
                                        <button
                                                class="cursor-pointer bg-brand-primary hover:bg-[#9BA8B8] shadow-md hover:shadow-lg
                                           transition-colors duration-600 ease-in-out px-7 py-3 rounded-md text-white m-4
                                           text-sm font-medium openContactModal">
                                            Оставить заявку
                                        </button>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>

                <button class="banner-prev swiper-button-prev btn-swiper btn-left">
                    <i class="bx bx-left-arrow"></i>
                </button>
                <button class="banner-next  swiper-button-next  btn-swiper btn-right">
                    <i class="bx bx-right-arrow"></i>
                </button>
                <div class="swiper-pagination"></div>
            </div>


        </div>
    </section>

    <section class="mb-40 hidden lg:block">
        <div class="container mx-auto max-w-6xl">

            <h2 class="text-4xl font-bold  mb-12 px-2.5">
                Как мы работаем с Вами
            </h2>

            <div class="relative flex items-start">

                <div class="relative group ">

                    <div class="absolute left-22 top-13 w-35
                        border-t-2 border-dashed border-brand-primary group-hover:border-white
                        -translate-y-1/2 z-10 pointer-events-none"></div>
                    <div class="group bg-white border border-transparent hover:bg-brand-primary hover:text-white transition-all p-6 rounded-md   relative min-h-[350px]">
                        <div class="w-15 h-15 rounded-full border-2 border-dashed border-brand-primary group-hover:border-white flex items-center justify-center text-xl font-bold mb-5 group-hover:text-white text-brand-primary">
                            <div class="w-10 h-10 rounded-full  bg-brand-primary group-hover:bg-white flex items-center justify-center text-xl font-bold text-white group-hover:text-brand-primary z-50">
                                1
                            </div>
                        </div>

                        <div class="w-6 mb-4 group-hover:text-white">
                            <i
                                    class="invert-0  transition bx bx-edit scale-170 "> </i>
                        </div>

                        <div class="text-xl font-bold mb-2">
                            Заявка
                        </div>

                        <div class="flex flex-col gap-2 text-base leading-snug text-white justify-center">
                            Оставляйте заявку на сайте или по номеру телефона <br>
                            <a href=""><span class="font-bold tracking-wider">{{$phone}}</span></a>
                        </div>
                    </div>
                </div>
                <div class="relative group ">
                    <div class="absolute  top-13 w-4 left-1
                        border-t-2 border-dashed border-brand-primary group-hover:border-white
                        -translate-y-1/2 z-10 pointer-events-none"></div>
                    <div class="absolute left-22 top-13 w-35
                        border-t-2 border-dashed border-brand-primary group-hover:border-white
                        -translate-y-1/2 z-10 pointer-events-none"></div>
                    <div class="group bg-white border border-transparent hover:bg-brand-primary hover:text-white transition-all p-6 rounded-md   relative min-h-[350px]">
                        <div class="w-15 h-15 rounded-full border-2 border-dashed border-brand-primary group-hover:border-white flex items-center justify-center text-xl font-bold mb-5 group-hover:text-white text-brand-primary">
                            <div class="w-10 h-10 rounded-full  bg-brand-primary group-hover:bg-white flex items-center justify-center text-xl font-bold text-white group-hover:text-brand-primary z-50">
                                2
                            </div>
                        </div>

                        <div class="w-6 mb-4 group-hover:text-white">
                            <i
                                    class="invert-0  transition bx bx-crop scale-170 "> </i>
                        </div>

                        <div class="text-xl font-bold mb-2">
                            Выезд замерщика
                        </div>

                        <div class="flex flex-col gap-2 text-base leading-snug text-white justify-center">
                            Оставляйте заявку на сайте или по номеру телефона <br>
                            <a href=""><span class="font-bold tracking-wider">{{$phone}}</span></a>
                        </div>
                    </div>
                </div>
                <div class="relative group ">
                    <div class="absolute  top-13 w-4 left-1
                        border-t-2 border-dashed border-brand-primary group-hover:border-white
                        -translate-y-1/2 z-10 pointer-events-none"></div>
                    <div class="absolute left-22 top-13 w-35
                        border-t-2 border-dashed border-brand-primary group-hover:border-white
                        -translate-y-1/2 z-10 pointer-events-none"></div>
                    <div class="group bg-white border border-transparent hover:bg-brand-primary hover:text-white transition-all p-6 rounded-md   relative min-h-[350px]">
                        <div class="w-15 h-15 rounded-full border-2 border-dashed border-brand-primary group-hover:border-white flex items-center justify-center text-xl font-bold mb-5 group-hover:text-white text-brand-primary">
                            <div class="w-10 h-10 rounded-full  bg-brand-primary group-hover:bg-white flex items-center justify-center text-xl font-bold text-white group-hover:text-brand-primary z-50">
                                3
                            </div>
                        </div>

                        <div class="w-6 mb-4 group-hover:text-white">
                            <i
                                    class="invert-0 transition bx bx-file-blank scale-170 "> </i>
                        </div>

                        <div class="text-xl font-bold mb-2">
                            Заключение договора
                        </div>

                        <div class="flex flex-col gap-2 text-base leading-snug text-white justify-center">
                            Оставляйте заявку на сайте или по номеру телефона <br>
                            <a href=""><span class="font-bold tracking-wider">{{$phone}}</span></a>
                        </div>
                    </div>
                </div>
                <div class="relative group ">
                    <div class="absolute  top-13 w-4 left-1
                        border-t-2 border-dashed border-brand-primary group-hover:border-white
                        -translate-y-1/2 z-10 pointer-events-none"></div>
                    <div class="absolute left-22 top-13 w-35
                        border-t-2 border-dashed border-brand-primary group-hover:border-white
                        -translate-y-1/2 z-10 pointer-events-none"></div>
                    <div class="group bg-white border border-transparent hover:bg-brand-primary hover:text-white transition-all p-6 rounded-md   relative min-h-[350px]">
                        <div class="w-15 h-15 rounded-full border-2 border-dashed border-brand-primary group-hover:border-white flex items-center justify-center text-xl font-bold mb-5 group-hover:text-white text-brand-primary">
                            <div class="w-10 h-10 rounded-full  bg-brand-primary group-hover:bg-white flex items-center justify-center text-xl font-bold text-white group-hover:text-brand-primary z-50">
                                4
                            </div>
                        </div>

                        <div class="w-6 mb-4 group-hover:text-white">
                            <i
                                    class="invert-0  transition bx bx-cube scale-170 "> </i>
                        </div>

                        <div class="text-xl font-bold mb-2">
                            Изготовление товара
                        </div>

                        <div class="flex flex-col gap-2 text-base leading-snug text-white justify-center">
                            Оставляйте заявку на сайте или по номеру телефона <br>
                            <a href=""><span class="font-bold tracking-wider">{{$phone}}</span></a>
                        </div>
                    </div>
                </div>
                <div class="relative group ">
                    <div class="absolute  top-13 w-4 left-1
                        border-t-2 border-dashed border-brand-primary group-hover:border-white
                        -translate-y-1/2 z-10 pointer-events-none"></div>
                    <div class=" bg-white border border-transparent hover:bg-brand-primary hover:text-white transition-all p-6 rounded-md   relative min-h-[350px]">
                        <div class="w-15 h-15 rounded-full border-2 border-dashed border-brand-primary group-hover:border-white flex items-center justify-center text-xl font-bold mb-5 group-hover:text-white text-brand-primary">
                            <div class="w-10 h-10 rounded-full  bg-brand-primary group-hover:bg-white flex items-center justify-center text-xl font-bold text-white group-hover:text-brand-primary z-50">
                                5
                            </div>
                        </div>

                        <div class="w-6 mb-4 group-hover:text-white ">
                            <i
                                    class="invert-0 transition bx bx-buildings scale-170 "> </i>
                        </div>

                        <div class="text-xl font-bold mb-2">
                            Доставка и установка
                        </div>

                        <div class="flex flex-col gap-2 text-base leading-snug text-white justify-center">
                            Оставляйте заявку на сайте или по номеру телефона <br>
                            <a href=""><span class="font-bold tracking-wider">{{$phone}}</span></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="mb-20 px-2.5">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-5 items-center mx-auto max-w-6xl">
            <div>
                <h2 class="text-4xl font-bold mb-6">О компании «Стекло-Град»</h2>
                <p class="text-gray-700 mb-4">
                    Компания «Стекло-Град», существуя на рынке более 10 лет, специализируется на работе с
                    индивидуальными заказами по стеклоизделиям любой сложности. Изготавливает стеклянные двери, душевые
                    кабины, зеркальные потолки, стеклянные перегородки, всевозможные детали интерьера или мебели из
                    стекла, любые зеркала с учетом индивидуальных требований Заказчика.
                </p>
                <p class="text-gray-700 mb-4">
                    Используя современное оборудование, позволяющие выполнять самые сложные операции со стеклом, мы
                    делаем фацет, обработку кромки, гравировку, триплекс, обработку триплекса, сверление отверстий,
                    закаливание, малирование (гнутье), матовку и художественную матовку, покраску стекла, а также
                    склейку стекла, фотопечать. При изготовлении изделий используем фурнитуру от ведущих производителей.
                </p>

                <div class="grid grid-cols-2 gap-6 my-8">
                    <div>
                        <div class="text-4xl md:text-6xl font-bold text-brand-primary">>10</div>
                        <div class="text-m font-semibold text-gray-600">лет опыта работы</div>
                    </div>
                    <div>
                        <div class="text-4xl md:text-6xl font-bold text-brand-primary">> 1 000</div>
                        <div class="text-m font-semibold text-gray-600">выполненных работ</div>
                    </div>
                </div>
                <div class="px-16 md:px-0">
                    <a href="{{route('about.index')}}"
                       class="flex justify-center cursor-pointer md:inline-block mt-6 bg-brand-primary hover:bg-[#9BA8B8]
                          shadow-md hover:shadow-lg
                          transition-colors duration-600 ease-in-out text-white px-8 py-3 rounded-md text-sm font-medium">
                        Подробнее о компании
                    </a>
                </div>
            </div>

            <div class="overflow-hidden ">
                <div class="about-marquee mx-auto">
                    <div class="marquee-track">
                        @if($aboutAlbum?->images)
                            @foreach($aboutAlbum->images as $image)
                                <a href="{{ Storage::url($image->url) }}" data-fancybox="about-gallery">
                                    <img src="{{ Storage::url($image->url) }}" alt="" class="marquee-image">
                                </a>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
    {{--        Альбом Галереи--}}
    <section class="mb-40 px-2.5" id="galleryPreview">
        <div class="flex justify-between my-10 max-w-6xl mx-auto">
            <h2 class="text-4xl font-bold">Галерея</h2>
            <a href="{{route('gallery.index')}}"
               class="flex font-bold items-center hover:text-brand-primary transition-colors duration-600 ease-in-out">Смотреть
                всё
                <i class="bx bxs-chevrons-right"></i>
            </a>
        </div>
        <div class="relative w-full h-[300px] md:h-[640px]">
            <div class="swiper gallery-swiper h-full relative">
                <div class="swiper-wrapper ">
                    @if(isset($galleryPreviewAlbum))
                        @foreach($galleryPreviewAlbum->images as $image)
                            <div class="swiper-slide ">
                                <div class="flex justify-center absolute inset-0 bg-cover bg-center">
                                    <img class="w-6xl" src="{{ Storage::url($image->url) }}" alt="">
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
                <div class="hidden md:block">
                    <button class=" gallery-prev swiper-button-prev btn-swiper btn-left">
                        <i class="bx bx-left-arrow"></i>
                    </button>

                    <button class="gallery-next swiper-button-next btn-swiper btn-right">
                        <i class="bx bx-right-arrow"></i>
                    </button>
                </div>
                <div class="swiper-pagination"></div>
            </div>
        </div>
    </section>
    <section class="mb-20 px-2.5">
        <div class="container max-w-6xl mx-auto">
            <h2 class="text-4xl font-bold mb-6">Контактная информация</h2>
            <div class="grid grid-cols-1 lg:grid-cols-[30%_70%] gap-1 xl:gap-5 items-center">
                <div>
                    <div class="flex flex-col gap-5 my-5">
                        <div class="flex flex-col gap-3">
                            <h3>Адрес</h3>
                            <p><strong>Центральный офис:</strong> г. Москва, Торгово-офисный цетр Норд Хаус , ул.
                                Дмитровское шоссе, 100, стр 2 павильон 31105</p>
                        </div>
                        <div class="flex flex-col gap-3">
                            <h3>Режим работы</h3>
                            <p><strong>с 10:00 до 19:00</strong>— Работаем и выезжаем на замер по Москве и Московской
                                Области
                                — Договор на дому — не обязательно ехать в офис, вы можете заключить договор на дому.
                                Менеджер бесплатно приедет к вам со всеми документами.</p>
                        </div>
                        <div class="flex flex-col gap-3">
                            <h3><i class="bx bxs-phone text-brand-primary mr-5"></i>Номер телефона</h3>
                            <a href="" class="ml-10 font-semibold">{{$phone}}</a>
                            <a href="" class="ml-10 font-semibold">{{$phone2}}</a>
                        </div>
                        <div class="flex flex-col gap-3">
                            <h3><i class="bx bxs-envelope text-brand-primary mr-5"></i>Эл. почта</h3>
                            <a href="" class="ml-10 font-semibold">{{$post}}</a>
                        </div>
                        <div class="flex gap-8 text-3xl justify-items-start">
                            <a href="https://wa.me/79160238501" target="_blank"><i
                                        class="bx bxl-whatsapp text-brand-primary hover:text-[#9BA8B8] transition-colors duration-600 ease-in-out"></i></a>
                            <a href=""><i
                                        class="bx bxl-vk text-brand-primary hover:text-[#9BA8B8] transition-colors duration-600 ease-in-out"></i></a>
                            <a href="https://t.me/+79160238501" target="_blank"><i
                                        class="bx bxl-telegram text-brand-primary hover:text-[#9BA8B8] transition-colors duration-600 ease-in-out"></i></a>
                        </div>

                    </div>

                </div>
                <div class="w-full flex justify-center">
                    <iframe class=" w-100 h-70 md:w-170 md:h-100 xl:h-120 xl:w-190"
                            src="https://yandex.ru/map-widget/v1/?um=constructor%3A8237764d2f3cea05d449af41bdc6b6531469d12b6c99efd8b2e408235aa5e778&amp;source=constructor"
                            frameborder="0"></iframe>
                </div>
            </div>
        </div>
    </section>
@endsection