<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Store Status Notification</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            padding: 20px;
            margin: 0;
        }
        .container {
            max-width: 600px;
            margin: auto;
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            color: #333;
        }
        p {
            color: #666;
            line-height: 1.6;
        }
        .activation {
            color: green;
        }
        .deactivation {
            color: red;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Store Status Notification</h1>
        <p>Your store "{{ $storeName }}" has been 
            @if($status)
                <span class="activation">activated</span>
            @else
                <span class="deactivation">deactivated</span>
            @endif
            .
        </p>
    </div>
</body>
</html>
