
export async function rebuildParentSelect(SelectElement, CurrentCategoryId = null) {
    if (!SelectElement) return;
    const savedCategoryId = CurrentCategoryId ? Number(CurrentCategoryId) : null;
    SelectElement.innerHTML = '<option value="">Главный раздел</option>'
    try {
        const response = await axios.post('/admin/categories/list')
        const categories = response.data.categoryList
        categories.forEach(cat => {
            const option = document.createElement('option')
            option.value = cat.id;
            option.textContent = `${cat.name}${cat.parent ? '/' + cat.parent.name : ''}`;
            SelectElement.appendChild(option)
            if (savedCategoryId === cat.id){
                option.selected = true
            }
        });
    } catch (e) {
        console.error('Ошибка загрузки категорий', e);
    }
}

export async function rebuildCategorySelect(SelectElement, CurrentCategoryId = null) {
    if (!SelectElement) return;
    const savedCategoryId = CurrentCategoryId ? Number(CurrentCategoryId) : null;
    SelectElement.innerHTML = ''
    try {
        const response = await axios.post('/admin/products/parentList')
        const parentList = response.data.parentList
        parentList.forEach(cat => {
            const option = document.createElement('option')
            option.value = cat.id
            option.textContent = cat.name
            SelectElement.appendChild(option)
            if (savedCategoryId === cat.id){
                option.selected = true
            }
        });
    } catch (e) {
        console.error('Ошибка загрузки категорий', e);
    }
}

export async function rebuildAlbumSelect(SelectElement,CurrentAlbumId = null) {
    if (!SelectElement) return;
    const SavedAlbumId = CurrentAlbumId ? Number(CurrentAlbumId) : null
    SelectElement.innerHTML = ''
    try {
        const response = await axios.post('/admin/albums/list')
        const albums = response.data.albums
        albums.forEach(album => {
            const option = document.createElement('option')
            option.value = album.id
            option.textContent = album.name
            SelectElement.appendChild(option)
            if (SavedAlbumId === album.id){
                option.selected = true
            }
        })
    } catch (e) {
        console.error('Ошибка загрузки', e)
    }
}


