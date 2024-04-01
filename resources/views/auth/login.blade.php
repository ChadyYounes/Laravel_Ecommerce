<html lang="en">
<head>
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Arimo&family=Poppins&display=swap" rel="stylesheet">
    <style>
        .error-message {
            color: red;
        }
    </style>
</head>
<body>
    <div class="sign-in-container">
        <div class="sign-column s1">
            <div class="sign-column-face s2">
                <div class="s3">
                    <div class="sign-header-section">
                        <div class="sign-in-title">
                            Login 
                        </div>
                        <div class="sign-in-title-alt">
                            Lorem ipsum dolor sit amet
                        </div>
                    </div>
                    <div class="sign-buttons">
                        <a href="{{ route('google-auth')}}" class="login-w-button">
                            <img width="18" height="18" src="https://img.icons8.com/color/48/google-logo.png" alt="google-logo" />
                            <span>Sign in with Google</span>
                        </a>
                        <a href="#" class="login-w-button">
                            <img width="18" height="18" src="https://img.icons8.com/ios-filled/50/microsoft-365.png" alt="mac-os" />
                            <span>Sign in with Microsoft</span>
                        </a>
                    </div>
                    <div class="sign-buttons">
                        <!-- Google and Microsoft login buttons -->
                    </div>
                    <div class="slice-container">
                        <div class="slice-text-c">
                            <div class="slicer"></div>
                            <div class="slice-text">Or with email</div>
                        </div>
                    </div>
                    <form class="input-container" method="post" action="{{ route('login-page') }}">
                        @csrf
                        <input type="email" required placeholder="Email" name="email">
                        
                        <input type="password" required placeholder="Password" name="password">
                        @error('email')
                            <div class="error-message">{{ $message }}</div>
                        @enderror
                        @error('password')
                            <div class="error-message">{{ $message }}</div>
                        @enderror
                        <!-- Forgot password link -->
                        <a href="{{route('forgotpassword-page1')}}" class="alt-f">Forgot Password ?</a>
                        <button type="submit">Sign in</button>
                        <div class="alt-f-full">
                            Not a Member yet ? <a href="{{ route('register-page') }}" class="alt-f">Sign up</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="sign-column w2">
            <div class="intro-p">
                <div class="canvas-logo">
                    <img src="https://images.unsplash.com/photo-1496200186974-4293800e2c20?q=80&w=1932&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="logo">
                </div>
                <div class="intro-content">
                    <div class="intro-title">Lorem ipsum dolor sit amet</div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
