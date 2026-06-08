@extends('layouts/contentNavbarLayout')

@section('title', 'Услуги')

@section('content')
    <div class="card">
        <div class="flex justify-between items-center">
            <h5 class="card-header">Услуги</h5>

            <button
                    data-crud-open
                    data-modal="#serviceModal"
                    data-form="#serviceForm"
                    data-title-create="Добавить услугу"
                    data-clear-previews="thumbnail,image,meta_image"
                    class="btn btn-primary px-[26.5px]!"
            >
                + Добавить
            </button>
        </div>

        @include('admin.sorter-form.services-sorter')

        <div class="">
            <table class="table bg-light">
                <thead class="table-header bg-light shadow-md rounded-2xl">
                <tr>
                    <th>Миниатюра</th>
                    <th>Изображение</th>
                    <th>
                        <x-table-sorter field="name" label="Название" :sort="$sort" :direction="$direction"/>
                    </th>
                    <th>Заголовок</th>
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
                @foreach($services as $service)
                    <tr class="border-bottom shadow-md hover:shadow-md rounded-2xl hover:bg-gray-50">
                        {{-- thumbnail --}}
                        @if($service->thumbnail_url && Storage::disk('public')->exists($service->thumbnail_url))
                            <td>
                                <img class="w-32 max-h-32" alt=""
                                     src="{{ Storage::disk('public')->url($service->thumbnail_url) }}">
                            </td>
                        @else
                            <td><span class="text-muted fst-italic">Нет фото</span></td>
                        @endif

                        {{-- image --}}
                        @if($service->image_url && Storage::disk('public')->exists($service->image_url))
                            <td>
                                <img class="w-32 max-h-32" alt=""
                                     src="{{ Storage::disk('public')->url($service->image_url) }}">
                            </td>
                        @else
                            <td><span class="text-muted fst-italic">Нет фото</span></td>
                        @endif

                        <td>{{ $service->name }}</td>
                        <td>{{ $service->title }}</td>
                        <td class="truncate-text">{{ $service->description }}</td>
                        <td>{{ $service->meta_title }}</td>
                        <td class="truncate-text">{{ $service->meta_description }}</td>


                        @if($service->meta_image)
                            <td>
                                <img class="w-32 max-h-32"
                                     src="{{ Storage::disk('public')->url($service->meta_image) }}" alt="">
                            </td>
                        @else
                            <td>Нет Фото</td>
                        @endif

                        <td><span class="badge bg-label-primary me-1">{{ $service->creator?->name }}</span></td>
                        <td><span class="badge bg-label-primary me-1">{{ $service->updater?->name }}</span></td>

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
                                            data-modal="#serviceModal"
                                            data-form="#serviceForm"
                                            data-id="{{ $service->id }}"
                                            data-name="{{ $service->name }}"
                                            data-title="{{ $service->title }}"
                                            data-description="{{ $service->description }}"
                                            data-meta_title="{{ $service->meta_title }}"
                                            data-meta_description="{{ $service->meta_description }}"
                                            data-title-edit="Редактировать услугу"
                                            @if($service->thumbnail_url)
                                                data-preview-thumbnail-url="{{ Storage::disk('public')->url($service->thumbnail_url) }}"
                                            @endif
                                            @if($service->image_url)
                                                data-preview-image-url="{{ Storage::disk('public')->url($service->image_url) }}"
                                            @endif
                                            @if($service->meta_image)
                                                data-preview-meta-url="{{ Storage::disk('public')->url($service->meta_image) }}"
                                            @endif
                                    >
                                        <i class="icon-base bx bx-edit-alt me-1"></i> Редактировать
                                    </button>

                                    {{-- DELETE --}}
                                    <button
                                            class="dropdown-item"
                                            data-crud-delete
                                            data-id="{{ $service->id }}"
                                            data-url="/admin/services/{id}"
                                            data-confirm="Удалить услугу?"
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
                    id="serviceModal"
                    class="fixed inset-0 z-[9999] bg-black/35 backdrop-blur-md hidden justify-center "
            >
                <div class="w-3/4">
                    <div class="bg-white p-4 rounded-lg mx-20">
                        <h2 class="text-lg font-semibold mb-4">Добавить услугу</h2>

                        @include('admin.form.service-form')
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
