@extends('layouts.app')

@section('content')
<div class="auth-wrapper">
    <div class="shad-card auth-card">
        <div class="auth-header">
            <h2>Create Account</h2>
            <p>Join the applications support team.</p>
        </div>
        
        @if ($errors->any())
            <div class="alert-error">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('register') }}" class="auth-form">
            @csrf
            <div class="form-group">
                <label for="name">Full Name</label>
                <input type="text" id="name" name="name" value="{{ old('name') }}" required autofocus>
            </div>
            
            <div class="form-group">
                <label for="email">Email Address</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" required>
            </div>
            
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>
            </div>
            
            <div class="form-group">
                <label for="password_confirmation">Confirm Password</label>
                <input type="password" id="password_confirmation" name="password_confirmation" required>
            </div>
            
            <button type="submit" class="btn-primary">Register</button>
            
            <p class="auth-switch">Already have an account? <a href="{{ route('login') }}">Sign In</a></p>
        </form>
    </div>
</div>
@endsection
