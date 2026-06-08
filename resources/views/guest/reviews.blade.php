@extends('layouts.mainLayout')
@section('title', 'Отзывы')
@section('meta_description', 'Отзывы клиентов о компании Стекло-Град в Москве и Московской области. Оценки качества стеклянных конструкций, монтажа и сервиса.')
@section('content')
    @include('guest.form.review-form')
    <div class="container max-w-6xl mx-auto mb-25 px-2.5 w-full">
        <nav class="text-md text-gray-600 my-6">
            <a href="/" class="hover:text-brand-primary">Главная</a> /
            <a href="{{ route('reviews.index') }}" class="text-brand-primary">Отзывы</a>
        </nav>
        <div class="flex">
            <h1 class="text-4xl md:text-5xl font-bold mb-6">Отзывы</h1>
        </div>
        <div class="grid grid-cols-1 xl:grid-cols-[75%_25%] gap-7 ">
            <div class="flex flex-col">
                @foreach($reviews as $review)
                    <div class="border border-gray-300 rounded-md bg-white my-5 p-10 h-70">
                        <div class="flex items-start gap-4">
                            @if($review->author_image_url)
                                <img src="{{Storage::url($review->author_image_url)}}" alt=""
                                     class="w-16 h-16 rounded-full object-cover">
                            @endif
                            <div class="flex flex-col">
                                <h2 class="font-semibold text-gray-900 text-xl ">{{$review->author}}</h2>
                                <p class="text-m text-gray-600 mb-2 font-medium">{{$review->date->translatedFormat('d F Y')}}</p>
                            </div>
                        </div>
                        <div>
                            <p class="text-gray-700 leading-relaxed">
                                {{$review->text}}
                            </p>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="bg-brand-primary  text-white p-8 rounded-md mt-5 size-full xl:size-72">
                <div class="xl:text-start text-center">
                    <h2 class="text-3xl font-semibold mb-3">Оставить отзыв</h2>
                    <p class="text-m mb-6">
                        Отзыв пройдёт модерацию и сразу появится на сайте
                    </p>
                </div>
                <div class="flex justify-center">
                    <button class="bg-white text-brand-primary text-sm font-medium py-3.5 px-8 rounded-sm hover:bg-[#9BA8B8] hover:text-amber-50
                          shadow-md hover:shadow-lg cursor-pointer
                          transition-colors duration-600 ease-in-out openReviewModal">
                        Оставить отзыв
                    </button>
                </div>
            </div>

        </div>

@endsection
