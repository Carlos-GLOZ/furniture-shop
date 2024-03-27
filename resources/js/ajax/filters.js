// Import getProducts if not already imported

const toggle_order = document.getElementById('main-search-filters').getElementsByClassName('filter-order-direction')[0];
const column_order = document.getElementById('main-search-filters').getElementsByClassName('filter-order-column')[0];
const name_input = document.getElementById('main-search-filters').getElementsByClassName('filter-name')[0];

// Order toggle appearence
toggle_order.addEventListener('click', (e) => {
    if (toggle_order.value == 'ASC') {
        toggle_order.getElementsByTagName('i')[0].classList.add('fa-chevron-down');
        toggle_order.getElementsByTagName('i')[0].classList.remove('fa-chevron-up');
        toggle_order.value = "DESC";
    } else {
        toggle_order.getElementsByTagName('i')[0].classList.add('fa-chevron-up');
        toggle_order.getElementsByTagName('i')[0].classList.remove('fa-chevron-down');
        toggle_order.value = "ASC";
    }

    // List out products
    filterProducts();
});

column_order.addEventListener('change', (e) => {
    filterProducts();
});

name_input.addEventListener('input', (e) => {
    filterProducts();
});

// Click effect on button
toggle_order.addEventListener('mousedown', () => {
    toggle_order.style.transform = "scale(.9)";
});
toggle_order.addEventListener('mouseup', () => {
    toggle_order.style.transform = "scale(1)";
});