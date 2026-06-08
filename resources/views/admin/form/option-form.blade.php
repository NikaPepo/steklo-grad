<form
        id="optionForm"
        enctype="multipart/form-data"
        data-crud-form
        data-create-url="/admin/options"
        data-update-url="/admin/options/{id}"
        data-mode="create"
        class="flex flex-col gap-4"
>
    <!-- Название опции -->
    <label for="name" class="text-gray-800 font-medium">Название опции *</label>
    <input
            type="text"
            name="name"
            id="name"
            placeholder="Название опции *"
            class="border border-gray-500 px-3 py-1 rounded-sm ring-1 focus:ring-2 focus:ring-brand-primary outline-none text-gray-800"
    >

    <!-- Значение опции -->
    <label for="value" class="text-gray-800 font-medium">Опция *</label>
    <input
            type="text"
            name="value"
            id="value"
            placeholder="Опция *"
            class="border border-gray-500 px-3 py-1 rounded-sm ring-1 focus:ring-2 focus:ring-brand-primary outline-none text-gray-800"
    >

    <!-- Кнопки -->
    <div class="mt-2 flex justify-end gap-3">
        <button
                type="button"
                data-crud-close
                data-modal="#optionModal"
                class="btn btn-secondary"
        >
            Отмена
        </button>

        <button type="submit" class="btn btn-primary">
            Сохранить
        </button>
    </div>
</form>

