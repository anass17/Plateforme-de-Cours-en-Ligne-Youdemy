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

if (actionsBtn) {
    actionsBtn.addEventListener('click', function () {
        this.nextElementSibling.classList.toggle('hidden');
        this.nextElementSibling.classList.toggle('flex');
    });
}

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

//////////////////////////////
/// Subscribe
//////////////////////////////

let subscribeLoginModal = document.querySelector('.subscribe-login-modal');
let subscribeLoginModalCloseBtn = subscribeLoginModal.querySelector('.close-btn');
let subscribeLogin = document.querySelector('.subscribe-login');

if (subscribeLogin) {
    subscribeLoginModalCloseBtn.addEventListener('click', function () {
        subscribeLoginModal.classList.add('hidden');
        subscribeLoginModal.classList.remove('flex');
    });

    subscribeLogin.addEventListener('click', function () {
        subscribeLoginModal.classList.remove('hidden');
        subscribeLoginModal.classList.add('flex');
    });
}

//////////////////////////////////
/// Review
//////////////////////////////////

let reviewModal = document.querySelector('.review-modal');
let reviewModalCloseBtn = reviewModal.querySelector('.close-btn');
let addReviewBtn = document.querySelector('.add-review-btn');

if (addReviewBtn) {
    reviewModalCloseBtn.addEventListener('click', function () {
        reviewModal.classList.add('hidden');
        reviewModal.classList.remove('flex');
    });

    addReviewBtn.addEventListener('click', function () {
        reviewModal.classList.remove('hidden');
        reviewModal.classList.add('flex');
    });
}

let stars = document.querySelectorAll('.stars svg');
let ratingInput = document.querySelector('#rating-input');

stars.forEach((star, index) => {
    star.addEventListener('click', function () {
        stars.forEach(star => {star.style.fill = "#d1d5db"});
        let el = this;
        while(el != null) {
            el.style.fill = "#fde047";
            el = el.previousElementSibling;
        }
        ratingInput.value = index + 1;
    });
})