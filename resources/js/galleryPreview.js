document.addEventListener('DOMContentLoaded', ()=> {
    const buttons = document.querySelectorAll('.galleryPreviewButton')

    buttons.forEach( btn =>{
        btn.addEventListener('click', ()=>{
            document.getElementById('galleryPreview').scrollIntoView({
                behavior:"smooth"
            })
        })
    })
})