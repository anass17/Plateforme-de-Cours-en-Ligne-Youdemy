/* Category */

let categoryModal = document.querySelector('.category-modal');
let categoryModalCloseBtn = categoryModal.querySelector('.close-btn');
let addCategoryModal = document.querySelector('.add-category');
let addCategories = document.querySelector('.add-categories');
let input = document.querySelector('#cat_name');
let categoryBtns = document.querySelectorAll('.category-btn');

/* Tag */

let tagModal = document.querySelector('.tag-modal');
let tagModalCloseBtn = tagModal.querySelector('.close-btn');
let addTagModal = document.querySelector('.add-tag');
let addTags = document.querySelector('.add-tags');
let tagBtns = document.querySelectorAll('.tag-btn');
let TagInput = document.querySelector('#tag_name');



///////////////////////////////////
/// Search
///////////////////////////////////



let searchCats = document.querySelector('#search-cats');
let searchTags = document.querySelector('#search-tags');

searchCats.addEventListener('keyup', function () {
    categoryBtns.forEach(btn => {
        if (this.value == "" || btn.textContent.toLowerCase().search(this.value.toLowerCase()) >= 0) {
            btn.style.display = "block";
        } else {
            btn.style.display = "none";
        }
    })
});

searchTags.addEventListener('keyup', function () {
    tagBtns.forEach(btn => {
        if (this.value == "" || btn.textContent.toLowerCase().search(this.value.toLowerCase()) >= 0) {
            btn.style.display = "block";
        } else {
            btn.style.display = "none";
        }
    })
});



///////////////////////////////////
/// Add Categories
///////////////////////////////////

categoryModalCloseBtn.addEventListener('click', function () {
    categoryModal.classList.add('hidden');
    categoryModal.classList.remove('flex');
});

addCategoryModal.addEventListener('click', function () {
    categoryModal.classList.remove('hidden');
    categoryModal.classList.add('flex');
});

addCategories.addEventListener('click', function () {
    fetch('/api/CategoryApi.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({
            categories: input.value,
        })
    })
    .then(response => response.json())
    .then(data => {

        if (data.status == false) {
            createAlert('Error', data.message);
        } else {
            createAlert('Success', data.message);
        }

        categoryModal.classList.add('hidden');
        categoryModal.classList.remove('flex');

        JSON.parse(input.value).forEach(element => {
            let tab = document.createElement('button');
            tab.className = "text-gray-700 bg-white category-btn hover:bg-gray-100 font-semibold";
            tab.textContent = element.value;
            addCategoryModal.after(tab);
        });

        input.value = "";

    });
});



//////////////////////////////////////
/// Edit / Delete Category
//////////////////////////////////////



let editCategoryModal = document.querySelector('.edit-category-modal');
let editCategoryModalCloseBtn = editCategoryModal.querySelector('.close-btn');
let editCatId = editCategoryModal.querySelector('#edit-cat-id');
let catOldName = editCategoryModal.querySelector('#cat-old-name');
let editCatName = editCategoryModal.querySelector('#edit-cat-name');
let editCategoryBtn = editCategoryModal.querySelector('.edit-category');
let deleteCategory = editCategoryModal.querySelector('.delete-category');
let CatToEdit = null;


categoryBtns.forEach(btn => {
    btn.addEventListener('click', function () {
        editCategoryModal.classList.remove('hidden');
        editCategoryModal.classList.add('flex');
        editCatId.value = this.dataset.id;
        catOldName.value = this.dataset.name;
        CatToEdit = this;
    });
})

/* Close Edit Modal */

editCategoryModalCloseBtn.addEventListener('click', function () {
    editCategoryModal.classList.add('hidden');
    editCategoryModal.classList.remove('flex');
});

/* Edit Category */

editCategoryBtn.addEventListener('click', function () {
    if (editCatName.value == "") {
        return;
    }

    fetch('/api/CategoryApi.php', {
        method: 'PUT',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({
            catId: editCatId.value,
            catName: editCatName.value
        })
    })
    .then(response => response.json())
    .then(data => {

        if (data.status == false) {
            createAlert('Error', data.message);
        } else {
            createAlert('Success', data.message);
            CatToEdit.textContent = data.result;
            CatToEdit.dataset.name = data.result;
        }

        editCategoryModal.classList.add('hidden');
        editCategoryModal.classList.remove('flex');

        editCatName.value = "";

    });
});

/* Delete Category */

deleteCategory.addEventListener('click', function () {
    fetch('/api/CategoryApi.php', {
        method: 'Delete',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({
            catId: editCatId.value,
            catName: catOldName.value
        })
    })
    .then(response => response.json())
    .then(data => {

        if (data.status == false) {
            createAlert('Error', data.message);
        } else {
            createAlert('Success', data.message);
            CatToEdit.remove();
        }

        editCategoryModal.classList.add('hidden');
        editCategoryModal.classList.remove('flex');

    });
});



///////////////////////////////////
/// Add Tags
///////////////////////////////////



tagModalCloseBtn.addEventListener('click', function () {
    tagModal.classList.add('hidden');
    tagModal.classList.remove('flex');
});

addTagModal.addEventListener('click', function () {
    tagModal.classList.remove('hidden');
    tagModal.classList.add('flex');
});

addTags.addEventListener('click', function () {
    fetch('/api/TagApi.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({
            tags: TagInput.value,
        })
    })
    .then(response => response.json())
    .then(data => {

        if (data.status == false) {
            createAlert('Error', data.message);
        } else {
            createAlert('Success', data.message);
        }

        tagModal.classList.add('hidden');
        tagModal.classList.remove('flex');

        JSON.parse(TagInput.value).forEach(element => {
            let tab = document.createElement('button');
            tab.className = "text-gray-700 bg-white category-btn hover:bg-gray-100 font-semibold";
            tab.textContent = element.value;
            addTagModal.after(tab);
        });

        TagInput.value = "";

    });
});



//////////////////////////////////////
/// Edit / Delete Tags
//////////////////////////////////////



let editTagModal = document.querySelector('.edit-tag-modal');
let editTagModalCloseBtn = editTagModal.querySelector('.close-btn');
let editTagId = editTagModal.querySelector('#edit-tag-id');
let tagOldName = editTagModal.querySelector('#tag-old-name');
let editTagName = editTagModal.querySelector('#edit-tag-name');
let editTagBtn = editTagModal.querySelector('.edit-tag');
let deleteTag = editTagModal.querySelector('.delete-tag');
let TagToEdit = null;


tagBtns.forEach(btn => {
    btn.addEventListener('click', function () {
        editTagModal.classList.remove('hidden');
        editTagModal.classList.add('flex');
        editTagId.value = this.dataset.id;
        tagOldName.value = this.dataset.name;
        TagToEdit = this;
    });
})

/* Close Edit Modal */

editTagModalCloseBtn.addEventListener('click', function () {
    editTagModal.classList.add('hidden');
    editTagModal.classList.remove('flex');
});

/* Edit Tag */

editTagBtn.addEventListener('click', function () {
    if (editTagName.value == "") {
        return;
    }

    fetch('/api/TagApi.php', {
        method: 'PUT',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({
            tagId: editTagId.value,
            tagName: editTagName.value
        })
    })
    .then(response => response.json())
    .then(data => {

        if (data.status == false) {
            createAlert('Error', data.message);
        } else {
            createAlert('Success', data.message);
            TagToEdit.textContent = data.result;
            TagToEdit.dataset.name = data.result;
        }

        editTagModal.classList.add('hidden');
        editTagModal.classList.remove('flex');

        editTagName.value = "";

    });
});

/* Delete Tag */

deleteTag.addEventListener('click', function () {
    fetch('/api/TagApi.php', {
        method: 'Delete',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({
            tagId: editTagId.value,
            tagName: tagOldName.value
        })
    })
    .then(response => response.json())
    .then(data => {

        if (data.status == false) {
            createAlert('Error', data.message);
        } else {
            createAlert('Success', data.message);
            TagToEdit.remove();
        }

        editTagModal.classList.add('hidden');
        editTagModal.classList.remove('flex');

    });
});

//////////////////////////////////////
/// Tagify
//////////////////////////////////////



let options = {
    placeholder: "Type and press Enter"
}

let tagify1 = new Tagify(input, options);
let tagify2 = new Tagify(TagInput, options);