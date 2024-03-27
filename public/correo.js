var csrf_token = document.getElementById('token').content;


destinatario.addEventListener("keyup", () => {

    var buscar = destinatario.value;

    var listarbuscador = document.getElementById("listarbuscador");
    var formdata = new FormData();
    formdata.append('_token', csrf_token);

    if (buscar.includes(",")) {
        let arrayValores = buscar.split(",");
        let ultimoValor = arrayValores[arrayValores.length - 1];
        formdata.append('buscar', ultimoValor);
    } else {
        formdata.append('buscar', buscar);
    }


    const ajax = new XMLHttpRequest();
    ajax.open('POST', 'listarCorreos');


    ajax.onload = function() {
        if (ajax.status == 200) {
            /* alert(ajax.responseText); */
            // console.log(ajax.responseText);
            let productos = JSON.parse(ajax.responseText);
            // console.log(productos.length);
            let box = '';




            if (productos.length == 0) {
                box += `
                <div class="element-busc">
                    <p>No match found...</p>
                </div>`;
            } else {

                productos.forEach(element => {
                    /* console.log(element.id) */

                    box += `
                        <div class="element-busc">
                            <p name='p-buscador' class='p-buscador'>${element.email},</p>
                        </div>`;
                });
            }
            if (buscar == '') {
                listarbuscador.style.display = 'none';
            } else {
                listarbuscador.style.display = 'flex';
            }

            listarbuscador.innerHTML = box;
            var arraybuscador = document.getElementsByName('p-buscador');

            for (let i = 0; i < arraybuscador.length; i++) {
                arraybuscador[i].addEventListener('click', ponerValueEnBuscador);

            }

        } else {
            /* listarbuscador.innerText = 'Error'; */
        }
    }
    ajax.send(formdata);


})




function ponerValueEnBuscador(evt) {
    const correoDiv = document.createElement("div");
    correoDiv.classList.add("correo");
    var correoSeleccionado = evt.target.textContent.trim();
    var ultimoIndiceComa = destinatario.value.lastIndexOf(',');
    var prefijo = '';
    if (ultimoIndiceComa !== -1) {
        prefijo = destinatario.value.substring(0, ultimoIndiceComa + 1);
        correoDiv.textContent = prefijo
    }
    destinatario.value = prefijo + correoSeleccionado;
    listarbuscador.style.display = 'none';


}



todos.addEventListener("click", () => {

    destinatario.value = "All the users";
    destinatario.disabled = true;
    listarbuscador.style.display = 'none';

})

escoger.addEventListener("click", () => {

    destinatario.value = "";
    destinatario.disabled = false;
    listarbuscador.style.display = 'none';

})

reiniciar.addEventListener("click", () => {
    
    destinatario.disabled = false;
    listarbuscador.style.display = 'none';
})