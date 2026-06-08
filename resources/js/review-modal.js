import axios from "axios";

document.addEventListener('DOMContentLoaded', () =>{
    const openButton = document.querySelector('.openReviewModal')
    const modal = document.getElementById('reviewModal')
    if (!modal) return;
    const closeButton = document.querySelector('.closeReviewModal')
    const modalWindow = modal.querySelector('.modal-window');
    const form = document.getElementById('reviewForm');
    if (openButton){
        openButton.addEventListener('click', ()=>{
            modal.classList.remove('hidden')
            modal.classList.add('flex')
            requestAnimationFrame(() => {
                modalWindow.classList.remove('translate-y-10', 'opacity-0');
                modalWindow.classList.add('translate-y-0', 'opacity-100');
            });
        })
    }
    if (closeButton){
        closeButton.addEventListener('click', ()=>{
            modalWindow.classList.remove('translate-y-0', 'opacity-100')
            modalWindow.classList.add('translate-y-10', 'opacity-0')
            setTimeout(() =>{
                modal.classList.remove('flex')
                modal.classList.add('hidden')
            }, 400)
        })
    }
    modal.addEventListener('click', (e) => {
        if (e.target === modal) {
            modalWindow.classList.remove('translate-y-0', 'opacity-100');
            modalWindow.classList.add('translate-y-10', 'opacity-0');
            setTimeout(() => {
                modal.classList.add('hidden');
                modal.classList.remove('flex')
            },400);
        }
    });
    form.addEventListener('submit' , async (e)=>{
        e.preventDefault();
        const formData = new FormData(form);
        const url = '/reviews/request'
        try{
            let response
            response = await axios.post(url, formData)
            if (response.status === 200 && response.status < 300) {
                location.reload();
            }
        }catch (e){
            console.error('Ошибка', e.response?.data || e.message)
        }
        modal.classList.remove('flex')
        modal.classList.add('hidden')
        form.reset()
    })
    document.getElementById('author_image_url').addEventListener('change', function () {
        const fileLabelText = document.getElementById('fileLabelText');
        const successIcon = document.getElementById('fileSuccessIcon');

        if (this.files && this.files.length > 0) {
            fileLabelText.textContent = 'Фотография загружена';
            fileLabelText.classList.remove('underline');
            fileLabelText.classList.add('text-green-600', 'font-medium');
            successIcon.classList.remove('file-success');
        } else {
            fileLabelText.textContent = '+ Прикрепить файл';
            fileLabelText.classList.add('underline');
            fileLabelText.classList.remove('text-green-600', 'font-medium');
            successIcon.classList.add('file-success');
        }
    });

})