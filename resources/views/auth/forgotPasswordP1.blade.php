<!DOCTYPE html>
<html>
<head>
    <title>Forgot Password Form</title>
    <link rel="stylesheet" href="{{ asset('css/forgotPasswordP1.css') }}">
</head>
<body>
    <h1>Forgot your password?</h1>
    <hr></hr>
    <h3>Enter your email address to reset your password</h3>
    
    <form action="{{ route('send-reset-password-otp') }}" method="post">
        @csrf
        <label for="mail">Email</label><br>
        <input type="email" id="email" name="email" placeholder="Enter your email address" required><br>
        @error('email')
            <span class="error">{{ $message }}</span><br>
        @enderror

        @if(session('error'))
            <span class="error">{{ session('error') }}</span><br>
        @endif

        <button type="submit">Submit</button>
        <a href="{{ route('login-page') }}" class="goBack">Go Back</a>
    </form> 
</body>
</html>
