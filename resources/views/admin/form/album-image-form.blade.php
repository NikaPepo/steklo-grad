<form
        id="albumImageForm"
        enctype="multipart/form-data"
        data-crud-form
        data-create-url="/admin/album-images"
        data-update-url="/admin/album-images/{id}"
        data-mode="create"
        class="flex flex-col gap-4"
>
    <!-- Выбор альбома -->
    <label for="album_id" class="text-gray-800 font-medium">Альбом</label>
    <select
            name="album_id"
            id="album_id"
            data-rebuild="album"
            class="border border-gray-500 px-3 py-1 rounded-sm ring-1 focus:ring-2 focus:ring-brand-primary outline-none text-gray-700"
    ></select>

    <!-- Заголовок -->
    <label for="title" class="text-gray-800 font-medium">Заголовок</label>
    <input
            type="text"
            name="title"
            id="title"
            placeholder="Заголовок"
            class="border border-gray-500 px-3 py-1 rounded-sm ring-1 focus:ring-2 focus:ring-brand-primary outline-none text-gray-800"
    >

    <!-- Подзаголовок -->
    <label for="subtitle" class="text-gray-800 font-medium">Подзаголовок</label>
    <input
            type="text"
            name="subtitle"
            id="subtitle"
            placeholder="Подзаголовок"
            class="border border-gray-500 px-3 py-1 rounded-sm ring-1 focus:ring-2 focus:ring-brand-primary outline-none text-gray-800"
    >

    <!-- Картинка -->
    <label class="text-sm font-semibold text-gray-900 cursor-pointer flex flex-col">
        <span class="underline text-base mb-1 hover:text-brand-primary">+ Загрузить изображение</span>

        <input type="file" name="url" id="url" accept="image/*">

        <img
                data-preview="image"
                src=""
                class="hidden w-16 h-16 object-cover rounded-md mt-2 border border-gray-400"
                alt="Preview"
        >
    </label>
    <!-- Кнопки -->
    <div class="mt-2 flex justify-end gap-3">
        <button
                type="button"
                data-crud-close
                data-modal="#albumImageModal"
                class="btn btn-secondary"
        >
            Отмена
        </button>

        <button type="submit" class="btn btn-primary">
            Сохранить
        </button>
    </div>
</form>
