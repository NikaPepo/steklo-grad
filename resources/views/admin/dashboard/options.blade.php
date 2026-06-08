@extends('layouts/contentNavbarLayout')

@section('title', 'Контакты')

@section('content')
    <div class="card">
        <div class="flex justify-between items-center">
            <h5 class="card-header">Контакты</h5>

            <button
                    data-crud-open
                    data-modal="#optionModal"
                    data-form="#optionForm"
                    data-title-create="Добавить опцию"
                    class="btn btn-primary px-[26.5px]!"
            >
                + Добавить
            </button>
        </div>

        @include('admin.sorter-form.options-sorter')

        <div class="">
            <table class="table bg-light">
                <thead class="table-header bg-light shadow-md rounded-2xl">
                <tr>
                    <th>
                        <x-table-sorter label="Название" field="name" :sort="$sort" :direction="$direction"/>
                    </th>
                    <th>Значение</th>
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
                @foreach($options as $option)
                    <tr class="border-bottom shadow-md hover:shadow-md rounded-2xl hover:bg-gray-50">
                        <td class="truncate-text">{{ $option->name }}</td>
                        <td>{{ $option->value }}</td>
                        <td><span class="badge bg-label-primary me-1">{{ $option->creator?->name }}</span></td>
                        <td><span class="badge bg-label-primary me-1">{{ $option->updater?->name }}</span></td>

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
                                            data-modal="#optionModal"
                                            data-form="#optionForm"
                                            data-id="{{ $option->id }}"
                                            data-name="{{ $option->name }}"
                                            data-value="{{ $option->value }}"
                                            data-title-edit="Редактировать опцию"
                                    >
                                        <i class="icon-base bx bx-edit-alt me-1"></i> Редактировать
                                    </button>

                                    {{-- DELETE --}}
                                    <button
                                            class="dropdown-item"
                                            data-crud-delete
                                            data-id="{{ $option->id }}"
                                            data-url="/admin/options/{id}"
                                            data-confirm="Удалить опцию?"
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
                    id="optionModal"
                    class="fixed inset-0 z-[9999] bg-black/35 backdrop-blur-md hidden justify-center "
            >
                <div class="w-3/4">
                    <div class="bg-white p-6 rounded-lg mx-20">
                        <h2 class="text-lg font-semibold mb-4">Добавить опцию</h2>

                        @include('admin.form.option-form')
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
