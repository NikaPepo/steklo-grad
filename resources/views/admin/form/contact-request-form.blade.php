<form
        id="dashboardForm"
        enctype="multipart/form-data"
        data-crud-form
        data-create-url="/admin/dashboard"
        data-update-url="/admin/dashboard/{id}"
        data-mode="create"
        class="flex flex-col gap-4"
>
    <!-- Имя заявителя -->
    <label for="name" class="text-gray-800 font-medium">Имя заявителя *</label>
    <input
            type="text"
            name="name"
            id="name"
            placeholder="Имя заявителя *"
            class="border border-gray-500 px-3 py-1 rounded-sm ring-1 focus:ring-2 focus:ring-brand-primary outline-none text-gray-800"
    >

    <!-- Номер телефона -->
    <label for="phone_number" class="text-gray-800 font-medium">Номер телефона *</label>
    <input
            type="text"
            name="phone_number"
            id="phone_number"
            placeholder="Номер телефона *"
            class="border border-gray-500 px-3 py-1 rounded-sm ring-1 focus:ring-2 focus:ring-brand-primary outline-none text-gray-800"
    >

    <!-- Заметка -->
    <label for="admin_comment" class="text-gray-800 font-medium">Заметка</label>
    <input
            type="text"
            name="admin_comment"
            id="admin_comment"
            placeholder="Заметка"
            class="border border-gray-500 px-3 py-1 rounded-sm ring-1 focus:ring-2 focus:ring-brand-primary outline-none text-gray-800"
    >

    <!-- Кнопки -->
    <div class="mt-2 flex justify-end gap-3">
        <button
                type="button"
                data-crud-close
                data-modal="#dashboardModal"
                class="btn btn-secondary"
        >
            Отмена
        </button>

        <button
                type="submit"
                class="btn btn-primary"
        >
            Сохранить
        </button>
    </div>
</form>
