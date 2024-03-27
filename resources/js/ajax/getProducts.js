function getProducts(name = '', order_column = 'name', order_direction = 'ASC') {

    // Append filters to the end of path 
    let formData = new FormData();
    formData.append('_token', token.content);
    formData.append('name_filter', name);
    formData.append('order_column_filter', order_column);
    formData.append('order_direction_filter', order_direction);

    const ajax = new XMLHttpRequest();

    // define path in component to be able to use route()
    ajax.open('POST', filtersPath);

    ajax.onload = (e) => {
        if (ajax.status === 200) {
            let products = JSON.parse(ajax.response).data;

            // Show products
            const showcase = document.getElementsByClassName('product-showcase')[0];
            showcase.innerHTML = '';

            for (let i = 0; i < products.length; i++) {
                // Append built card to product section
                showcase.appendChild(buildProductCard(products[i]));
            }

            // Update counter
            const counter = document.getElementsByClassName('showcase-message')[0].getElementsByClassName('message')[0];

            let counter_text = "Showing " + products.length + " result"
            if (products.length == 0) {
                counter_text = 'No results found';
            } else if (products.length !== 1) {
                counter_text += 's';
            }
            counter.innerText = counter_text;
        }
    };

    ajax.send(formData);
}

function filterProducts() {
    let name = document.getElementById('main-search-filters').getElementsByClassName('filter-name')[0];
    let order_column = document.getElementById('main-search-filters').getElementsByClassName('filter-order-column')[0];
    let order_direction = document.getElementById('main-search-filters').getElementsByClassName('filter-order-direction')[0];

    getProducts(name.value, order_column.value, order_direction.value);
}

window.onload = (e) => {
    filterProducts();
};