<!DOCTYPE html>
<html>
<head>
    <title>Email Verification</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .container {
            text-align: center;
        }
        .verify-btn {
            background-color: #007bff;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
            font-size: 16px;
            transition: background-color 0.3s, opacity 0.3s; /* Added opacity transition */
        }
        .verify-btn:hover {
            background-color: #0056b3;
        }
        /* Added CSS to style the button when disabled */
        .verify-btn[disabled] {
            opacity: 0.5; /* Reduced opacity when disabled */
            cursor: not-allowed; /* Change cursor to not-allowed when disabled */
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Verify Your Email Address</h2>
        <p>Click the button below to verify your email address:</p>
        <a id="verifyBtn" href="{{ $verificationUrl }}" class="verify-btn" onclick="disableButton(event, this)">Verify Email</a>
    </div>
    
    <script>
        function disableButton(event, button) {
            event.preventDefault(); // Prevent default form submission behavior
            
            button.disabled = true;
            button.innerText = 'Check your inbox';
            button.style.backgroundColor = '#ccc'; 
        }
    </script>
</body>
</html>
