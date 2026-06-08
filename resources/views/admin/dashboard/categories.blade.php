@extends('layouts/contentNavbarLayout')

@section('title', 'Категории')

@section('content')
    <div class="card">
        <div class="flex justify-between items-center">
            <h5 class="card-header">Категории</h5>

            {{-- было: id="openModalButton" --}}
            <button
                    data-crud-open
                    data-modal="#categoryModal"
                    data-form="#categoryForm"
                    data-title-create="Добавить категорию"
                    data-clear-previews="thumbnail,meta_image"
                    class="btn btn-primary px-[26.5px]!"
            >
                + Добавить
            </button>
        </div>

        <div>
            @include('admin.sorter-form.category-sorter', ['categoryList' => $categoryList])
        </div>

        <div class="">
            <table class="table bg-light">
                <thead class="table-header bg-light shadow-md rounded-2xl">
                <tr>
                    <th>Изображение</th>
                    <th>
                        <x-table-sorter field="name" label="Название" :sort="$sort" :direction="$direction"/>
                    </th>
                    <th>
                        <x-table-sorter field="parent_id" label="Родитель" :sort="$sort" :direction="$direction"/>
                    </th>
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
                @foreach($categories as $category)
                    <tr class="border-bottom shadow-md hover:shadow-md rounded-2xl hover:bg-gray-50">
                        @if($category->thumbnail_url && Storage::disk('public')->exists($category->thumbnail_url))
                            <td>
                                <img class="w-32 max-h-32"
                                     alt=""
                                     src="{{ Storage::disk('public')->url($category->thumbnail_url) }}">
                            </td>
                        @else
                            <td><span class="text-muted fst-italic">Нет фото</span></td>
                        @endif

                        <td class="truncate-text">{{ $category->name }}</td>
                        <td>{{ $category->parent?->name ?? 'Главный раздел' }}</td>
                        <td>{{ $category->meta_title }}</td>
                        <td class="truncate-text">{{ $category->meta_description }}</td>
                        @if($category->meta_image)
                            <td>
                                <img class="w-32 max-h-32"
                                     src="{{ Storage::disk('public')->url($category->meta_image) }}"
                                     alt="">
                            </td>
                        @elseif($category->thumbnail_url)
                            <td>
                                <img class="w-32 max-h-32"
                                     src="{{ Storage::disk('public')->url($category->meta_image) }}"
                                     alt="">
                            </td>
                        @else
                            <td><span class="text-muted fst-italic">Нет фото</span></td>
                        @endif

                        <td><span class="badge bg-label-primary me-1">{{ $category->creator?->name }}</span></td>
                        <td><span class="badge bg-label-primary me-1">{{ $category->updater?->name }}</span></td>

                        <td>
                            <div class="dropdown">
                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                        data-bs-toggle="dropdown">
                                    <i class="icon-base bx bx-dots-vertical-rounded"></i>
                                </button>

                                <div class="dropdown-menu">
                                    <button
                                            class="dropdown-item"
                                            data-crud-edit
                                            data-modal="#categoryModal"
                                            data-form="#categoryForm"
                                            data-id="{{ $category->id }}"
                                            data-name="{{ $category->name }}"
                                            data-parent_id="{{ $category->parent?->id }}"
                                            data-meta_title="{{ $category->meta_title }}"
                                            data-meta_description="{{ $category->meta_description }}"
                                            data-title-edit="Редактировать категорию"
                                            data-selected="{{ $category->parent?->id }}"
                                            @if($category->thumbnail_url)
                                                data-preview-thumbnail-url="{{ Storage::disk('public')->url($category->thumbnail_url) }}"
                                            @endif
                                            @if($category->meta_image)
                                                data-preview-meta-url="{{ Storage::disk('public')->url($category->meta_image) }}"
                                            @endif
                                    >
                                        <i class="icon-base bx bx-edit-alt me-1"></i> Редактировать
                                    </button>
                                    <button
                                            class="dropdown-item"
                                            data-crud-delete
                                            data-id="{{ $category->id }}"
                                            data-url="/admin/categories/{id}"
                                            data-confirm="Удалить категорию?"
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
            <div
                    id="categoryModal"
                    class="fixed inset-0 z-[9999] bg-black/35 backdrop-blur-md hidden justify-center "
            >
                <div class="w-3/4">
                    <div class="bg-white p-4 rounded-lg mx-20">
                        <h2 class="text-lg font-semibold mb-4">Добавить категорию</h2>
                        @include('admin.form.category-form')
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
