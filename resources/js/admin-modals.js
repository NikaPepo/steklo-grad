
import axios from "axios";
import {
    rebuildParentSelect,
    rebuildCategorySelect,
    rebuildAlbumSelect,
} from "./selectRebuild.js";
document.addEventListener('DOMContentLoaded', () => {

    const rebuilders = {
        parent: rebuildParentSelect,
        category: rebuildCategorySelect,
        album: rebuildAlbumSelect,
    };

    const $ = (sel, root = document) => root.querySelector(sel);

    function show(modal) {
        modal.classList.remove("hidden");
        modal.classList.add("flex");
    }

    function hide(modal) {
        modal.classList.remove("flex");
        modal.classList.add("hidden");
    }

    function resetCreate(form) {
        form.reset();
        delete form.dataset.id;
        form.dataset.mode = "create";
    }

    function setTitle(modal, text) {
        const h2 = modal.querySelector("h2");
        if (h2) h2.textContent = text || "";
    }

// <img data-preview="image">, <img data-preview="thumbnail"> ...
    function setPreview(modal, key, url) {
        const img = modal.querySelector(`[data-preview="${key}"]`);
        if (!img) return;
    
        if (!url) {
            img.src = "";
            img.classList.add("hidden");
            return;
        }

        img.src = url;
        img.classList.remove("hidden");
    }

// select: <select name="parent_id" data-rebuild="parent">
    async function rebuildSelect(form, selected = null) {
        const select = form.querySelector("select[data-rebuild]");
        if (!select) return;

        const type = select.dataset.rebuild;
        const fn = rebuilders[type];
        if (!fn) return;

        await fn(select, selected);
    }

    function fillFormFromDataset(form, dataset) {
        for (const [key, val] of Object.entries(dataset)) {
            if (
                key === "crudEdit" ||
                key === "crudOpen" ||
                key === "crudClose" ||
                key === "crudDelete" ||
                key === "modal" ||
                key === "form" ||
                key === "url" ||
                key === "meta_image" ||
                key === "confirm" ||
                key === "titleCreate" ||
                key === "titleEdit"
            ) continue;

            // чекбоксы
            const cb = form.querySelector(`[name="${key}"][type="checkbox"]`);
            if (cb) {
                cb.checked = val === "1" || val === "true" || val === true;
                continue;
            }

            const input = form.querySelector(`[name="${key}"]`);
            if (input) input.value = val ?? "";
        }
    }

    document.addEventListener("click", async (e) => {
        // OPEN create modal
        const openBtn = e.target.closest("[data-crud-open]");
        if (openBtn) {
            const modal = $(openBtn.dataset.modal);
            const form = $(openBtn.dataset.form);
            if (!modal || !form) return;

            resetCreate(form);

            setTitle(modal, openBtn.dataset.titleCreate || "Добавить");

            // очистка превьюшек
            // data-clear-previews="image,thumbnail"
            const clears = (openBtn.dataset.clearPreviews || "")
                .split(",")
                .map(s => s.trim())
                .filter(Boolean);

            clears.forEach((k) => setPreview(modal, k, ""));

            await rebuildSelect(form);
            show(modal);
            return;
        }

        // CLOSE modal
        const closeBtn = e.target.closest("[data-crud-close]");
        if (closeBtn) {
            const modal = $(closeBtn.dataset.modal);
            if (!modal) return;
            hide(modal);
            return;
        }

        // EDIT modal
        const editBtn = e.target.closest("[data-crud-edit]");
        if (editBtn) {
            const modal = $(editBtn.dataset.modal);
            const form = $(editBtn.dataset.form);
            if (!modal || !form) return;

            form.dataset.mode = "update";
            form.dataset.id = editBtn.dataset.id;

            fillFormFromDataset(form, editBtn.dataset);

            setTitle(modal, editBtn.dataset.titleEdit || "Редактировать");


            setPreview(modal, "thumbnail", editBtn.dataset.previewThumbnailUrl || "");
            setPreview(modal, "meta_image", editBtn.dataset.previewMetaUrl || "");
            setPreview(modal, "image", editBtn.dataset.previewImageUrl || "");
            setPreview(modal, "attachment", editBtn.dataset.previewAttachmentUrl || "");
            setPreview(modal, "authorImage", editBtn.dataset.previewAuthorImageUrl || "");


            const selected =
                editBtn.dataset.selected ||
                editBtn.dataset.parent_id ||
                editBtn.dataset.category_id ||
                editBtn.dataset.album_id ||
                null;

            await rebuildSelect(form, selected);


            const parentSel = form.querySelector('select[name="parent_id"]');
            if (parentSel) {
                [...parentSel.options].forEach(opt => {
                    opt.disabled = opt.value === form.dataset.id;
                });
            }

            show(modal);
            return;
        }


        const delBtn = e.target.closest("[data-crud-delete]");
        if (delBtn) {
            const confirmText = delBtn.dataset.confirm || "Удалить?";
            if (!confirm(confirmText)) return;

            const urlTpl = delBtn.dataset.url;     // "/admin/categories/{id}"
            const id = delBtn.dataset.id;          // "12"
            if (!urlTpl || !id) return;

            const url = urlTpl.replace("{id}", id);

            try {
                const res = await axios.delete(url);
                if (res.status >= 200 && res.status < 300) location.reload();
            } catch (err) {
                console.error("Ошибка", err.response?.data || err.message);
            }
        }
    });


    document.addEventListener("submit", async (e) => {
        const form = e.target.closest("[data-crud-form]");
        if (!form) return;

        e.preventDefault();

        const createUrl = form.dataset.createUrl;   // "/admin/categories"
        const updateUrl = form.dataset.updateUrl;   // "/admin/categories/{id}"
        const mode = form.dataset.mode || "create";
        if (!createUrl || !updateUrl) {
            console.error("У формы нет data-create-url / data-update-url");
            return;
        }

        const fd = new FormData(form);

        let url = createUrl;

        try {
            if (mode === "update") {
                const id = form.dataset.id;
                url = updateUrl.replace("{id}", id);
                fd.append("_method", "PUT");
            }
            const res = await axios.post(url, fd);
            if (res.status >= 200 && res.status < 300) location.reload();
        } catch (err) {
            console.error("Ошибка", err.response?.data || err.message);
        }
    });

})