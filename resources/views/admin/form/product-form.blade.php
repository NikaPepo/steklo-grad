<form
        id="productForm"
        enctype="multipart/form-data"
        data-crud-form
        data-create-url="/admin/products"
        data-update-url="/admin/products/{id}"
        data-mode="create"
        class="flex flex-col gap-4"
>
    <!-- Название продукта -->
    <label for="name" class="text-gray-800 font-medium">Название продукта *</label>
    <input
            type="text"
            name="name"
            id="name"
            placeholder="Название продукта *"
            class="border border-gray-500 px-3 py-1 rounded-sm ring-1 focus:ring-2 focus:ring-brand-primary outline-none text-gray-800"
    >

    <!-- Выбор категории -->
    <label for="category_id" class="text-gray-800 font-medium">Категория</label>
    <select
            name="category_id"
            id="category_id"
            data-rebuild="category"
            class="border border-gray-500 px-3 py-1 rounded-sm ring-1 focus:ring-2 focus:ring-brand-primary outline-none text-gray-700"
    ></select>

    <!-- Описание -->
    <label for="description" class="text-gray-800 font-medium">Описание продукта *</label>
    <textarea
            name="description"
            id="description"
            placeholder="Описание продукта *"
            class="border border-gray-500 px-3 py-1 rounded-sm h-11 ring-1 resize-none focus:ring-2 focus:ring-brand-primary outline-none text-gray-800"
    ></textarea>

    <!-- Мета-заголовок -->
    <label for="meta_title" class="text-gray-800 font-medium">Мета-заголовок</label>
    <input
            type="text"
            name="meta_title"
            id="meta_title"
            placeholder="Мета-заголовок"
            class="border border-gray-500 px-3 py-1 rounded-sm ring-1 focus:ring-2 focus:ring-brand-primary outline-none text-gray-800"
    >

    <!-- Мета-описание -->
    <label for="meta_description" class="text-gray-800 font-medium">Мета-описание</label>
    <textarea
            name="meta_description"
            id="meta_description"
            placeholder="Мета-описание"
            class="border border-gray-500 px-3 py-1 rounded-sm h-11 ring-1 resize-none focus:ring-2 focus:ring-brand-primary outline-none text-gray-800"
    ></textarea>

    <!-- Загрузка изображения -->
    <div class="flex">
        <label for="image_url" class="text-sm font-semibold text-gray-900 cursor-pointer flex flex-col">
            <span class="underline text-base mb-1 hover:text-brand-primary">+ Загрузить изображение</span>

            <input type="file" name="image_url" id="image_url" accept="image/*">
            <img
                    data-preview="image"
                    src=""
                    class="hidden w-16 h-16 object-cover rounded-md mt-2 border border-gray-400"
                    alt="Preview"
            >
        </label>

        <label for="meta_image" class="text-sm font-semibold text-gray-900 cursor-pointer flex flex-col">
            <span class="underline text-base mb-1 hover:text-brand-primary">+ Загрузить Мета-изображение</span>

            <input type="file" name="meta_image" id="meta_image" accept="image/*" >
            <img
                    data-preview="meta_image"
                    src=""
                    class="hidden w-16 h-16 object-cover rounded-md mt-2 border border-gray-400"
                    alt="Preview"
            >
        </label>
    </div>
    <!-- Кнопки -->
    <div class="mt-2 flex justify-end gap-3">
        <button
                type="button"
                data-crud-close
                data-modal="#productModal"
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

