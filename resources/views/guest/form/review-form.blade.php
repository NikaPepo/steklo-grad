<div id="reviewModal"
     class="fixed inset-0 bg-black/35 backdrop-blur-md items-center justify-center z-50 hidden">

    <div class="modal-window bg-white rounded-md p-10 w-full max-w-lg relative shadow-xl
                translate-y-10 opacity-0 transition-all duration-500">

        <div class="flex justify-between mb-6">
            <h2 class="text-5xl font-semibold text-gray-900 leading-tight">
                Оставить отзыв
            </h2>

            <button class="absolute right-5 top-5 closeReviewModal cursor-pointer">
                <i class="bx bx-x text-3xl scale-125"></i>
            </button>
        </div>
        <form class="flex flex-col gap-4" enctype="multipart/form-data" id="reviewForm">

            <input type="text" placeholder="Ваше имя*" name="author" id="author" autocomplete="name"
                   class="border border-gray-400 px-3 py-2 rounded-sm focus:ring-2 focus:ring-brand-primary outline-none">

            <input type="text" placeholder="Номер телефона*" name="author_phone_number" id="author_phone_number"
                   class="border border-gray-400 px-3 py-2 rounded-sm focus:ring-2 focus:ring-brand-primary outline-none">

            <textarea placeholder="Ваш отзыв*" name="text" id="text"
                      class="border border-gray-400 px-3 py-2 rounded-sm h-32 resize-none focus:ring-2 focus:ring-brand-primary outline-none"></textarea>
            <label id="fileLabel" class="text-sm text-gray-700 cursor-pointer flex items-center gap-2">
                <input type="file" name="author_image_url" id="author_image_url" class="hidden">
                <span id="fileLabelText" class="underline hover:text-gray-900">+ Прикрепить файл</span>
                <i id="fileSuccessIcon" class="bx bx-check text-green-600 text-xl file-success"></i>
            </label>


            <button type="submit"
                    class="bg-brand-primary text-white py-3 rounded-sm font-medium hover:bg-[#9BA8B8]
                          shadow-md hover:shadow-lg
                          transition-colors duration-600 ease-in-out cursor-pointer">
                Отправить
            </button>
        </form>

        <p class="text-xs text-gray-600 mt-4">
            *Нажимая на кнопку, Вы соглашаетесь
            <a href="{{ route('privacy.index') }}" class="underline hover:text-gray-900">
                на обработку персональных данных
            </a>
        </p>
    </div>
</div>
