@extends('layouts/contentNavbarLayout')
@section('title', 'Главная')
@section('content')
    <div class="card">
        <div class="flex justify-between items-center">
            <h5 class="card-header">Заявки</h5>

            <button
                    class="btn btn-primary px-[26.5px]!"
                    data-crud-open
                    data-modal="#dashboardModal"
                    data-form="#dashboardForm"
                    data-title-create="Добавить заявку"
            >
                + Добавить
            </button>
        </div>

        <div class="">
            <table class="table bg-light">
                <thead class="table-header bg-light shadow-md rounded-2xl">
                <tr>
                    <th>Имя</th>
                    <th>Номер телефона</th>
                    <th>
                        <x-table-sorter label="Дата" field="date" :sort="$sort" :direction="$direction"></x-table-sorter>
                    </th>
                    <th>Заметки админа</th>
                    <th>Действия</th>
                </tr>
                </thead>

                <tbody>
                @foreach($contactRequests as $contactRequest)
                    <tr data-id="{{$contactRequest->id}}"
                        class="border-bottom shadow-md hover:shadow-md rounded-2xl hover:bg-gray-50">
                        <td class="truncate-text">{{$contactRequest->name}}</td>
                        <td class="truncate-text">{{$contactRequest->phone_number}}</td>
                        <td>{{$contactRequest->created_at->timezone('Europe/Moscow')->translatedFormat('H:i, d F Y')}}</td>
                        <td>{{$contactRequest->admin_comment}}</td>

                        <td>
                            <div class="dropdown">
                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                    <i class="icon-base bx bx-dots-vertical-rounded"></i>
                                </button>

                                <div class="dropdown-menu">
                                    <button
                                            class="dropdown-item"
                                            data-crud-edit
                                            data-modal="#dashboardModal"
                                            data-form="#dashboardForm"
                                            data-title-edit="Редактировать заявку"
                                            data-id="{{$contactRequest->id}}"
                                            data-name="{{$contactRequest->name}}"
                                            data-phone_number="{{$contactRequest->phone_number}}"
                                            data-admin_comment="{{$contactRequest->admin_comment}}"
                                    >
                                        <i class="icon-base bx bx-edit-alt me-1"></i> Редактировать
                                    </button>

                                    <button
                                            class="dropdown-item"
                                            data-crud-delete
                                            data-id="{{$contactRequest->id}}"
                                            data-confirm="Удалить заявку?"
                                            data-url="/admin/dashboard/{id}"
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
                    id="dashboardModal"
                    class="fixed inset-0 z-[9999] bg-black/35 backdrop-blur-md hidden justify-center"
            >
                <div class="w-3/4 px-4">
                    <div class="bg-white p-4 rounded-lg">

                        <div class="flex items-center justify-between mb-4">
                            <h2 class="text-lg font-semibold">Добавить заявку</h2>


                            <button
                                    type="button"
                                    class="p-2 rounded hover:bg-gray-100"
                                    data-crud-close
                                    data-modal="#dashboardModal"
                                    aria-label="Закрыть"
                            >
                            </button>
                        </div>

                        @include('admin.form.contact-request-form')


                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
