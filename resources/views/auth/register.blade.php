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
                            Sign up 
                        </div>
                        <div class="sign-in-title-alt">
                            Lorem ipsum dolor sit amet
                        </div>
                    </div>
                    <div class="slice-container">
                        <div class="slice-text-c">
                            <div class="slicer"></div>
                        </div>
                    </div>
                    <form class="input-container" action="{{ route("store-user") }}" method="POST">
                        @csrf
                        @method('post')
                        <input type="text" required placeholder="User name" name="username">
                        @error('username')
                            <p class="error-message">{{ $message }}</p>
                        @enderror
                        <input type="email" required placeholder="Email" name="email">
                        @error('email')
                            <p class="error-message">{{ $message }}</p>
                        @enderror
                        <input type="password" required placeholder="Create Password" name="createPassword">
                        @error('createPassword')
                            <p class="error-message">{{ $message }}</p>
                        @enderror
                        <input type="password" required placeholder="Confirm Password" name="confirmPassword">
                        @error('confirmPassword')
                            <p class="error-message">{{ $message }}</p>
                        @enderror
                       
                        <button type="submit">
                            Sign up
                        </button>
                        <div href="#" class="alt-f-full">
                            <a href="{{ route('login-page') }}" class="alt-f">
                                Already have an account ?
                            </a>
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
                    <div class="intro-title">
                        Lorem ipsum dolor sit amet
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
