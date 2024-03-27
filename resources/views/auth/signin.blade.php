@extends('layouts.auth')

@section('content')
    <div class="center-column-wrapper">
        
        <div class="center-column signup-wrapper">
            <fieldset class="auth-fieldset">

                <legend>Sign In</legend>
          
                <div class="fieldset-content">

                    <p style="margin-bottom: 0">or <a href="{{ route('auth.signup') }}"><b>Register</b></a></p>

                    @if (session('status'))
                        <p class="auth-field-error">{{ session('status') }}</p>
                    @endif

                    <form action="{{ route('auth.signin') }}" method="post" class="auth-form">
                        @csrf
                        <div class="auth-field @error('email') auth-field-error-input @enderror">
                            <input type="email" name="email" class="auth-text-input" placeholder=" ">
                            <label for="email" class="auth-input-label">Email</label>
                        </div>
                        <div class="auth-field @error('password') auth-field-error-input @enderror">
                            <input type="password" name="password" class="auth-text-input" placeholder=" ">
                            <label for="password" class="auth-input-label">Password</label>
                        </div>
                        
                        <button type="submit" class="auth-form-submit">Log In</button>
                    </form>
                </div>
              </fieldset>
        </div>
    </div>
@endsection