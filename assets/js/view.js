let viewCourseModal = document.querySelector('.view-course-modal');
let viewCourseModalCloseBtn = viewCourseModal.querySelector('.close-btn');
let openAddModalBtn = document.querySelector('.open-course-modal');
let actionsBtn = document.querySelector('.actions-btn');

viewCourseModalCloseBtn.addEventListener('click', function () {
    viewCourseModal.classList.add('hidden');
    viewCourseModal.classList.remove('flex');
});

if (openAddModalBtn != null) {
    openAddModalBtn.addEventListener('click', function () {
        viewCourseModal.classList.remove('hidden');
        viewCourseModal.classList.add('flex');
    });
}

actionsBtn.addEventListener('click', function () {
    this.nextElementSibling.classList.toggle('hidden');
    this.nextElementSibling.classList.toggle('flex');
});

/* Confirm Delete  */

let confirmDeleteModal = document.querySelector('.confirm-delete-modal');
let closeconfirmDeleteModal = confirmDeleteModal.querySelector('.close-btn');
let deleteCourseBtn = document.querySelector('.delete-course-btn');

if (closeconfirmDeleteModal) {
    closeconfirmDeleteModal.addEventListener('click', function () {
        confirmDeleteModal.classList.add('hidden');
        confirmDeleteModal.classList.remove('flex');
    });
}

if (deleteCourseBtn) {
    deleteCourseBtn.addEventListener('click', function () {
        actionsBtn.nextElementSibling.classList.add('hidden');
        actionsBtn.nextElementSibling.classList.remove('flex');
        confirmDeleteModal.classList.remove('hidden');
        confirmDeleteModal.classList.add('flex');
    });
}