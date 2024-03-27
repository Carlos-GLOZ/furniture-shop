@extends('layouts.app')

@push('head')
    <link rel="stylesheet" href="{{ asset('../resources/css/product.css') }}">
    <script src="{{ asset('../resources/js/review.js') }}" defer></script>
    <script src="{{ asset('../resources/js/ajax/productViewAJAX.js') }}" defer></script>
@endpush

@section('content')
    <div id="product-main">
        <div id="product-column">
            <div id="product-wrapper">
                <img id="product-image" src="{{ asset('storage/images/products/prod_'.$product->id.'.png') }}" alt="product">
                <div id="product-info-wrapper">
                    <div id="product-info">
                        <div>
                            <p id="product-name">{{ $product->name }}</p>
                            <p id="product-rating">{{ number_format($product->reviews->avg('rating'),1) }}/5</p>
                        </div>
                        <p id="product-price">{{ $product->price }}€</p>
                    </div>
                    <div id="product-buttons">
                        @auth
                            @can('cart', $product)
                            <form action="{{ route('cart.store', $product) }}" method="post">
                                @csrf
                                <button type="submit" class="standard-button add-to-cart-button">Add to cart</button>
                            </form>
                            @else
                                <form action="{{ route('cart.destroy', $product) }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="standard-button-dark add-to-cart-button">Uncart</button>
                                </form>
                            @endcan

                            {{-- Edit & delete for admins --}}
                            @can('change', $product)
                                <form action="{{ route('product.edit') }}" method="post">
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $product->id }}">
                                    <button type="submit" class="standard-button add-to-cart-button">Edit</button>
                                </form>
                                <form action="{{ route('product.destroy') }}" method="post" id="product-destroy-form" data-redirect="{{ route('home') }}">
                                    @csrf
                                    @method('DELETE')
                                    <input type="hidden" name="id", value="{{ $product->id }}">
                                    <button type="submit" class="standard-button-dark add-to-cart-button">Delete</button>
                                </form>
                            @endcan
                        @endauth
                        @guest
                            <button class="standard-button add-to-cart-button"><a href="{{ route('auth.signin') }}">Add to cart</a></button>
                        @endguest
                    </div>
                </div>
            </div>
        </div>
        <div id="details-column">
            {{-- Product description --}}
            <div id="product-description-wrapper">
                <p id="product-description">{{ $product->description }}</p>
            </div>

            {{-- New Review form --}}
            @can('review', $product)
                <div id="product-reviews">
                    <form method="POST" action="{{ route('review.store', $product) }}" class="review" id="review-form">
                        @csrf
                        <div class="review-info">
                            <i class="fa-regular fa-user review-user-icon"></i>
                            <div class="review-rating-selector">
                                <i class="fa-solid fa-chevron-up review-rating-button" id="review-rating-up-button"></i>
                                <input type="hidden" name="rating" id="review-form-rating-input" value="0">
                                <p class="review-rating" id="review-form-rating-value" data-value="0">0/5</p> 
                                <i class="fa-solid fa-chevron-down review-rating-button" id="review-rating-down-button"></i>
                            </div>
                        </div>
                        <div class="review-contents">
                            <p class="review-username">{{ auth()->user()->name }}</p>
                            <input type="hidden" name="comment" id="review-form-comment-input">
                            <p class="review-comment"><div contenteditable="true" type="text" name="comment" id="review-form-comment" class="@error('comment')review-comment-invalid @enderror"></div></p>
                            <button type="submit" class="standard-button">Review</button>
                        </div>
                    </form>
                </div>
            @endcan

            {{-- All reviews --}}
            <div id="product-reviews">
                @foreach ($product->reviews as $review)
                    <div class="review">
                        <div class="review-info">
                            <i class="fa-regular fa-user review-user-icon"></i>
                            <p class="review-rating">{{ $review->rating }}/5</p>
                        </div>
                        <div class="review-contents">
                            <p class="review-username">{{ $review->author->name }}</p>
                            <p class="review-comment">{{ $review->comment }}</p>
                            @can('delete', $review)
                                <form action="{{ route('review.destroy', $review) }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="standard-button-dark">Delete</button>
                                </form>
                            @endcan
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection