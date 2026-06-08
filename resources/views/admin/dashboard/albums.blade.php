@extends('layouts/contentNavbarLayout')

@section('title', 'Альбомы')

@section('content')
    <div class="card">
        <div class="flex justify-between items-center">
            <h5 class="card-header">Альбомы</h5>

            <button
                    data-crud-open
                    data-modal="#albumModal"
                    data-form="#albumForm"
                    data-title-create="Добавить альбом"
                    data-clear-previews="thumbnail"
                    data-defaults="is_visible:1"
                    class="btn btn-primary px-[26.5px]!"
            >
                + Добавить
            </button>
        </div>

        @include('admin.sorter-form.albums-sorter')

        <div class="">
            <table class="table bg-light">
                <thead class="table-header bg-light shadow-md rounded-2xl">
                <tr>
                    <th>Миниатюра</th>
                    <th>
                        <x-table-sorter label="Название" field="name" :sort="$sort" :direction="$direction"/>
                    </th>
                    <th>
                        <x-table-sorter label="Слаг" field="slug" :sort="$sort" :direction="$direction"/>
                    </th>
                    <th>
                        <x-table-sorter label="Видимость" field="is_visible" :sort="$sort" :direction="$direction"/>
                    </th>
                    <th>Видео</th>
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
                @foreach($albums as $album)
                    <tr class="border-bottom shadow-md hover:shadow-md rounded-2xl hover:bg-gray-50">
                        @if($album->thumbnail_url)
                            @if($album->is_video)
                                <td>
                                    <img class="w-32 max-h-32"
                                         src="{{ $album->thumbnail_url }}" alt="">
                                </td>
                            @else
                                <td>
                                    <img class="w-32 max-h-32"
                                         src="{{ Storage::disk('public')->url($album->thumbnail_url) }}" alt="">
                                </td>
                            @endif
                        @else
                            <td><span class="text-muted fst-italic">Нет фото</span></td>
                        @endif

                        <td>{{ $album->name }}</td>
                        <td>{{ $album->slug }}</td>
                        <td class="truncate-text">{{ $album->is_visible ? 'Показан' : 'Скрыт' }}</td>
                        <td>{{ $album->is_video ? 'Да' : 'Нет' }}</td>
                        <td><span class="badge bg-label-primary me-1">{{ $album->creator?->name }}</span></td>
                        <td><span class="badge bg-label-primary me-1">{{ $album->updater?->name }}</span></td>

                        <td>
                            <div class="dropdown">
                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                        data-bs-toggle="dropdown">
                                    <i class="icon-base bx bx-dots-vertical-rounded"></i>
                                </button>

                                <div class="dropdown-menu">
                                    {{-- EDIT --}}
                                    <button
                                            class="dropdown-item"
                                            data-crud-edit
                                            data-modal="#albumModal"
                                            data-form="#albumForm"
                                            data-id="{{ $album->id }}"
                                            data-name="{{ $album->name }}"
                                            data-is_visible="{{ $album->is_visible ? 1 : 0 }}"
                                            data-is_video="{{ $album->is_video ? 1 : 0 }}"
                                            data-title-edit="Редактировать альбом"
                                            @if($album->thumbnail_url)
                                                data-preview-thumbnail-url="{{ $album->is_video ? $album->thumbnail_url : Storage::url($album->thumbnail_url) }}"
                                            @endif
                                    >
                                        <i class="icon-base bx bx-edit-alt me-1"></i> Редактировать
                                    </button>

                                    {{-- DELETE --}}
                                    <button
                                            class="dropdown-item"
                                            data-crud-delete
                                            data-id="{{ $album->id }}"
                                            data-url="/admin/albums/{id}"
                                            data-confirm="Удалить альбом?"
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
                    id="albumModal"
                    class="fixed inset-0 z-[9999] bg-black/35 backdrop-blur-md hidden justify-center"
            >
                <div class="w-3/4">
                    <div class="bg-white p-4  rounded-lg mx-20">
                        <h2 class="text-lg font-semibold mb-4">Добавить альбом</h2>

                        @include('admin.form.album-form')
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
