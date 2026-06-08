<form
        id="reviewFormAdmin"
        enctype="multipart/form-data"
        data-crud-form
        data-create-url="/admin/reviews"
        data-update-url="/admin/reviews/{id}"
        data-mode="create"
        class="flex flex-col gap-4"
>
    <!-- Имя автора -->
    <label for="author" class="text-gray-800 font-medium">Ваше имя *</label>
    <input
            type="text"
            name="author"
            id="author"
            placeholder="Ваше имя *"
            class="border border-gray-500 px-3 py-1 rounded-sm ring-1 focus:ring-2 focus:ring-brand-primary outline-none text-gray-800"
    >

    <!-- Телефон -->
    <label for="author_phone_number" class="text-gray-800 font-medium">Номер телефона *</label>
    <input
            type="text"
            name="author_phone_number"
            id="author_phone_number"
            placeholder="Номер телефона *"
            class="border border-gray-500 px-3 py-1 rounded-sm ring-1 focus:ring-2 focus:ring-brand-primary outline-none text-gray-800"
    >

    <!-- Отзыв -->
    <label for="text" class="text-gray-800 font-medium">Ваш отзыв *</label>
    <textarea
            name="text"
            id="text"
            placeholder="Ваш отзыв *"
            class="border border-gray-500 px-3 py-1 rounded-sm h-15 ring-1 resize-none focus:ring-2 focus:ring-brand-primary outline-none text-gray-800"
    ></textarea>
    <div class="flex">
        <!-- Аватар -->
        <label for="author_image_url" class="text-sm font-semibold text-gray-900 cursor-pointer flex flex-col">
            <span class="underline text-base mb-1 hover:text-brand-primary">+ Загрузить аватар</span>
            <input type="file" name="author_image_url" id="author_image_url" accept="image/*">

            <img
                    data-preview="authorImage"
                    src=""
                    class="hidden w-16 h-16 object-cover rounded-md mt-2 border border-gray-400"
                    alt="Preview"
            >
        </label>

        <!-- Прикреплённый файл -->
        <label for="attachment_url" class="text-sm font-semibold text-gray-900 cursor-pointer flex flex-col">
            <span class="underline text-base mb-1 hover:text-brand-primary">+ Прикрепить файл</span>
            <input type="file" name="attachment_url" id="attachment_url" accept="image/*">

            <img
                    data-preview="attachment"
                    src=""
                    class="hidden w-16 h-16 object-cover rounded-md mt-2 border border-gray-400"
                    alt="Preview"
            >
        </label>
    </div>
    <!-- Чекбокс публикации -->
    <label class="flex items-center gap-3 text-gray-800 font-medium cursor-pointer select-none mt-1">
        <input type="checkbox" name="published" value="1" class="w-4 h-4 accent-brand-primary cursor-pointer">
        Опубликовать
    </label>

    <!-- Кнопки -->
    <div class="mt-2 flex justify-end gap-3">
        <button
                type="button"
                data-crud-close
                data-modal="#reviewModalAdmin"
                class="btn btn-secondary"
        >
            Отмена
        </button>

        <button type="submit" class="btn btn-primary">
            Сохранить
        </button>
    </div>
</form>
