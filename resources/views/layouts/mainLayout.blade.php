<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta name="csrf-token" content="{{ csrf_token() }}"/>
    <meta name="description" content="@yield('meta_description', 'СтеклоГрад — изготовление стеклянных конструкций на заказ в Москве и Московской области.')">
    <meta name="robots" content="index, follow">
    <meta property="og:title" content="@yield('title', config('variables.templateName'))">
    <meta property="og:description" content="@yield('meta_description', 'СтеклоГрад — изготовление стеклянных конструкций на заказ в Москве и Московской области.')">
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:image" content="@yield('og_image', asset('assets/img/og-default.png'))">
    <meta property="og:site_name" content="СтеклоГрад">
    <meta property="og:locale" content="ru_RU">
    @vite(['resources/css/app.css'])
    @vite(['resources/js/app.js'])
    <title>
        @yield('title') | {{ config('variables.templateName') ? config('variables.templateName') : 'СтеклоГрад' }}
    </title>
    <link rel="icon" type="image/x-icon" href="{{asset('assets/img/favicon/steklograd.ico')}}">
</head>
<body class="antialiased">
@include('layouts.partials.header')

<main>
    @yield('content')
</main>
@include('guest.form.contact-form')

@includeIf('layouts.partials.footer')

</body>
</html>
