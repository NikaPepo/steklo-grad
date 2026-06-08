@extends('layouts.mainLayout')
@section('title', 'Контакты')
@section('meta_description', 'Контакты компании Стекло-Град. Работаем по Москве и Московской области. Консультация, выезд замерщика, расчет стоимости и заказ стеклянных конструкций.')
@section('content')
    <div class="container max-w-6xl mx-auto mb-25 px-2.5">
        <nav class="text-md text-gray-600 my-6">
            <a href="/" class="hover:text-brand-primary">Главная</a> /
            <a href="{{ route('contacts.index') }}" class="text-brand-primary">Контакты</a>
        </nav>
        <h1 class="text-4xl font-bold mb-6">Контактная информация</h1>
        <div class="grid grid-cols-1 md:grid-cols-[30%_70%] gap-5 items-center">
            <div>
                <div class="flex flex-col gap-5 my-5">
                    <div class="flex flex-col gap-3">
                        <h2>Адрес</h2>
                        <p><strong>Центральный офис:</strong> г. Москва, Торгово-офисный цетр Норд Хаус , ул.
                            Дмитровское шоссе, 100, стр 2 павильон 31105</p>
                    </div>
                    <div class="flex flex-col gap-3">
                        <h2>Режим работы</h2>
                        <p><strong>с 10:00 до 19:00</strong>— Работаем и выезжаем на замер по Москве и Московской
                            Области
                            — Договор на дому — не обязательно ехать в офис, вы можете заключить договор на дому.
                            Менеджер бесплатно приедет к вам со всеми документами.</p>
                    </div>
                    <div class="flex flex-col gap-3">
                        <h2><i class="bx bxs-phone text-brand-primary mr-5"></i>Номер телефона</h2>
                        <a href="tel:+79160238501" class="ml-10 font-semibold">{{$phone}}</a>
                        <a href="tel:+79671470022" class="ml-10 font-semibold">{{$phone2}}</a>
                    </div>
                    <div class="flex flex-col gap-3">
                        <h2><i class="bx bxs-envelope text-brand-primary mr-5"></i>Эл. почта</h2>
                        <a href="mailto:{{$post}}" class="ml-10 font-semibold">{{$post}}</a>
                    </div>
                    <div class="flex gap-8 text-3xl justify-items-start">
                        <a href="https://wa.me/79160238501" target="_blank"><i
                                    class="bx bxl-whatsapp text-brand-primary hover:text-[#9BA8B8]
                                  shadow-md hover:shadow-lg
                                  transition-colors duration-600 ease-in-out"></i></a>
                        <a href=""><i
                                    class="bx bxl-vk text-brand-primary hover:text-[#9BA8B8]
                                  shadow-md hover:shadow-lg
                                  transition-colors duration-600 ease-in-out"></i></a>
                        <a href="https://t.me/+79160238501" target="_blank"><i
                                    class="bx bxl-telegram text-brand-primary hover:text-[#9BA8B8]
                                  shadow-md hover:shadow-lg
                                  transition-colors duration-600 ease-in-out"></i></a>
                    </div>

                </div>

            </div>
            <div class="w-full flex justify-center">
                <iframe src="https://yandex.ru/map-widget/v1/?um=constructor%3A8237764d2f3cea05d449af41bdc6b6531469d12b6c99efd8b2e408235aa5e778&amp;source=constructor"
                        class="w-100 h-70 md:w-180 md:h-100 md:h-120 md:w-190" frameborder="0"></iframe>
            </div>
        </div>
    </div>
@endsection