let actionsBtn = document.querySelectorAll('.actions-btn');
let filterTabs = document.querySelectorAll('.filter-tabs button');
let actionBtns = document.querySelectorAll('.action-btn');
let users = document.querySelectorAll('.user');

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

        users.forEach(user => {
            if (this.dataset.filter == "All" || user.querySelector('.user-role').textContent == this.dataset.filter) {
                user.style.display = "flex";
            } else if (user.querySelector('.status-info').lastElementChild.textContent == this.dataset.filter) {
                user.style.display = "flex";
            } else {
                user.style.display = "none";
            }
        })
    })
});

actionBtns.forEach(btn => {
    
    btn.addEventListener('click', function () {

        this.parentElement.classList.toggle('hidden');
        this.parentElement.classList.toggle('flex');

        fetch('/api/UserApi.php', {
            method: 'PUT',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                userId: this.parentElement.dataset.id,
                newStatus: this.dataset.status
            })
        })
        .then(response => response.json())
        .then(data => {
    
            console.log(data);

            if (data.status == false) {
                createAlert('Error', data.message);
            } else {
                let statusInfo = this.closest('.info').querySelector('.status-info').lastElementChild;

                statusInfo.textContent = data.result;
                statusInfo.className = data.class;

                createAlert('Success', data.message);
            }
    
        });
    });
});
