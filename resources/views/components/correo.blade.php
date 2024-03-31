@push('head')
    <link rel="stylesheet" href="{{ asset('../resources/css/correo.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
@endpush

<div class="caja">
    <form action="{{ url('/FuncionMail') }}" method="post">
        <h1>FORMULÁRIO DE CORREO</h1>
        <div class="divs">
            <input type="button" class="standard-button" id="todos" value="Todos">
            <input type="button" class="standard-button" id="escoger" value="Escoger">
        </div>
    
        @csrf
        {{-- <input type="text" id="destinatario" name="Destinatario" placeholder="Destinatario"> --}}

        <input class="correos" id="destinatario" name="Destinatario" placeholder="Recipiente(s)">
        <div style="display: none;" id="listarbuscador" name="listarbuscador" ></div> {{-- BUSCADOR USUARIOS --}}

        <input type="text" id="asunto" name="Asunto" placeholder="Asunto" >

        <textarea name="" id="mensaje" name="Mensaje" placeholder="Mensaje"></textarea>

        <input style="width: 207px;" type="submit" value="Enviar correo" id="enviar" class="enviar standard-button-dark">
        <input type="reset" id="reiniciar" value="Reestablecer" class="standard-button">
    </form>
</div>
<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>



{{-- SWETALERTS --}}



{{-- TODO CORRECTO --}}
<?php
if (isset($_GET['email'])) {
if ($_GET['email']=='si') {
    ?>
    <script>
 Swal.fire({
                            icon: 'success',
                            title: 'EMAIL SENT SUCCESSFULLY',
                            showConfirmButton: false,
                            color: 'white',
                            timerProgressBar: true,

                            timer: 2000
                        })

    </script>
    <?php
}
}

?>



{{-- CAMPOS VACIOS --}}


<?php
if (isset($_GET['mal'])) {
if ($_GET['mal']=='va') {
    ?>
    <script>
 Swal.fire({
                            icon: 'error',
                            title: 'Something is empty',
                            showConfirmButton: false,
                            color: 'white',
                            timerProgressBar: true,

                            timer: 2000
                        })

    </script>
    <?php
}
}

?>


{{-- ALGÚN MAIL INCORRECTO --}}


<?php
if (isset($_GET['email'])) {
if ($_GET['email']=='no') {
    ?>
    <script>
 Swal.fire({
                            icon: 'error',
                            title: 'UPS',
                            text:'Something is wrong',
                            showConfirmButton: false,
                            color: 'white',
                            timerProgressBar: true,

                            timer: 2000
                        })

    </script>
    <?php
}
}

?>


<script src="{{asset('correo.js')}}"></script>