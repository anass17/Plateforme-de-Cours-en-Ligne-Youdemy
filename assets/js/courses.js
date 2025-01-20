let nextBtns = document.querySelectorAll('.next-btn');
let previousBtns = document.querySelectorAll('.previous-btn');


// Next Page

nextBtns.forEach(btn => {
    btn.addEventListener('click', function () {

        let category = this.parentElement.dataset.category;
        let page = +this.previousElementSibling.firstElementChild.textContent + 1;
        
        changePage(this, category, page);

    });
});

// Previous Page

previousBtns.forEach(btn => {
    btn.addEventListener('click', function () {

        let category = this.parentElement.dataset.category;
        let page = +this.nextElementSibling.firstElementChild.textContent - 1;
        
        changePage(this, category, page);

    });
});

// Sent Request with fetch

function changePage(element, category, page) {

    fetch('/api/UserApi.php?keyword=' + category + '&page=' + page, {
        method: 'GET',
        headers: {
            'Content-Type': 'application/json'
        }
    })
    .then(response => response.json())
    .then(data => {

        if (data.status == true) {

            // Change Page number

            let pageIndexing = element.parentElement.children[1]
            let maxPage = pageIndexing.lastElementChild;
            
            pageIndexing.firstElementChild.textContent = page;

            // Change button colors

            pageIndexing.previousElementSibling.firstElementChild.style.fill = "#00A5CF";
            pageIndexing.nextElementSibling.firstElementChild.style.fill = "#00A5CF";

            if (page == maxPage.textContent) {
                pageIndexing.nextElementSibling.firstElementChild.style.fill = "#00A5CF50";
            } else if (page == 1) {
                pageIndexing.previousElementSibling.firstElementChild.style.fill = "#00A5CF50";
            }

            // Display courses
            
            let currentCategoryContainer = document.querySelector('#category-' + category).lastElementChild;

            currentCategoryContainer.innerHTML = "";
            
            data.result.forEach(item => {
                let el = document.createElement('a');

                el.className = "bg-[#F0F0F0] rounded-lg border group shadow-lg block";

                let badge;

                if (item.type == 'Video') {
                    badge = `<svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 fill-gray-800" viewBox="0 0 512 512"><!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.--><path d="M464 256A208 208 0 1 0 48 256a208 208 0 1 0 416 0zM0 256a256 256 0 1 1 512 0A256 256 0 1 1 0 256zM188.3 147.1c7.6-4.2 16.8-4.1 24.3 .5l144 88c7.1 4.4 11.5 12.1 11.5 20.5s-4.4 16.1-11.5 20.5l-144 88c-7.4 4.5-16.7 4.7-24.3 .5s-12.3-12.2-12.3-20.9l0-176c0-8.7 4.7-16.7 12.3-20.9z"/></svg>`;
                } else {
                    badge = `<svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 fill-gray-800" viewBox="0 0 512 512"><!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.--><path d="M64 464l48 0 0 48-48 0c-35.3 0-64-28.7-64-64L0 64C0 28.7 28.7 0 64 0L229.5 0c17 0 33.3 6.7 45.3 18.7l90.5 90.5c12 12 18.7 28.3 18.7 45.3L384 304l-48 0 0-144-80 0c-17.7 0-32-14.3-32-32l0-80L64 48c-8.8 0-16 7.2-16 16l0 384c0 8.8 7.2 16 16 16zM176 352l32 0c30.9 0 56 25.1 56 56s-25.1 56-56 56l-16 0 0 32c0 8.8-7.2 16-16 16s-16-7.2-16-16l0-48 0-80c0-8.8 7.2-16 16-16zm32 80c13.3 0 24-10.7 24-24s-10.7-24-24-24l-16 0 0 48 16 0zm96-80l32 0c26.5 0 48 21.5 48 48l0 64c0 26.5-21.5 48-48 48l-32 0c-8.8 0-16-7.2-16-16l0-128c0-8.8 7.2-16 16-16zm32 128c8.8 0 16-7.2 16-16l0-64c0-8.8-7.2-16-16-16l-16 0 0 96 16 0zm80-112c0-8.8 7.2-16 16-16l48 0c8.8 0 16 7.2 16 16s-7.2 16-16 16l-32 0 0 32 32 0c8.8 0 16 7.2 16 16s-7.2 16-16 16l-32 0 0 48c0 8.8-7.2 16-16 16s-16-7.2-16-16l0-64 0-64z"/></svg>`;
                }

                el.innerHTML = `
                    <div class="h-40 rounded-lg bg-cover bg-center relative" style="background-image: url('${item.image}')">
                        <div class="absolute top-3 left-3 bg-white group-hover:bg-opacity-100 transition-colors bg-opacity-65 w-6 h-6 rounded flex items-center justify-center">
                            ${badge}
                        </div>
                    </div>
                    <div class="px-5 py-5">
                        <div class="flex items-center gap-2 text-[#555555] text-[12px]">
                            <svg xmlns="http://www.w3.org/2000/svg" class="relative w-[14px]" viewBox="0 0 512 512"><!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.--><path d="M464 256A208 208 0 1 1 48 256a208 208 0 1 1 416 0zM0 256a256 256 0 1 0 512 0A256 256 0 1 0 0 256zM232 120l0 136c0 8 4 15.5 10.7 20l96 64c11 7.4 25.9 4.4 33.3-6.7s4.4-25.9-6.7-33.3L280 243.2 280 120c0-13.3-10.7-24-24-24s-24 10.7-24 24z"/></svg>
                            <span class="text-sm">${item.date}</span>
                        </div>
                        <h3 class="font-semibold text-[#00A5CF] text-lg">${item.title}</h3>
                        <div class="mt-5 flex justify-between items-center">
                            <h4 class="font-medium text-[#6F6F6F] flex items-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 fill-gray-600" viewBox="0 0 640 512"><!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.--><path d="M224 256A128 128 0 1 0 224 0a128 128 0 1 0 0 256zm-45.7 48C79.8 304 0 383.8 0 482.3C0 498.7 13.3 512 29.7 512l293.1 0c-3.1-8.8-3.7-18.4-1.4-27.8l15-60.1c2.8-11.3 8.6-21.5 16.8-29.7l40.3-40.3c-32.1-31-75.7-50.1-123.9-50.1l-91.4 0zm435.5-68.3c-15.6-15.6-40.9-15.6-56.6 0l-29.4 29.4 71 71 29.4-29.4c15.6-15.6 15.6-40.9 0-56.6l-14.4-14.4zM375.9 417c-4.1 4.1-7 9.2-8.4 14.9l-15 60.1c-1.4 5.5 .2 11.2 4.2 15.2s9.7 5.6 15.2 4.2l60.1-15c5.6-1.4 10.8-4.3 14.9-8.4L576.1 358.7l-71-71L375.9 417z"/></svg>
                                <span class="text-sm">${item.teacher}</span>
                            </h4>
                            <span class="text-sm text-[#424242] flex items-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 fill-gray-600" viewBox="0 0 448 512"><!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.--><path d="M219.3 .5c3.1-.6 6.3-.6 9.4 0l200 40C439.9 42.7 448 52.6 448 64s-8.1 21.3-19.3 23.5L352 102.9l0 57.1c0 70.7-57.3 128-128 128s-128-57.3-128-128l0-57.1L48 93.3l0 65.1 15.7 78.4c.9 4.7-.3 9.6-3.3 13.3s-7.6 5.9-12.4 5.9l-32 0c-4.8 0-9.3-2.1-12.4-5.9s-4.3-8.6-3.3-13.3L16 158.4l0-71.8C6.5 83.3 0 74.3 0 64C0 52.6 8.1 42.7 19.3 40.5l200-40zM111.9 327.7c10.5-3.4 21.8 .4 29.4 8.5l71 75.5c6.3 6.7 17 6.7 23.3 0l71-75.5c7.6-8.1 18.9-11.9 29.4-8.5C401 348.6 448 409.4 448 481.3c0 17-13.8 30.7-30.7 30.7L30.7 512C13.8 512 0 498.2 0 481.3c0-71.9 47-132.7 111.9-153.6z"/></svg>
                                <span>${item.subscriptions}</span>
                            </span>
                        </div>
                    </div>
                `;

                currentCategoryContainer.append(el);

            });

        }

    });
}