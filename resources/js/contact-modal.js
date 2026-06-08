import axios from "axios";

document.addEventListener('DOMContentLoaded', () => {
    const openButtons = document.querySelectorAll('.openContactModal')
    const modalContact = document.getElementById('contactModal')
    if (!modalContact) return;
    const modalWindow = modalContact.querySelector('.modal-window');
    const closeButtons = document.querySelectorAll('.closeContactModal')
    openButtons.forEach(btn => {
        btn.addEventListener('click', () => {
            modalContact.classList.remove('hidden')
            modalContact.classList.add('flex')

            requestAnimationFrame(() => {
                modalWindow.classList.remove('translate-y-10', 'opacity-0');
                modalWindow.classList.add('translate-y-0', 'opacity-100');
            });
        })
    })
    closeButtons.forEach(btn => {
        btn.addEventListener('click', () => {
            modalWindow.classList.remove('translate-y-0', 'opacity-100');
            modalWindow.classList.add('translate-y-10', 'opacity-0');
            setTimeout(() => {
                modalContact.classList.add('hidden');
                modalContact.classList.remove('flex');
            }, 400);
        })
    })
    modalContact.addEventListener('click', (e) => {
        if (e.target === modalContact) {
            modalWindow.classList.add('translate-y-10', 'opacity-0');
            modalWindow.classList.remove('translate-y-0', 'opacity-100');
            setTimeout(() => {
                modalContact.classList.add('hidden');
                modalContact.classList.remove('flex')
            },400);
        }
    });
    document.querySelectorAll('.contact-form').forEach(form => {
        form.addEventListener('submit', async (e) => {
            e.preventDefault();
            const formData = new FormData(form)
            const url = '/contact-request'
            try {
              await axios.post(url,formData)
            } catch (e) {
                console.error('Ошибка', e.response?.data || e.message);
            }
            modalContact.classList.remove('flex')
            modalContact.classList.add('hidden')
            form.reset()
        });
    });

})