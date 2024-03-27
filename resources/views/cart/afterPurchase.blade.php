@extends('layouts.app')

@push('head')
    <link rel="stylesheet" href="{{asset('../resources/css/afterPurchase.css')}}">
@endpush

@section('content')
    <div id="main-afterPurchase-wrapper" class="center-column-wrapper">
        <div id="main-afterPurchase" class="center-column">
            <p id="afterPurchase-title">Thank you for your purchase!</p>
            <p id="afterPurchase-subtitle">An itemized receipt has been sent to 
                {{-- Show censored email of user --}}
                @php
                    $censoredEmail = "";

                    // First character of email
                    $censoredEmail = $censoredEmail.substr(auth()->user()->email, 0, 1);

                    // Censored characters of email until @
                    for ($i=0; $i < strlen(substr(auth()->user()->email, 1, strlen(explode('@', auth()->user()->email)[0]))); $i++) { 
                        $censoredEmail = $censoredEmail.'*';
                    }

                    // @ and beyond
                    $censoredEmail = $censoredEmail.'@';

                    $censoredEmail = $censoredEmail.explode('@', auth()->user()->email)[1];
                @endphp

                {{ $censoredEmail }}
            </p>
            <button class="large-button-dark"><a href="{{ route('home') }}">Continue browsing</a></button>
        </div>
    </div>
@endsection