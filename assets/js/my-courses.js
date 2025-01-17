let addCourseModal = document.querySelector('.add-course-modal');
let addCourseModalCloseBtn = addCourseModal.querySelector('.close-btn');
let openAddModalBtn = document.querySelector('.open-add-modal-btn');

addCourseModalCloseBtn.addEventListener('click', function () {
    addCourseModal.classList.add('hidden');
    addCourseModal.classList.remove('flex');
});

openAddModalBtn.addEventListener('click', function () {
    addCourseModal.classList.remove('hidden');
    addCourseModal.classList.add('flex');
});