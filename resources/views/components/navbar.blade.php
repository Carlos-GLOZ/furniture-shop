@props([])

<div id="overlay-body"></div>
{{-- SIDE - NAVBAR --}}
<div id="side-navbar" class="sidenav">
    <a href="javascript:void(0)" id="closebtn" class="closebtn">&times;</a>
    <div id="sidenav-contents">
        @guest
            <a class="sidenav-icon-link" href="{{ route('auth.signin') }}"><i id="nav-icon-user" class="fa-solid fa-right-to-bracket"></i><p>Sign In</p></a>
            <a class="sidenav-icon-link" href="{{ route('auth.signup') }}"><i id="nav-icon-user" class="fa-solid fa-user-plus"></i><p>Sign Up</p></a>
        @endguest
        @auth
            <a href="{{ route('cart.show') }}" class="sidenav-icon-link"><i class="fa-regular fa-user nav-icon" id="nav-icon-user"></i><p>{{ auth()->user()->name }}</p></a>
            <a href="{{ route('cart.show') }}" class="sidenav-icon-link"><i id="nav-icon-user" class="fa-solid fa-cart-shopping nav-icon"></i><p>Shopping cart</p></a>
            <a href="{{ route('auth.signout') }}" class="sidenav-icon-link"><i id="nav-icon-user" class="fa-solid fa-right-from-bracket"></i><p>Sign Out</p></a>
            
            @if (auth()->user()->admin==1)
                <a href="{{ route('enviarEmail') }}" class="sidenav-icon-link"><i class="fa-solid fa-envelope"></i><p>Write email</p></a>
    
                <a href="{{ route('product.create') }}" class="sidenav-icon-link"><i class="fa-solid fa-folder-plus"></i><p>New Product</p></a>
            @endif
        @endauth
    </div>
</div>
{{-- ///////////// --}}

<div id="navbar">
    <div id="navbar-left">
        <div class="nav-container">
            <a href="{{ route('home') }}" class="logo-text"><img src="{{ asset('../resources/images/logos/logo-1.png') }}" alt=""></a>
        </div>
    </div>
    <div id="navbar-right">
        @guest
            <button class="standard-button" id="nav-sign-in-button"><a href="{{ route('auth.signin') }}">Sign In</a></button>
            <button class="standard-button-dark" id="nav-sign-up-button"><a href="{{ route('auth.signup') }}">Sign Up</a></button>
        @endguest
        @auth
            <a href="{{ route('cart.show') }}" class="nav-icon-link" id="nav-icon-user-link"><i class="fa-regular fa-user nav-icon" id="nav-icon-user"></i><p id="nav-icon-user-text">{{ auth()->user()->name }}</p></a>
            <a href="{{ route('cart.show') }}" class="nav-icon-link"><i class="fa-solid fa-cart-shopping nav-icon"></i></a>

            @if (auth()->user()->admin==1)
                <a href="{{ route('enviarEmail') }}" class="nav-icon-link nav-icon-removable"><i class="fa-solid fa-envelope"></i></a>

                <a href="{{ route('product.create') }}" class="nav-icon-link nav-icon-removable"-ico><i class="fa-solid fa-folder-plus"></i></a>
            @endif
            <button class="standard-button-dark" id="nav-sign-out-button"><a href="{{ route('auth.signout') }}">Sign Out</a></button>
        @endauth
    </div>
    <div id="navbar-side">
        <button class="standard-button-dark" style="width: fit-content">
            <i id="openbtn" class="fa-solid fa-bars"></i>   
        </button>
    </div>
</div>  

<script src="{{ asset('../resources/js/navbar.js') }}"></script>
