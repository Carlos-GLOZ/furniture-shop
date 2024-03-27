@props([])

<div id="navbar">
    <div id="navbar-left">
        <div class="nav-container">
            <a href="{{ route('home') }}" class="logo-text">Loogo</a>
        </div>
    </div>
    <div id="navbar-middle"></div>
    <div id="navbar-right" class="navbar-button-container">
        @guest
            <div class="nav-container">
                <button class="nav-button" id="nav-sign-in-button"><a href="{{ route('auth.signin') }}">Sign In</a></button>
            </div>
            <div class="nav-container">
                <button class="nav-button" id="nav-sign-up-button"><a href="{{ route('auth.signup') }}">Sign Up</a></button>
            </div>
        @endguest
        @auth
            <div class="icon-wrapper">
                <div class="nav-container">
                    <a href="" class="nav-icon-link" id="nav-icon-user-link"><i class="fa-regular fa-user nav-icon" id="nav-icon-user"></i>{{ auth()->user()->name }}</a>
                </div>

                @if (auth()->user()->admin==0)
                <div class="nav-container">
                    <a href="" class="nav-icon-link" id="nav-icon-cart-link"><i class="fa-solid fa-cart-shopping nav-icon"></i></a>
                </div>
                @endif
                @if (auth()->user()->admin==1)
                <div class="nav-container">
                 
                    <a href="{{ route('enviarEmail') }}" class="nav-icon-link" id="nav-icon-cart-link"><i class="fa-solid fa-envelope"></i></a>
                </div>

                <div class="nav-container">
                 
                    <a href="{{ route('home') }}" class="nav-icon-link" id="nav-icon-cart-link"><i class="fa-solid fa-arrow-left"></i></a>
                </div>
                
    
                @endif
                {{-- <div class="nav-container">
                    <button class="nav-button" id="nav-sign-up-button"><a href="{{ route('auth.signout') }}">Sign Out</a></button>
                </div> --}}

                
            </div>
        @endauth
    </div>
</div>