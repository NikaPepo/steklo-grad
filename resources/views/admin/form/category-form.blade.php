<form
        id="categoryForm"
        enctype="multipart/form-data"
        data-crud-form
        data-create-url="/admin/categories"
        data-update-url="/admin/categories/{id}"
        data-mode="create"
        class="flex flex-col gap-4"
>
    <!-- Название -->
    <label for="name" class="text-gray-800 font-medium">Название категории *</label>
    <input
            type="text"
            name="name"
            id="name"
            placeholder="Название категории *"
            class="border border-gray-500 px-3 py-1 rounded-sm ring-1 focus:ring-2 focus:ring-brand-primary outline-none"
    >

    <!-- Выбор родителя -->
    <label for="parent_id" class="text-gray-800 font-medium">Родительская категория</label>
    <select
            name="parent_id"
            id="parent_id"
            data-rebuild="parent"
            class="border border-gray-500 px-3 py-1 rounded-sm ring-1 focus:ring-2 focus:ring-brand-primary outline-none text-gray-700"
    ></select>

    <!-- Мета-заголовок -->
    <label for="meta_title" class="text-gray-800 font-medium">Мета-заголовок</label>
    <input
            type="text"
            name="meta_title"
            id="meta_title"
            placeholder="Мета-заголовок"
            class="border border-gray-500 px-3 py-1 rounded-sm ring-1 focus:ring-2 focus:ring-brand-primary outline-none"
    >

    <!-- Мета-описание -->
    <label for="meta_description" class="text-gray-800 font-medium">Мета-описание</label>
    <textarea
            name="meta_description"
            id="meta_description"
            placeholder="Мета-описание"
            class="border border-gray-500 px-3 py-1 rounded-sm h-11 ring-1 resize-none focus:ring-2 focus:ring-brand-primary outline-none"
    ></textarea>

    <!-- Загрузка файла -->
    <div class="flex">
        <label for="thumbnail_url" class="text-sm font-semibold text-gray-800 cursor-pointer">
            <span class="underline text-base hover:text-brand-primary">+ Загрузить изображение</span>

            <input
                    type="file"
                    name="thumbnail_url"
                    id="thumbnail_url"
                    accept="image/*"
                    class="peer text-sm text-gray-600 font-medium"
            >

            <img
                    data-preview="thumbnail"
                    src=""
                    alt="Preview"
                    class="hidden h-16 w-16 object-cover rounded-md mt-2"
            >
        </label>
        <label for="meta_image" class="text-sm font-semibold text-gray-800 cursor-pointer">
            <span class="underline text-base hover:text-brand-primary">+ Загрузить Мета-изображение</span>

            <input
                    type="file"
                    name="meta_image"
                    id="meta_image"
                    accept="image/*"
                    class="peer text-sm text-gray-600 font-medium"
            >

            <img
                    data-preview="meta_image"
                    src=""
                    alt="Preview"
                    class="hidden h-16 w-16 object-cover rounded-md mt-2"
            >
        </label>
    </div>
    <!-- Кнопки -->
    <div class="mt-2 flex justify-end gap-3">
        <button
                type="button"
                data-crud-close
                data-modal="#categoryModal"
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
