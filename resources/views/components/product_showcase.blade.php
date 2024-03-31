{{-- @props(['products' => $products]) --}}

@push('head')
    <link rel="stylesheet" href="{{ asset('../resources/css/products.css') }}">
    <script src="{{ asset('../resources/js/product.js') }}" defer></script>
    <script src="{{ asset('../resources/js/ajax/getProducts.js') }}" defer></script>

    <script>const productRoute = "{{ route('product.find', '') }}";</script>
@endpush

<div id="tag-list"></div> <!-- ANCHOR TAG: LISTADO -->

<div class="showcase-message">
    <p class="message">Mostrando 0 resultados</p>
</div>

{{-- 1519.2px W --}}
<div class="product-showcase-wrapper">
    <div class="product-showcase">
        
    </div>
</div>