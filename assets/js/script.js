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


/////////////////////////////////////
/// Search
/////////////////////////////////////

let resultsScreen = document.querySelector('.results-screen');
let searchInput = document.querySelector('.search-input');
let searchOption = document.querySelector('.search-option');
let searchBtn = document.querySelector('.search-btn');
let searchWindow = document.querySelector('.search-window');


if (searchInput != null) {

    searchBtn.addEventListener('click', function () {
        searchWindow.classList.toggle('hidden');
    })

    searchInput.addEventListener('keyup', function () {

        if (searchOption.value == "teachers") {

            fetch('/api/UserApi.php?search=' + this.value, {
                method: 'GET',
                headers: {
                    'Content-Type': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => {

                if (data.status == true) {

                    // Display courses

                    resultsScreen.innerHTML = "";
                    
                    data.result.forEach(item => {
                        let el = document.createElement('div');

                        el.innerHTML = `
                            <a href="#" class="gap-5 flex justify-start items-center">
                                <div class="rounded-full w-14 h-14 border-2 border-[#00A5CF] overflow-hidden">
                                    <img src="${item.image}" alt="">
                                </div>
                                <div class="text-left flex-1">
                                    <h3 class="font-semibold">${item.name}</h3>
                                    <div class="flex items-center justify-between">
                                        <p class="text-gray-600 text-sm text-left">${item.title}</p>
                                        <div class="flex gap-3 items-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 fill-gray-700" viewBox="0 0 448 512"><!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.--><path d="M96 0C43 0 0 43 0 96L0 416c0 53 43 96 96 96l288 0 32 0c17.7 0 32-14.3 32-32s-14.3-32-32-32l0-64c17.7 0 32-14.3 32-32l0-320c0-17.7-14.3-32-32-32L384 0 96 0zm0 384l256 0 0 64L96 448c-17.7 0-32-14.3-32-32s14.3-32 32-32zm32-240c0-8.8 7.2-16 16-16l192 0c8.8 0 16 7.2 16 16s-7.2 16-16 16l-192 0c-8.8 0-16-7.2-16-16zm16 48l192 0c8.8 0 16 7.2 16 16s-7.2 16-16 16l-192 0c-8.8 0-16-7.2-16-16s7.2-16 16-16z"/></svg>
                                            <span class="text-gray-600 text-sm text-left font-semibold">${item.courses}</span>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        `;

                        resultsScreen.append(el);

                    });

                } else {
                    resultsScreen.innerHTML = `<p class="text-center text-gray-600">We could not find any result that match this keyword</p>`
                }

            });

        } else {

            fetch('/api/CourseApi.php?search=' + this.value, {
                method: 'GET',
                headers: {
                    'Content-Type': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => {

                if (data.status == true) {

                    // Display courses

                    resultsScreen.innerHTML = "";
                    
                    data.result.forEach(item => {
                        let el = document.createElement('div');

                        el.innerHTML = `
                            <a href="/pages/view.php?id=${item.id}" class="">
                                <h3 class="font-semibold text-[#00A5CF] text-md">${item.title}</h3>
                                <div class="flex justify-between items-center gap-4">
                                    <h4 class="font-medium text-[#6F6F6F] flex items-center gap-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 fill-gray-600" viewBox="0 0 640 512"><!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.--><path d="M224 256A128 128 0 1 0 224 0a128 128 0 1 0 0 256zm-45.7 48C79.8 304 0 383.8 0 482.3C0 498.7 13.3 512 29.7 512l293.1 0c-3.1-8.8-3.7-18.4-1.4-27.8l15-60.1c2.8-11.3 8.6-21.5 16.8-29.7l40.3-40.3c-32.1-31-75.7-50.1-123.9-50.1l-91.4 0zm435.5-68.3c-15.6-15.6-40.9-15.6-56.6 0l-29.4 29.4 71 71 29.4-29.4c15.6-15.6 15.6-40.9 0-56.6l-14.4-14.4zM375.9 417c-4.1 4.1-7 9.2-8.4 14.9l-15 60.1c-1.4 5.5 .2 11.2 4.2 15.2s9.7 5.6 15.2 4.2l60.1-15c5.6-1.4 10.8-4.3 14.9-8.4L576.1 358.7l-71-71L375.9 417z"/></svg>
                                        <span class="text-sm">${item.teacher}</span>
                                    </h4>
                                    <div class="flex gap-3">
                                        <h4 class="font-medium text-[#6F6F6F] flex items-center gap-2">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 fill-gray-600" viewBox="0 0 576 512"><!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.--><path d="M264.5 5.2c14.9-6.9 32.1-6.9 47 0l218.6 101c8.5 3.9 13.9 12.4 13.9 21.8s-5.4 17.9-13.9 21.8l-218.6 101c-14.9 6.9-32.1 6.9-47 0L45.9 149.8C37.4 145.8 32 137.3 32 128s5.4-17.9 13.9-21.8L264.5 5.2zM476.9 209.6l53.2 24.6c8.5 3.9 13.9 12.4 13.9 21.8s-5.4 17.9-13.9 21.8l-218.6 101c-14.9 6.9-32.1 6.9-47 0L45.9 277.8C37.4 273.8 32 265.3 32 256s5.4-17.9 13.9-21.8l53.2-24.6 152 70.2c23.4 10.8 50.4 10.8 73.8 0l152-70.2zm-152 198.2l152-70.2 53.2 24.6c8.5 3.9 13.9 12.4 13.9 21.8s-5.4 17.9-13.9 21.8l-218.6 101c-14.9 6.9-32.1 6.9-47 0L45.9 405.8C37.4 401.8 32 393.3 32 384s5.4-17.9 13.9-21.8l53.2-24.6 152 70.2c23.4 10.8 50.4 10.8 73.8 0z"/></svg>
                                            <span class="text-sm">${item.category}</span>
                                        </h4>
                                        <span class="text-sm text-[#424242] flex items-center gap-2">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 fill-gray-600" viewBox="0 0 448 512"><!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.--><path d="M219.3 .5c3.1-.6 6.3-.6 9.4 0l200 40C439.9 42.7 448 52.6 448 64s-8.1 21.3-19.3 23.5L352 102.9l0 57.1c0 70.7-57.3 128-128 128s-128-57.3-128-128l0-57.1L48 93.3l0 65.1 15.7 78.4c.9 4.7-.3 9.6-3.3 13.3s-7.6 5.9-12.4 5.9l-32 0c-4.8 0-9.3-2.1-12.4-5.9s-4.3-8.6-3.3-13.3L16 158.4l0-71.8C6.5 83.3 0 74.3 0 64C0 52.6 8.1 42.7 19.3 40.5l200-40zM111.9 327.7c10.5-3.4 21.8 .4 29.4 8.5l71 75.5c6.3 6.7 17 6.7 23.3 0l71-75.5c7.6-8.1 18.9-11.9 29.4-8.5C401 348.6 448 409.4 448 481.3c0 17-13.8 30.7-30.7 30.7L30.7 512C13.8 512 0 498.2 0 481.3c0-71.9 47-132.7 111.9-153.6z"/></svg>
                                            <span>${item.subscriptions}</span>
                                        </span>
                                    </div>
                                </div>
                            </a>
                        `;

                        resultsScreen.append(el);

                    });

                } else {
                    resultsScreen.innerHTML = `<p class="text-center text-gray-600">We could not find any result that match this keyword</p>`
                }

            });
        }
    });
}