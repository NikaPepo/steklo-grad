<form
        id="albumForm"
        enctype="multipart/form-data"
        data-crud-form
        data-create-url="/admin/albums"
        data-update-url="/admin/albums/{id}"
        data-mode="create"
        class="flex flex-col gap-4"
>
    <!-- Название альбома -->
    <label for="name" class="text-gray-800 font-medium">Название альбома *</label>
    <input
            type="text"
            id="name"
            name="name"
            placeholder="Название альбома *"
            class="border border-gray-500 px-3 py-1 rounded-sm ring-1 focus:ring-2 focus:ring-brand-primary outline-none text-gray-800"
    >
    <!-- Переключатели -->
    <label class="flex items-center gap-3 text-gray-800 font-medium cursor-pointer select-none mt-1">
        <input type="checkbox" name="is_visible" value="1" class="w-4 h-4 accent-brand-primary cursor-pointer">
        Показывать на сайте
    </label>

    <label class="flex items-center gap-3 text-gray-800 font-medium cursor-pointer select-none mt-1">
        <input type="checkbox" name="is_video" value="1" class="w-4 h-4 accent-brand-primary cursor-pointer">
        Видео
    </label>
    <div class="flex">
        <!-- Заставка -->
        <label class="text-sm font-semibold text-gray-900 cursor-pointer flex flex-col">
            <span class="underline text-base mb-1 hover:text-brand-primary">+ Загрузить заставку</span>
            <input type="file" name="thumbnail_url" id="thumbnail_url" accept="image/*">

            <img
                    data-preview="thumbnail"
                    src=""
                    class="hidden w-16 h-16 object-cover rounded-md mt-2 border border-gray-400"
                    alt="Preview"
            >
        </label>

        <!-- Видео -->
        <label class="text-sm font-semibold text-gray-900 cursor-pointer flex flex-col">
            <span class="underline text-base mb-1 hover:text-brand-primary">+ Загрузить видео</span>
            <input type="file" name="video_url" id="video_url" accept="video/*">
        </label>
    </div>
    <!-- Кнопки -->
    <div class="mt-2 flex justify-end gap-3">
        <button
                type="button"
                data-crud-close
                data-modal="#albumModal"
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
