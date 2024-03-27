@extends('layouts.app')
<link rel="stylesheet" href="{{ asset('../resources/css/productos.css') }}">

@push('head')
    <script src="{{asset('../resources/js/crud_productos.js')}}" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10" defer></script>
    <link rel="stylesheet" href="{{ asset('../resources/css/product.css') }}">
    <link rel="stylesheet" href="{{ asset('../resources/css/crud.css') }}">
@endpush

@section('content')
    {{-- If a product is passed, show the edit form, else, show the create form --}}
    @if (isset($product))
        <form action="{{ route('product.update') }}" method="post" id="product-form" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <input type="hidden" name="id" id="id" value="{{ $product->id }}">
            <div id="product-main">
                <div id="product-column">
                    <div id="product-wrapper">
                        {{-- IMG input --}}
                        <label for="img" id="product-image-label" style="background-image: url({{ asset('storage/images/products/prod_'.$product->id.'.png') }});" data-default="{{ asset('storage/images/products/default_faded.png') }}"></label>
                        <input type="file" name="img" id="img" style="display: none">

                        <div id="product-info-wrapper">
                            <div id="product-info">
                                <div>
                                    <p id="product-name"><input type="text" name="name" id="name-input" placeholder="Name" value="{{ $product->name }}"></p>
                                </div>
                                <p id="product-price"><input type="text" id="price-input" name="price" placeholder="Price" value="{{ $product->price }}">€</p>
                            </div>
                            <div id="product-buttons">
                                <button type="submit" id="submit-form-button" class="standard-button">Save</button>
                                <button type="reset" id="reset-form-button" class="standard-button-dark">Clear</button>
                                <button class="standard-button"><a href="{{ route('product.find', $product->id) }}">Product page</a></button>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="details-column">
                    {{-- Product description --}}
                    <div id="product-description-wrapper">
                        <p id="product-description"><textarea type="text" id="description-input" name="description">{{ $product->description }}</textarea></p>
                    </div>
                </div>
            </div>
        </form>
        </form>
        </div>
    @else
    <div class="cajaproductos">

        <form action="{{ route('product.store') }}" method="post" id="product-form" enctype="multipart/form-data" class="formularioproductos">
            @csrf

            {{-- Copy the style of the product page --}}
            <div id="product-main">
                <div id="product-column">
                    <div id="product-wrapper">
                        {{-- IMG input --}}
                        <label for="img" id="product-image-label" style="background-image: url({{ asset('storage/images/products/default_faded.png') }});" data-default="{{ asset('storage/images/products/default_faded.png') }}"></label>
                        <input type="file" name="img" id="img" style="display: none">

                        <div id="product-info-wrapper">
                            <div id="product-info">
                                <div>
                                    <p id="product-name"><input type="text" name="name" id="name-input" placeholder="Name"></p>
                                </div>
                                <p id="product-price"><input type="text" id="price-input" name="price" placeholder="Price">€</p>
                            </div>
                            <div id="product-buttons">
                                <button type="submit" id="submit-form-button" class="standard-button">Create</button>
                                <button type="reset" id="reset-form-button" class="standard-button-dark">Reset</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="details-column">
                    {{-- Product description --}}
                    <div id="product-description-wrapper">
                        <p id="product-description"><textarea type="text" id="description-input" name="description"></textarea></p>
                    </div>
                </div>
            </div>
        </form>
    

        <div class="caja">
            <form action="{{ route('product.table') }}" method="post" id="table-filters-form"></form>
            <form action="{{ route('product.destroy') }}" method="post" id="table-destroy-form"></form>
            <form action="{{ route('product.edit') }}" method="post" id="edit-redirect-form">@csrf</form>
            <form action="{{ route('product.find', '') }}" method="get" id="product-redirect-form"></form>

            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Descripcion</th>
                        <th>Precio</th>
                        <th>Imagen</th>
                        <th>Editar</th>
                        <th>Eliminar</th>
                    </tr>
                </thead>
                <tbody id="resultado" class="animate__animated animate__fadeIn">

                </tbody>
            </table>
        </div>
    </div>

    @endif

@endsection