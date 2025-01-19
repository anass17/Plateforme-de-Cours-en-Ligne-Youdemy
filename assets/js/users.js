let actionsBtn = document.querySelectorAll('.actions-btn');
let filterTabs = document.querySelectorAll('.filter-tabs button');

actionsBtn.forEach(btn => {
    btn.addEventListener('click', function () {
        this.nextElementSibling.classList.toggle('hidden');
        this.nextElementSibling.classList.toggle('flex');
    });
});

filterTabs.forEach(tab => {
    tab.addEventListener('click', function () {
        filterTabs.forEach(item => item.classList.remove('active-tab'));

        this.classList.add('active-tab');
    })
});