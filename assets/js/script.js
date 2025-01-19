let userMenu = document.querySelector('.user-menu');

if (userMenu) {
    userMenu.addEventListener('click', function () {
        userMenu.nextElementSibling.classList.toggle('hidden');
    });
}

function createAlert(type, message) {
    let alert = document.createElement('div');
    alert.className = "px-6 rounded border bg-gray-100 border-gray-400 fixed bottom-5 left-5 z-20 max-w-xl min-w-96 text-center shadow-lg py-4";

    alert.innerHTML = 
    `<h3 class="mb-2 font-semibold">${type}</h3>
    <p class="text-gray-600">${message}</p>`;

    document.body.append(alert);

    setTimeout(() => {
        alert.remove();
    }, 4000);
}
