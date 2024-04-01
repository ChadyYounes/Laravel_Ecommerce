<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="{{ asset('css/chat.css') }}">
</head>
<body>
<section class="msger">
    <header class="msger-header">
        <div class="msger-header-title">
            <i class="fas fa-comment-alt"></i> Chatting with {{$receiver->name}}
        </div>
        <div class="msger-header-options">
            <span><i class="fas fa-cog"></i></span>
        </div>
    </header>

    <main class="msger-chat">
        @foreach($messages as $message)
            @if($message->sender_id == $sender->id)
                <div class="msg right-msg">
                    @else
                        <div class="msg left-msg">
                            @endif
                            <div class="msg-img" style="background-image: url({{ $message->sender_id == $sender->id ? asset('path/to/sender/image') : asset('path/to/receiver/image') }})"></div>
                            <div class="msg-bubble">
                                <div class="msg-info">
                                    <div class="msg-info-name">{{ $message->sender_id == $sender->id ? $sender->name : $receiver->name }}</div>
                                    <div class="msg-info-time">{{ $message->created_at->format('H:i') }}</div>
                                </div>
                                <div class="msg-text">
                                    {{ $message->message_content }}
                                </div>
                            </div>
                        </div>
                @endforeach
    </main>

    <form class="msger-inputarea" method="post" action="{{ route('sendMessage', ['receiver_id' => $receiver->id]) }}">
        @csrf
        <input type="text" class="msger-input" name="message" placeholder="Enter your message...">
        <button type="submit" class="msger-send-btn">Send</button>
    </form>
</section>
</body>
</html>
