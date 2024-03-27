@extends('layouts.app')

@push('head')
    <link rel="stylesheet" href="{{ asset('../resources/css/cart.css') }}">
@endpush

@section('content')
    <div id="cart-main">
        <div id="cart-items" class="cart-wrapper-column">
            @foreach ($items as $item)
                <div class="cart-item">
                    <div class="cart-image-wrapper">
                        <a href="{{ route('product.find', $item->product->id) }}">
                            <img src="{{ asset('storage/images/products/prod_'.$item->product->id.'.png') }}" class="cart-product-image">
                        </a>
                    </div>
                    <div class="cart-info-wrapper">
                        <div class="cart-header-wrapper">
                            <div class="cart-item-title-section">
                                <p class="cart-item-title">{{ $item->product->name }}</p>
                                <p class="cart-item-price">{{ $item->product->price }}€</p>
                            </div>
                            <div class="cart-item-button-section">
                                <form action="{{ route('product.pay') }}" method="post">
                                    @csrf
                                    <input type="hidden" name="items[]" value="{{ $item->product->id }}">
                                    <button class="standard-button">Purchase</button>
                                </form>
                                <form action="{{ route('cart.destroy', $item->product) }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="standard-button-dark">Remove</button>
                                </form>
                            </div>
                        </div>
                        <div class="cart-description-wrapper">
                            <p class="cart-item-description">{{ $item->product->description }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        @if ($items->count() > 0)
            <div id="cart-menu">
                <div>
                    <p id="total-price-title">Total: </p>
                    <p id="total-price">{{ number_format($items->sum('product.price'),2) }}€</p>
                </div>
                <div>
                    <form action="{{ route('product.pay') }}" method="post">
                        @csrf
                        @foreach ($items as $item)
                            <input type="hidden" name="items[]" value="{{ $item->product->id }}">
                        @endforeach
                        <button class="standard-button">Purchase</button>
                    </form>
                </div>
            </div>
        @else
            <div id="empty-message">
                <p>Nothing in shopping cart</p>
                <button class="standard-button-dark"><a href="{{ route('home') }}">Shop</a></button>
            </div>
        @endif
    </div>
@endsection