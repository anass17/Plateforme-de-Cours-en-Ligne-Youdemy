let addCourseModal = document.querySelector('.add-course-modal');
let addCourseModalCloseBtn = addCourseModal.querySelector('.close-btn');
let openAddModalBtn = document.querySelector('.open-add-modal-btn');
let formCourseBackground = document.querySelector('#form-course-background');
let videoCourseType = document.querySelector('#video-course-type');
let documentCourseType = document.querySelector('#document-course-type');
let formCourseFile = document.querySelector('#form-course-file');

addCourseModalCloseBtn.addEventListener('click', function () {
    addCourseModal.classList.add('hidden');
    addCourseModal.classList.remove('flex');
});

openAddModalBtn.addEventListener('click', function () {
    addCourseModal.classList.remove('hidden');
    addCourseModal.classList.add('flex');
});

formCourseBackground.addEventListener('change', function () {
    this.previousElementSibling.innerHTML = 'Image Successfully Uploaded';
});

videoCourseType.addEventListener('change', function () {
    formCourseFile.previousElementSibling.innerHTML = 
    `
        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 fill-gray-800" viewBox="0 0 576 512"><!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.--><path d="M0 128C0 92.7 28.7 64 64 64l256 0c35.3 0 64 28.7 64 64l0 256c0 35.3-28.7 64-64 64L64 448c-35.3 0-64-28.7-64-64L0 128zM559.1 99.8c10.4 5.6 16.9 16.4 16.9 28.2l0 256c0 11.8-6.5 22.6-16.9 28.2s-23 5-32.9-1.6l-96-64L416 337.1l0-17.1 0-128 0-17.1 14.2-9.5 96-64c9.8-6.5 22.4-7.2 32.9-1.6z"/></svg>
        Upload Video
    `;
})

documentCourseType.addEventListener('change', function () {
    formCourseFile.previousElementSibling.innerHTML = 
    `
        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 fill-gray-800" viewBox="0 0 384 512"><!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.--><path d="M0 64C0 28.7 28.7 0 64 0L224 0l0 128c0 17.7 14.3 32 32 32l128 0 0 288c0 35.3-28.7 64-64 64L64 512c-35.3 0-64-28.7-64-64L0 64zm384 64l-128 0L256 0 384 128z"/></svg>
        Upload Document
    `;
});
