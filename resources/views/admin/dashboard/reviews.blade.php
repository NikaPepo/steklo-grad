@extends('layouts/contentNavbarLayout')

@section('title', 'Отзывы')

@section('content')
    <div class="card">
        <div class="flex justify-between items-center">
            <h5 class="card-header">Отзывы</h5>

            <button
                    data-crud-open
                    data-modal="#reviewModalAdmin"
                    data-form="#reviewFormAdmin"
                    data-title-create="Добавить отзыв"
                    data-clear-previews="authorImage,attachment"
                    class="btn btn-primary px-[26.5px]!"
            >
                + Добавить
            </button>
        </div>

        <div>
            <table class="table bg-light">
                <thead class="table-header bg-light shadow-md rounded-2xl">
                <tr>
                    <th>Вложение</th>
                    <th>Фото автора</th>
                    <th>
                        <x-table-sorter label="Автор" field="author" :sort="$sort" :direction="$direction"/>
                    </th>
                    <th>Телефон автора</th>
                    <th>Дата</th>
                    <th>
                        <x-table-sorter label="Опубликовано" field="published" :sort="$sort" :direction="$direction"/>
                    </th>
                    <th>Комментарий</th>
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
                @foreach($reviews as $review)
                    <tr class="border-bottom shadow-md hover:shadow-md rounded-2xl hover:bg-gray-50">
                        {{-- attachment --}}
                        @if($review->attachment_url && Storage::disk('public')->exists($review->attachment_url))
                            <td>
                                <img class="w-32 max-h-32" alt=""
                                     src="{{ Storage::disk('public')->url($review->attachment_url) }}">
                            </td>
                        @else
                            <td><span class="text-muted fst-italic">Нет фото</span></td>
                        @endif

                        {{-- author image --}}
                        @if($review->author_image_url && Storage::disk('public')->exists($review->author_image_url))
                            <td>
                                <img class="w-32 max-h-32" alt=""
                                     src="{{ Storage::disk('public')->url($review->author_image_url) }}">
                            </td>
                        @else
                            <td><span class="text-muted fst-italic">Нет фото</span></td>
                        @endif

                        <td class="truncate-text">{{ $review->author }}</td>
                        <td>{{ $review->author_phone_number }}</td>
                        <td class="text-xm truncate-text">{{ $review->date->translatedFormat('d F Y') }}</td>
                        <td class="truncate-text">{{ $review->published ? 'Опубликован' : 'На модерации' }}</td>
                        <td class="truncate-text">{{ $review->text }}</td>
                        <td><span class="badge bg-label-primary me-1">{{ $review->creator?->name }}</span></td>
                        <td><span class="badge bg-label-primary me-1">{{ $review->updater?->name }}</span></td>

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
                                            data-modal="#reviewModalAdmin"
                                            data-form="#reviewFormAdmin"
                                            data-id="{{ $review->id }}"
                                            data-author="{{ $review->author }}"
                                            data-author_phone_number="{{ $review->author_phone_number }}"
                                            data-text="{{ $review->text }}"
                                            data-published="{{ $review->published ? 1 : 0 }}"
                                            data-title-edit="Редактировать отзыв"
                                            @if($review->author_image_url)
                                                data-preview-author-image-url="{{ Storage::disk('public')->url($review->author_image_url) }}"
                                            @endif
                                            @if($review->attachment_url)
                                                data-preview-attachment-url="{{ Storage::disk('public')->url($review->attachment_url) }}"
                                            @endif
                                    >
                                        <i class="icon-base bx bx-edit-alt me-1"></i> Редактировать
                                    </button>

                                    {{-- DELETE --}}
                                    <button
                                            class="dropdown-item"
                                            data-crud-delete
                                            data-id="{{ $review->id }}"
                                            data-url="/admin/reviews/{id}"
                                            data-confirm="Удалить отзыв?"
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
                    id="reviewModalAdmin"
                    class="fixed inset-0 z-[9999] bg-black/35 backdrop-blur-md hidden justify-center"
            >
                <div class="w-3/4">
                    <div class="bg-white p-4 rounded-lg mx-20">
                        <h2 class="text-lg font-semibold mb-4">Добавить отзыв</h2>

                        @include('admin.form.review-form')
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
