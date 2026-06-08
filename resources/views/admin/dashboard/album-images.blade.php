@extends('layouts/contentNavbarLayout')

@section('title', 'Галерея')

@section('content')
    <div class="card">
        <div class="flex justify-between items-center">
            <h5 class="card-header">Картинки</h5>

            <button
                    data-crud-open
                    data-modal="#albumImageModal"
                    data-form="#albumImageForm"
                    data-title-create="Добавить картинку"
                    data-clear-previews="image"
                    class="btn btn-primary px-[26.5px]!"
            >
                + Добавить
            </button>
        </div>

        @include('admin.sorter-form.album-images-sorter', ['albumImageList' => $albumImagesList])

        <div class="">
            <table class="table bg-light">
                <thead class="table-header bg-light shadow-md rounded-2xl">
                <tr>
                    <th>Изображение</th>
                    <th>
                        <x-table-sorter label="Альбом" field="album_id" :sort="$sort" :direction="$direction"/>
                    </th>
                    <th>Заголовок</th>
                    <th>Подзаголовок</th>
                    <th>
                        <x-table-sorter label="Создал" field="created_by" :sort="$sort" :direction="$direction"/>
                    </th>
                    <th>
                        <x-table-sorter label="Обновил" field="updated_by" :sort="$sort" :direction="$direction"/>
                    </th>
                    <th>Действия</th>
                </tr>
                </thead>

                <tbody>
                @foreach($albumImages as $albumImage)
                    <tr class="border-bottom shadow-md hover:shadow-md rounded-2xl hover:bg-gray-50">
                        @if($albumImage->url && Storage::disk('public')->exists($albumImage->url))
                            <td>
                                <img class="w-32 max-h-32" alt=""
                                     src="{{ Storage::disk('public')->url($albumImage->url) }}">
                            </td>
                        @else
                            <td><span class="text-muted fst-italic">Нет фото</span></td>
                        @endif

                        <td>{{ $albumImage->album->name }}</td>
                        <td class="truncate-text">{{ $albumImage->title }}</td>
                        <td class="truncate-text">{{ $albumImage->subtitle }}</td>
                        <td><span class="badge bg-label-primary me-1">{{ $albumImage->creator?->name }}</span></td>
                        <td><span class="badge bg-label-primary me-1">{{ $albumImage->updater?->name }}</span></td>

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
                                            data-modal="#albumImageModal"
                                            data-form="#albumImageForm"
                                            data-id="{{ $albumImage->id }}"
                                            data-album_id="{{ $albumImage->album->id }}"
                                            data-title="{{ $albumImage->title }}"
                                            data-subtitle="{{ $albumImage->subtitle }}"
                                            data-title-edit="Редактировать Изображение"
                                            data-selected="{{ $albumImage->album->id }}"
                                            @if($albumImage->url)
                                                data-preview-image-url="{{ Storage::disk('public')->url($albumImage->url) }}"
                                            @endif
                                    >
                                        <i class="icon-base bx bx-edit-alt me-1"></i> Редактировать
                                    </button>


                                    <button
                                            class="dropdown-item"
                                            data-crud-delete
                                            data-id="{{ $albumImage->id }}"
                                            data-url="/admin/album-images/{id}"
                                            data-confirm="Удалить запись?"
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
                    id="albumImageModal"
                    class="fixed inset-0 z-[9999] bg-black/35 backdrop-blur-md hidden justify-center "
            >
                <div class="w-3/4">
                    <div class="bg-white p-4 rounded-lg mx-20">
                        <h2 class="text-lg font-semibold mb-3">Добавить картинку</h2>

                        @include('admin.form.album-image-form')
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
