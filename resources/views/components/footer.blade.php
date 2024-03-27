@props([])

@push('head')
    <link rel="stylesheet" href="{{ asset('../resources/css/footer.css') }}">
    <script src="https://kit.fontawesome.com/2b5286e1aa.js" crossorigin="anonymous"></script>
@endpush

<div class="footer">
    <div class="f_footer">
        <div class="img-footer">
            <img src="{{ asset('../resources/images/logos/logo-2.png') }}" alt="">
        </div>
        <div class="rs-footer">
            <i class="fa-brands fa-facebook"></i>
            <i class="fa-brands fa-instagram"></i>
            <i class="fa-brands fa-twitter"></i>
            <i class="fa-brands fa-linkedin"></i>
        </div>
    </div>
    <hr>
    <div class="s_footer">
        <p>Obtener ayuda</p>
        <p>Añadir tu producto</p>
        <p>Registrate para hacer entregas</p>
        <p>Crear una cuenta de empresa</p>
        <p>Promociones</p>
    </div>
    <hr>
    <div class="t_footer">
        <p>Tiendas cercanas</p>
        <p>Para recoger cerca de mí</p>
        <p>Acerca de CAHM</p>
        <p>Españoles</p>
    </div>
</div>