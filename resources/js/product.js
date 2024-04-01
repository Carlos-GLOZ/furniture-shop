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

    // check if image exists
    const ajax = new XMLHttpRequest();

    ajax.open('GET', product.image);

    ajax.onload = (e) => {
        if (ajax.status === 200) {
            image.src = product.image;
        } else {
            image.src = defaultProductImage;
        }
    };

    ajax.send();


    // Create name
    let name = document.createElement('p');
    name.classList.add('product-name');
    name.innerText = product.name;

    // Create price
    let price = document.createElement('p');
    price.classList.add('product-price');
    price.innerText = product.price + "€";

    // Create image container
    let imageContainer = document.createElement('div');
    imageContainer.classList.add('product-image-container');

    // Create text container
    let textContainer = document.createElement('div');

    // Add elements to card
    imageContainer.appendChild(image);
    textContainer.appendChild(name);
    textContainer.appendChild(price);
    card.appendChild(imageContainer);
    card.appendChild(textContainer);

    return card;
}