<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="{{ asset('css/chat.css') }}">
</head>
<body>

<section class="msger">
    <header class="msger-header d-flex justify-content-between align-items-center">
        <div class="msger-header-title">
            @if(auth()->user()->id === $sender->id)
            <i class="fas fa-comment-alt"></i> Chatting with {{$receiver->name}}
            @else
            <i class="fas fa-comment-alt"></i> Chatting with {{$sender->name}}
            @endif
        </div>
        
        <div class="msger-header-options">
            <a href="{{ route('chats_list') }}" class="btn btn-secondary go-to-chat-list-btn">Go to chat list</a>
        </div>
    </header>

    <main class="msger-chat">
        @foreach($messages as $message)
            <div class="msg {{ $message->sender_id == $sender->id ? 'right-msg' : 'left-msg' }}">
                <div class="msg-img" style="background-image: url({{ $message->sender_id == $sender->id ? asset('storage/' . ($sender->getProfile->image_url ?? 'profile-images/avatarDefault.png')) : asset('storage/' . ($receiver->getProfile->image_url)) }})"></div>

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

    <form class="msger-inputarea d-flex align-items-center p-2" method="post" action="{{ route('sendMessage', ['receiver_id' => $receiver->id]) }}">
        @csrf
        <input type="text" class="form-control msger-input me-2" name="message" placeholder="Enter your message..." required>
        
        <button type="submit" class="btn btn-primary msger-send-btn">Send</button>
    </form>
</section>

<script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>

<script>
    // Enable pusher logging - don't include this in production
    Pusher.logToConsole = true;

    const pusher = new Pusher('f4222571b1a73d903fdd', {
        cluster: 'eu'
    });

    const channel = pusher.subscribe('chat');
    const senderId = {{$sender->id}};

    channel.bind('chat-event', function(data) {
        const isSender = data.sender_id === senderId;
        const msgClass = isSender ? 'right-msg' : 'left-msg';
        const imgURL = isSender ? '{{ asset('path/to/sender/image') }}' : '{{ asset('path/to/receiver/image') }}';
        const senderName = isSender ? '{{$sender->name}}' : '{{$receiver->name}}';

        // Extract the time portion from the created_at timestamp
        const messageTime = new Date(data.created_at).toLocaleTimeString([], { hour: '2-digit', minute: '2-digit', hour12: true });

        const newMessageHtml = `
            <div class="msg ${msgClass}">
                <div class="msg-img" style="background-image: url(${imgURL})"></div>
                <div class="msg-bubble">
                    <div class="msg-info">
                        <div class="msg-info-name">${senderName}</div>
                        <div class="msg-info-time">${messageTime}</div>
                    </div>
                    <div class="msg-text">
                        ${data.message_content}
                    </div>
                </div>
            </div>
        `;

        const chatWindow = document.querySelector('.msger-chat');
        chatWindow.insertAdjacentHTML('beforeend', newMessageHtml);

        // Scroll to the bottom after adding the new message
        chatWindow.scrollTo({
            top: chatWindow.scrollHeight,
            behavior: 'smooth'
        });
    });

    window.addEventListener('load', function() {
        const chatWindow = document.querySelector('.msger-chat');
        chatWindow.scrollTop = chatWindow.scrollHeight;
    });

    document.querySelector('.msger-chat').style.scrollBehavior = 'smooth';
    
</script>
<script>
    var userId = {{ Auth::id() }};

    Echo.private('chat.' + userId)
        .listen('ChatMessageSent', (e) => {
            console.log(e);
            let messageHtml = '<div><strong>' + (e.sender_id == userId ? 'You' : 'The other user') + ':</strong> ' + e.message_content + '</div>';
            document.querySelector('.chat-window').innerHTML += messageHtml;
        });
</script>
</html>
