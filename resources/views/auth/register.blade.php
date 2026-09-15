@extends('layouts.app')

@section('content')
<style>
    /* Specific overrides for this exact login screen */
    body.auth-layout {
        background-color: #f3f4f6;
        display: flex;
        align-items: center;
        justify-content: center;
        min-height: 100vh;
        margin: 0;
        padding: 0;
    }
    
    .app-container {
        width: 100%;
        display: flex;
        justify-content: center;
        align-items: center;
        padding: 1rem;
    }

    .main-content {
        width: 100%;
        display: flex;
        justify-content: center;
        margin: 0;
        padding: 0;
    }
    
    .login-card {
        background: #ffffff;
        width: 100%;
        max-width: 600px;
        padding: 3rem 2.5rem;
        border-radius: 4px;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05), 0 2px 4px -1px rgba(0, 0, 0, 0.03);
    }
    
    .login-logo-container {
        display: flex;
        justify-content: center;
        margin-bottom: 1.5rem;
    }
    
    .login-logo {
        width: 32px;
        height: 32px;
        color: #000;
    }
    
    .login-title {
        text-align: center;
        font-size: 1.5rem;
        font-weight: 700;
        color: #000;
        margin-bottom: 0.5rem;
        font-family: 'Inter', sans-serif;
    }
    
    .login-subtitle {
        text-align: center;
        font-size: 0.875rem;
        color: #6b7280;
        margin-bottom: 2rem;
        font-family: 'Inter', sans-serif;
    }
    
    .login-form-group {
        margin-bottom: 1.5rem;
        display: flex;
        flex-direction: column;
    }
    
    .login-label-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 0.5rem;
    }
    
    .login-label {
        font-size: 0.8125rem;
        font-weight: 600;
        color: #111827;
        font-family: 'Inter', sans-serif;
    }
    
    .login-forgot {
        font-size: 0.8125rem;
        color: #4b5563;
        text-decoration: underline;
        font-family: 'Inter', sans-serif;
    }
    
    .login-input-container {
        position: relative;
    }
    
    .login-input {
        width: 100%;
        padding: 0.75rem 1rem;
        border: 1px solid #d1d5db;
        border-radius: 0;
        font-size: 0.875rem;
        color: #111827;
        outline: none;
        transition: border-color 0.2s;
        font-family: 'Inter', sans-serif;
    }
    
    .login-input:focus {
        border-color: #000;
    }
    
    .login-eye-btn {
        position: absolute;
        right: 0.75rem;
        top: 50%;
        transform: translateY(-50%);
        background: transparent;
        border: none;
        color: #9ca3af;
        cursor: pointer;
        padding: 0;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    
    .login-eye-btn:hover {
        color: #4b5563;
    }
    
    .login-btn {
        width: 100%;
        background-color: #000;
        color: #fff;
        padding: 0.875rem;
        border: none;
        border-radius: 0;
        font-weight: 600;
        font-size: 1rem;
        cursor: pointer;
        margin-top: 0.5rem;
        transition: background-color 0.2s;
        font-family: 'Inter', sans-serif;
    }
    
    .login-btn:hover {
        background-color: #1f2937;
    }
    
    .login-footer {
        text-align: center;
        margin-top: 2rem;
        font-size: 0.875rem;
        color: #6b7280;
        font-family: 'Inter', sans-serif;
    }
    
    .login-footer a {
        color: #111827;
        font-weight: 700;
        text-decoration: underline;
    }

    /* Dark mode support override for consistency */
    html.dark body.auth-layout { background-color: #000; }
    html.dark .login-card { background: #111; box-shadow: none; border: 1px solid #333; }
    html.dark .login-title, html.dark .login-label, html.dark .login-footer a { color: #fff; }
    html.dark .login-logo { color: #fff; }
    html.dark .login-input { background: transparent; border-color: #333; color: #fff; }
    html.dark .login-input:focus { border-color: #fff; }
    html.dark .login-btn { background-color: #fff; color: #000; }
    html.dark .login-btn:hover { background-color: #e5e5e5; }
</style>

<div class="login-card">
    <div class="login-logo-container">
        <p>Mpontu - Activity Tracker</p>
    </div>
    
    <h2 class="login-title">Create Account</h2>
    <p class="login-subtitle">Join the applications support team</p>
    
    @if ($errors->any())
        <div class="alert-error" style="border-radius: 0; padding: 0.75rem; margin-bottom: 1.5rem; font-size: 0.875rem; background: #fee2e2; color: #b91c1c; border: 1px solid #f87171;">
            <ul style="list-style: none; padding: 0; margin: 0;">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('register') }}">
        @csrf
        <div class="login-form-group">
            <div class="login-label-row">
                <label for="name" class="login-label">Full Name *</label>
            </div>
            <div class="login-input-container">
                <input type="text" id="name" name="name" class="login-input" value="{{ old('name') }}" required autofocus>
            </div>
        </div>

        <div class="login-form-group">
            <div class="login-label-row">
                <label for="email" class="login-label">Email Address *</label>
            </div>
            <div class="login-input-container">
                <input type="email" id="email" name="email" class="login-input" value="{{ old('email') }}" required>
            </div>
        </div>
        
        <div class="login-form-group">
            <div class="login-label-row">
                <label for="password" class="login-label">Password *</label>
            </div>
            <div class="login-input-container">
                <input type="password" id="password" name="password" class="login-input" required>
                <button type="button" class="login-eye-btn" onclick="togglePassword('password')" aria-label="Toggle password visibility">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M2 12s3-7 10-7 10 7 10 7-3 7-10 7-10-7-10-7Z"/>
                        <circle cx="12" cy="12" r="3"/>
                    </svg>
                </button>
            </div>
        </div>
        
        <div class="login-form-group">
            <div class="login-label-row">
                <label for="password_confirmation" class="login-label">Confirm Password *</label>
            </div>
            <div class="login-input-container">
                <input type="password" id="password_confirmation" name="password_confirmation" class="login-input" required>
                <button type="button" class="login-eye-btn" onclick="togglePassword('password_confirmation')" aria-label="Toggle password visibility">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M2 12s3-7 10-7 10 7 10 7-3 7-10 7-10-7-10-7Z"/>
                        <circle cx="12" cy="12" r="3"/>
                    </svg>
                </button>
            </div>
        </div>
        
        <button type="submit" class="login-btn">Register</button>
        
        <div class="login-footer">
            Already have an account? <a href="{{ route('login') }}">Sign In</a>
        </div>
    </form>
</div>

<script>
    function togglePassword(inputId) {
        const passwordInput = document.getElementById(inputId);
        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
        } else {
            passwordInput.type = 'password';
        }
    }
</script>
@endsection
