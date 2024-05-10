<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat List</title>
    <link rel="stylesheet" href="{{ asset('css/chat.css') }}">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 600px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .chat {
            border-bottom: 1px solid #ddd;
            padding: 10px 0;
            display: flex;
            align-items: center;
        }
        .chat-info {
            flex: 1;
        }
        .chat-name {
            font-weight: bold;
            margin: 0;
        }
        .chat-action {
            margin-left: auto;
        }
        .chat-button {
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            padding: 8px 15px;
            cursor: pointer;
            text-decoration: none;
        }
        .chat-button:hover {
            background-color: #0056b3;
        }
        h2 {
            text-align: center;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
<div class="container">
    <h2>Chats List</h2>
    @foreach($chatsListBuyers as $chat)
        <div class="chat">
            <div class="chat-info">
                <p class="chat-name">{{$chat->getBuyer->name}}</p>
            </div>
            <div class="chat-action">
                <a href="{{ route("chat_form",['id' => $chat->getBuyer->id]) }}" class="chat-button">Chat Now</a>
            </div>
        </div>
    @endforeach
</div>
</body>
</html>
