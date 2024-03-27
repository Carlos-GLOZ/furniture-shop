// Retuns an HTML element of a card of the given product
function buildProductCard(product) {
    // Create product card
    let card = document.createElement('div');
    card.classList.add('product-card');

    // Redirect to product page when clicked
    card.addEventListener('click', (e) => {
        productLink = productRoute + '/' + product.id;
        window.location.href = productLink;
    })

    // Create image
    let image = document.createElement('img');
    image.classList.add('product-image');
    image.src = product.image;

    // Create name
    let name = document.createElement('p');
    name.classList.add('product-name');
    name.innerText = product.name;

    // Create price
    let price = document.createElement('p');
    price.classList.add('product-price');
    price.innerText = product.price + "€";

    // Add elements to card
    card.appendChild(image);
    card.appendChild(name);
    card.appendChild(price);

    return card;
}