@extends('layouts/contentNavbarLayout')

@section('title', 'Продукты')

@section('content')
    <div class="card">
        <div class="flex justify-between items-center">
            <h5 class="card-header">Продукты</h5>

            {{-- было: id="openModalButton" --}}
            <button
                    data-crud-open
                    data-modal="#productModal"
                    data-form="#productForm"
                    data-title-create="Добавить продукт"
                    data-clear-previews="image,meta_image"
                    class="btn btn-primary px-[26.5px]!"
            >
                + Добавить
            </button>
        </div>

        @include('admin.sorter-form.products-sorter', ['productWithCategoryList' => $productWithCategoryList])

        <div class="">
            <table class="table bg-light">
                <thead class="table-header bg-light shadow-md rounded-2xl">
                <tr>
                    <th>Изображение</th>
                    <th>
                        <x-table-sorter field="name" label="Название" :sort="$sort" :direction="$direction"/>
                    </th>
                    <th>
                        <x-table-sorter field="category_id" label="Категория" :sort="$sort" :direction="$direction"/>
                    </th>
                    <th>Описание</th>
                    <th>Мета-заголовок</th>
                    <th>Мета-описание</th>
                    <th>Мета-картинка</th>
                    <th>
                        <x-table-sorter field="created_by" label="Создал" :sort="$sort" :direction="$direction"/>
                    </th>
                    <th>
                        <x-table-sorter field="updated_by" label="Обновил" :sort="$sort" :direction="$direction"/>
                    </th>
                    <th>Действия</th>
                </tr>
                </thead>

                <tbody>
                @foreach($products as $product)
                    <tr class="border-bottom shadow-md hover:shadow-md rounded-2xl hover:bg-gray-50">
                        @if($product->image_url && Storage::disk('public')->exists($product->image_url))
                            <td>
                                <img class="w-32 max-h-32" alt=""
                                     src="{{ Storage::disk('public')->url($product->image_url) }}">
                            </td>
                        @else
                            <td><span class="text-muted fst-italic">Нет фото</span></td>
                        @endif

                        <td class="truncate-text">{{ $product->name }}</td>
                        <td>{{ $product->category?->name }}</td>
                        <td class="truncate-text">{{ $product->description }}</td>
                        <td>{{ $product->meta_title }}</td>
                        <td class="truncate-text">{{ $product->meta_description }}</td>

                        @if($product->meta_image)
                            <td>
                                <img class="w-32 max-h-32"
                                     src="{{ Storage::disk('public')->url($product->meta_image) }}" alt="">
                            </td>
                        @else
                            <td>Нет Фото</td>
                        @endif

                        <td><span class="badge bg-label-primary me-1">{{ $product->creator?->name }}</span></td>
                        <td><span class="badge bg-label-primary me-1">{{ $product->updater?->name }}</span></td>

                        <td>
                            <div class="dropdown">
                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                    <i class="icon-base bx bx-dots-vertical-rounded"></i>
                                </button>

                                <div class="dropdown-menu">
                                    {{-- EDIT --}}
                                    <button
                                            class="dropdown-item"
                                            data-crud-edit
                                            data-modal="#productModal"
                                            data-form="#productForm"
                                            data-id="{{ $product->id }}"
                                            data-name="{{ $product->name }}"
                                            data-description="{{ $product->description }}"
                                            data-category_id="{{ $product->category?->id }}"
                                            data-meta_title="{{ $product->meta_title }}"
                                            data-meta_description="{{ $product->meta_description }}"
                                            data-title-edit="Редактировать продукт"
                                            data-selected="{{ $product->category?->id }}"
                                            @if($product->image_url)
                                                data-preview-image-url="{{ Storage::disk('public')->url($product->image_url) }}"
                                            @endif
                                            @if($product->meta_image)
                                                data-preview-meta-url="{{ Storage::disk('public')->url($product->meta_image) }}"
                                            @endif
                                    >
                                        <i class="icon-base bx bx-edit-alt me-1"></i> Редактировать
                                    </button>

                                    {{-- DELETE --}}
                                    <button
                                            class="dropdown-item"
                                            data-crud-delete
                                            data-id="{{ $product->id }}"
                                            data-url="/admin/products/{id}"
                                            data-confirm="Удалить продукт?"
                                    >
                                        <i class="icon-base bx bx-trash me-1"></i> Удалить
                                    </button>
                                </div>
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>

            {{-- MODAL --}}
            <div
                    id="productModal"
                    class="fixed inset-0 z-[9999] bg-black/35 backdrop-blur-md hidden justify-center"
            >
                <div class="w-3/4">
                    <div class="bg-white p-4 rounded-lg mx-20">
                        <h2 class="text-lg font-semibold mb-4">Добавить продукт</h2>

                        @include('admin.form.product-form')
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
