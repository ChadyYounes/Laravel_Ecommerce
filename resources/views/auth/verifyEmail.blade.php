<!DOCTYPE html>
<html>
<head>
    <title>Verify by Email</title>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-content: center;
        }
        .container {
            background-color: greenyellow;
            color: white;
            padding: 20px;
            font-size: 20px;
        }
        /* Added style for the link */
        .verify-link {
            text-decoration: none;
            color: white;
            background-color: #007bff;
            padding: 10px 20px;
            border-radius: 5px;
            transition: background-color 0.3s;
        }
        .verify-link:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Please verify your email</h2>
        
        <!-- Link for email verification -->
        <a href="{{ route('user.verify', ['user_id' => $user->id]) }}" class="verify-link">Verify Email</a>
    </div>
</body>
</html>
