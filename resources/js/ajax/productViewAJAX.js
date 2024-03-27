const productDestroyForm = document.getElementById('product-destroy-form');

productDestroyForm.addEventListener('submit', (e) => {
    e.preventDefault();

    let formData = new FormData(productDestroyForm);

    const ajax = new XMLHttpRequest();

    ajax.open('POST', productDestroyForm.action);

    ajax.onload = (e) => {
        if (ajax.status === 200) {
            let AJAXResponse = JSON.parse(ajax.response);

            if (AJAXResponse == 'OK') {
                window.location.href = productDestroyForm.dataset.redirect;
            } else {
                console.log(ajax.response);
            }
        }
    }

    ajax.send(formData)
})