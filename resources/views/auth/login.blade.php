@extends('layouts.app')

@section('content')
<div class="auth-wrapper">
    <div class="shad-card auth-card">
        <div class="auth-header">
            <h2>Welcome Back</h2>
            <p>Sign in to manage team activities.</p>
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

        <form method="POST" action="{{ route('login') }}" class="auth-form">
            @csrf
            <div class="form-group">
                <label for="email">Email Address</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" required autofocus>
            </div>
            
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>
            </div>
            
            <button type="submit" class="btn-primary">Sign In</button>
            
            <p class="auth-switch">Don't have an account? <a href="{{ route('register') }}">Register here</a></p>
        </form>
    </div>
</div>
@endsection
