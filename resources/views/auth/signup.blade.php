@extends('layouts.auth')

@section('content')
    <div class="center-column-wrapper">
        
        <div class="center-column signup-wrapper">
            <fieldset class="auth-fieldset">

                <legend>Sign Up</legend>
          
                <div class="fieldset-content">

                    <p style="margin-bottom: 0">or <a href="{{ route('auth.signin') }}"><b>Log In</b></a></p>

                    <form action="{{ route('auth.signup') }}" method="post" class="auth-form">
                        @csrf
                        <div class="auth-field @error('name') auth-field-error-input @enderror">
                            <input type="text" name="name" class="auth-text-input" placeholder=" ">
                            <label for="name" class="auth-input-label">Name</label>
                        </div>
                        <div class="auth-field @error('email') auth-field-error-input @enderror">
                            <input type="email" name="email" class="auth-text-input" placeholder=" ">
                            <label for="email" class="auth-input-label">Email</label>
                        </div>
                        <div class="auth-field @error('password') auth-field-error-input @enderror">
                            <input type="password" name="password" class="auth-text-input" placeholder=" ">
                            <label for="password" class="auth-input-label">Password</label>
                        </div>
                        <div class="auth-field">
                            <input type="password" name="password_confirmation" class="auth-text-input" placeholder=" ">
                            <label for="password_confirmed" class="auth-input-label">Confirm password</label>
                        </div>
                        
                        <button type="submit" class="auth-form-submit">Create Account</button>
                    </form>
                </div>
              </fieldset>
        </div>
    </div>
@endsection