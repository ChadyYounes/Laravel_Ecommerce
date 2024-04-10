<!DOCTYPE html>
<html>
<head>
    <style>
        body{
            display: flex;
            justify-content: center;
            align-content: center;
        }

        form{
            padding: 20px;
            background-color: beige;
            box-shadow: 10px 10px 10px black;
        }

        .card-title { 
            font-weight: 300; 
        }

        .btn {
            font-size: 13px;
        }

        .login-form { 
            width: 320px;
            margin: 20px;
        }

        .sign-up {
            text-align: center;
            padding: 20px 0 0;
        }

        span {
            font-size: 14px;
            color: red; /* Error message color */
        }

        .submit-btn {
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="card login-form">
        <div class="card-body">
            <div class="card-text">
                <form action="{{ route('reset-new-password')}}" method="POST" onsubmit="return validateForm()">
                    @csrf
                    
                    <input type="hidden" name="email" value="{{ $email }}">
                    <h3 class="card-title text-center">New password</h3>
                    <div class="form-group">
                        <label for="new_password">Your new password</label>
                        <input type="password" class="form-control form-control-sm" id="new_password" name="new_password">
                        <span id="passwordError" style="display: none;">Password is required</span>
                    </div>
                    <div class="form-group">
                        <label for="confirm_password">Repeat password</label>
                        <input type="password" class="form-control form-control-sm" id="confirm_password" name="confirm_password">
                        <span id="confirmError" style="display: none;">Passwords do not match</span>
                    </div>
                    <button type="submit" class="btn btn-primary btn-block submit-btn">Confirm</button>
                </form>
                
            </div>
        </div>
    </div>

    <script>
        function validateForm() {
            var newPassword = document.getElementById('new_password').value;
            var confirmPassword = document.getElementById('confirm_password').value;
            var passwordError = document.getElementById('passwordError');
            var confirmError = document.getElementById('confirmError');
            
            
            if (newPassword === '') {
                passwordError.style.display = 'block';
                return false;
            } else {
                passwordError.style.display = 'none';
            }

           
            if (newPassword !== confirmPassword) {
                confirmError.style.display = 'block';
                return false;
            } else {
                confirmError.style.display = 'none';
            }

            return true;
        }
    </script>
</body>
</html>
